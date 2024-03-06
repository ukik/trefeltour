<?php

namespace App\Http\Controllers\Lodges;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Badaso\Controller;
// use App\Http\Controllers\Controller;
use Exception;
use Google\Service\MyBusinessLodging\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;
use Illuminate\Support\Facades\Auth;
use LodgeFacility;
use TravelPayments;

class LodgeFacilityController extends Controller
{

    public $isLogged;
    public $isRole;

    public function __construct() {

        if(Auth::check()) {

            $this->isLogged = true;

            foreach (Auth::user()->roles as $key => $value) {
                $role = $value->name;
            }

            $this->isRole = $role;

        } else {
            return ApiResponse::unauthorized();
        }
    }

    public function browse(Request $request)
    {
        try {
            // $slug = $this->getSlug($request);

            // $data_type = $this->getDataType($slug);

            // $only_data_soft_delete = $request->showSoftDelete == 'true';

            // $data = $this->getDataList($slug, $request->all(), $only_data_soft_delete);

            $data = \LodgeFacility::with([
                'lodgeProfile',
                'lodgeProfiles',
            ])->orderBy('id','desc');
            if(request()['showSoftDelete'] == 'true') {
                $data = $data->onlyTrashed();
            }
            $data = $data->paginate(request()->perPage);

            // $encode = json_encode($paginate);
            // $decode = json_decode($encode);
            // $data['data'] = $decode->data;
            // $data['total'] = $decode->total;

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function all(Request $request)
    {
        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $builder_params = [
                'order_field' => isset($request['order_field']) ? $request['order_field'] : $data_type->order_column,
                'order_direction' => isset($request['order_direction']) ? $request['order_direction'] : $data_type->order_direction,
            ];

            if ($data_type->model_name) {
                $records = GetData::clientSideWithModel($data_type, $builder_params);
            } else {
                $records = GetData::clientSideWithQueryBuilder($data_type, $builder_params);
            }

            return ApiResponse::onlyEntity($records);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {

        try {
            $request->validate([
                'id' => 'required',
            ]);
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);
            $request->validate([
                'id' => 'exists:'.$data_type->name,
            ]);

            // $data = $this->getDataDetail($slug, $request->id);
            $data = \LodgeFacility::with([
                'lodgeProfile',
                'lodgeProfiles',
            ])->whereId($request->id)->first();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_READ, $table_name);

            // $data->customer_selected = DB::table('travel_reservations')->where('customer_id', request()->id)->limit(1)->get();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        // return $slug = $this->getSlug($request);
        DB::beginTransaction();

        try {

            // get slug by route name and get data type
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $table_entity = \LodgeFacility::where('id', $request->data['id'])->first();

            $req = request()['data'];
            $data = [
                'profile_id' => $table_entity->profile_id ,
                'facility_sport' => implode(',', $req['facility_sport'] ?: []) ,
                'facility_service' => implode(',', $req['facility_service'] ?: []) ,
                'facility_public' => implode(',', $req['facility_public'] ?: []) ,
                'facility_kid_pet' => implode(',', $req['facility_kid_pet'] ?: []) ,
                'facility_in_room' => implode(',', $req['facility_in_room'] ?: []) ,
                'facility_general' => implode(',', $req['facility_general'] ?: []) ,
                'facility_connectivity' => implode(',', $req['facility_connectivity'] ?: []) ,
                'facility_business' => implode(',', $req['facility_business'] ?: []) ,
                'code_table' => ($slug) ,
                'uuid' => $table_entity->uuid ?: ShortUuid(),
            ];

            $validator = Validator::make($data,
                [
                    // '*' => 'required',
                    // 'user_id' => 'unique:view_transport_drivers_check_user,user_id,'.$req['id']
                    // susah karena pake softDelete, pakai cara manual saja
                    // 'ticket_id' => [
                    //     'required', \Illuminate\Validation\Rule::unique('travel_bookings')->ignore($req['id'])
                    // ],
                ],
                [
                    // 'code_stnk.unique' => 'User sudah terdaftar'
                ]
            );
            if ($validator->fails()) {
                $errors = json_decode($validator->errors(), True);
                foreach ($errors as $key => $value) {
                    return ApiResponse::failed(implode('',$value));
                }
            }

            \LodgeFacility::where('id', $request->data['id'])->update($data);
            $updated['old_data'] = $table_entity;
            $updated['updated_data'] = \LodgeFacility::where('id', $request->data['id'])->first();

            DB::commit();
            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties([
                    'old' => $updated['old_data'],
                    'attributes' => $updated['updated_data'],
                ])
                ->log($data_type->display_name_singular.' has been updated');

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_UPDATE, $table_name);

            return ApiResponse::onlyEntity($updated['updated_data']);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();

        try {

            // get slug by route name and get data type in table
            $slug = $this->getSlug($request);

            $data_type = $this->getDataType($slug);

            $req = request()['data'];
            $data = [
                'profile_id' => $req['profile_id'] ,
                'facility_sport' => implode(',', $req['facility_sport'] ?: []) ,
                'facility_service' => implode(',', $req['facility_service'] ?: []) ,
                'facility_public' => implode(',', $req['facility_public'] ?: []) ,
                'facility_kid_pet' => implode(',', $req['facility_kid_pet'] ?: []) ,
                'facility_in_room' => implode(',', $req['facility_in_room'] ?: []) ,
                'facility_general' => implode(',', $req['facility_general'] ?: []) ,
                'facility_connectivity' => implode(',', $req['facility_connectivity'] ?: []) ,
                'facility_business' => implode(',', $req['facility_business'] ?: []) ,

                'code_table' => ($slug) ,
                'uuid' => ShortUuid(),
            ];

            $validator = Validator::make($data,
                [
                    // '*' => 'required',
                    'profile_id' => 'unique:lodge_facility_unique'
                    // susah karena pake softDelete, pakai cara manual saja
                    // 'ticket_id' => [
                    //     'required', \Illuminate\Validation\Rule::unique('travel_bookings')->ignore($req['id'])
                    // ],
                ],
                [
                    'profile_id.unique' => 'User sudah terdaftar'
                ]
            );
            if ($validator->fails()) {
                $errors = json_decode($validator->errors(), True);
                foreach ($errors as $key => $value) {
                    return ApiResponse::failed(implode('',$value));
                }
            }

            $stored_data = \LodgeFacility::insert($data);

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties(['attributes' => $stored_data])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            return ApiResponse::onlyEntity($stored_data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        $value = request()['data'][0]['value'];
        $check = LodgeFacility::where('id', $value)->where('is_reserved', 'true')->first();
        if($check) return ApiResponse::failed("Tidak bisa dihapus, data sedang digunakan");

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $slug = $this->getSlug($request);
                        $data_type = $this->getDataType($slug);
                        $table_entity = DB::table($data_type->name)->where('id', $request->data[0]['value'])->first();

                        if (is_null($table_entity)) {
                            $fail(__('badaso::validation.crud.id_not_exist'));
                        }
                    },
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $is_hard_delete = $request->isHardDelete == 'true';

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $this->deleteData($data, $data_type, $is_hard_delete);

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been deleted');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_DELETE, $table_name);

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function restore(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $this->restoreData($data, $data_type);

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been restore');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMultiple(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $slug = $this->getSlug($request);
                        $data_type = $this->getDataType($slug);

                        $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
                        $ids = $data['ids'];
                        $id_list = explode(',', $ids);
                        foreach ($id_list as $id) {
                            $table_entity = DB::table($data_type->name)->where('id', $id)->first();
                            if (is_null($table_entity)) {
                                $fail(__('badaso::validation.crud.id_not_exist'));
                            }
                        }
                    },
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $is_hard_delete = $request->isHardDelete == 'true';

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $ids = $data['ids'];
            $id_list = explode(',', $ids);


            // ADDITIONAL BULK DELETE
            // -------------------------------------------- //
            $filters = LodgeFacility::whereIn('id', explode(",",request()['data'][0]['value']))->where('is_reserved','false')->get();
            $temp = [];
            foreach ($filters as $value) {
                array_push($temp, $value['id']);
            }
            $id_list = $temp;
            // -------------------------------------------- //


            foreach ($id_list as $id) {
                $should_delete['id'] = $id;
                $this->deleteData($should_delete, $data_type, $is_hard_delete);
            }

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been bulk deleted');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function restoreMultiple(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $ids = $data['ids'];
            $id_list = explode(',', $ids);
            foreach ($id_list as $id) {
                $should_delete['id'] = $id;
                $this->restoreData($should_delete, $data_type);
            }

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been bulk deleted');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function sort(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);
            $order_column = $data_type->order_column;

            if ($data_type->model_name) {
                $model = app($data_type->model_name);
                foreach ($request->data as $index => $row) {
                    $single_data = $model::find($row['id']);
                    $single_data[$order_column] = $index + 1;
                    $single_data->save();

                    activity($data_type->display_name_singular)
                        ->causedBy(auth()->user() ?? null)
                        ->withProperties(['attributes' => $single_data])
                        ->log($data_type->display_name_singular.' has been sorted');
                }
            } else {
                foreach ($request->data as $index => $row) {
                    $updated_data[$order_column] = $index + 1;
                    DB::table($data_type->name)->where('id', $row['id'])->update($updated_data);

                    activity($data_type->display_name_singular)
                        ->causedBy(auth()->user() ?? null)
                        ->withProperties(['attributes' => $updated_data])
                        ->log($data_type->display_name_singular.' has been sorted');
                }
            }

            DB::commit();

            return ApiResponse::onlyEntity();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function setMaintenanceState(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'slug' => 'required|exists:Uasoft\Badaso\Models\DataType,slug',
                'is_maintenance' => 'required',
            ]);

            $data_type = DataType::where('slug', $request->slug)->firstOrFail();
            $data_type->is_maintenance = $request->is_maintenance ? 1 : 0;
            $data_type->save();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }
}
