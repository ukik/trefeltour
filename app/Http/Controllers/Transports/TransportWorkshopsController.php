<?php

namespace App\Http\Controllers\Transports;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Badaso\Controller;
use BadasoUsers;
// use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;
use Illuminate\Support\Facades\Auth;
use TransportMaintenances;
use TransportWorkshops;
use TravelPayments;

class TransportWorkshopsController extends Controller
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

            $data = \TransportWorkshops::with([
                'badasoUser',
                'badasoUsers',
                // 'transportMaintenances',
                // 'transportMaintenance',
                // 'transportMaintenance.transportVehicle',
                // 'transportMaintenance.transportVehicle.transportRental',
                // 'transportMaintenance.transportVehicle.transportBooking',
                // 'transportMaintenance.transportVehicle.transportBooking.transportDriver',
                // 'transportMaintenance.transportVehicle.transportBooking.transportReturn',
                // 'transportMaintenance.transportVehicle.transportBooking.transportPayment' => function($q) { return $q->select('id','booking_id','customer_id'); },
                // 'transportMaintenance.transportVehicle.transportBooking.transportPayment.transportPaymentsValidation' => function($q) { return $q->select('id','payment_id'); },
            ])->orderBy('id','desc');
            if(request()['showSoftDelete'] == 'true') {
                $data = $data->onlyTrashed();
            }


            if(request()->search) {
                $search = request()->search;

                $columns = \Illuminate\Support\Facades\Schema::getColumnListing('transport_workshops');

                $user_id = function($q) use ($search) {
                    return $q
                        ->where('name','like','%'.$search.'%')
                        ->orWhere('username','like','%'.$search.'%')
                        ->orWhere('email','like','%'.$search.'%')
                        ->orWhere('phone','like','%'.$search.'%');
                };

                $data
                    // ->orWhere('id','like','%'.$search.'%')
                    ->orWhereHas('badasoUser', $user_id);

                foreach ($columns as $value) {
                    switch ($value) {
                        // case "user_id":
                        // case "is_available":
                        // case "category":
                        // case "day_open":
                        // case "day_close":
                        case "code_table":
                        //case "created_at":
                        //case "updated_at":
                        case "deleted_at":
                            # code...
                            break;
                        default:
                            $data->orWhere($value,'like','%'.$search.'%');
                    }
                }

            }

            if(request()->available) {
                $available = request()->available;
                $data->where('is_available',$available);
            }

            if(request()->category) {
                $category = request()->category;
                $data->where('category',$category);
            }

            if(request()->day_open) {
                $day_open = request()->day_open;
                $data->where('day_open',$day_open);
            }

            if(request()->day_close) {
                $day_close = request()->day_close;
                $data->where('day_close',$day_close);
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
            $data = \TransportWorkshops::with([
                'badasoUser',
                'badasoUsers',
                // 'transportMaintenances',
                // 'transportMaintenance',
                // 'transportMaintenance.transportVehicle',
                // 'transportMaintenance.transportVehicle.transportRental',
                // 'transportMaintenance.transportVehicle.transportBooking',
                // 'transportMaintenance.transportVehicle.transportBooking.transportDriver',
                // 'transportMaintenance.transportVehicle.transportBooking.transportReturn',
                // 'transportMaintenance.transportVehicle.transportBooking.transportPayment',
                // 'transportMaintenance.transportVehicle.transportBooking.transportPayment.transportPaymentsValidation',
            ])->whereId($request->id)->first();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_READ, $table_name);

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        // return $slug = $this->getSlug($request);
        DB::beginTransaction();

        //isOnlyAdminTransport();

        try {

            // get slug by route name and get data type
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $table_entity = \TransportWorkshops::where('id', $request->data['id'])->first();

            $req = request()['data'];
            $data = [
                'user_id' => $table_entity->user_id ,
                'name' => $req['name'] ,
                'email' => $req['email'] ,
                'phone' => $req['phone'] ,
                'location' => $req['location'] ,
                'image' => $req['image'] ,
                'address' => $req['address'] ,
                'codepos' => $req['codepos'] ,
                'city' => $req['city'] ,
                'country' => $req['country'] ,
                'policy' => $req['policy'] ,
                'category' => $req['category'] ,
                'year_exp' => $req['year_exp'] ,
                'day_open' => $req['day_open'] ,
                'day_close' => $req['day_close'] ,
                'time_open' => date("h:m", strtotime($req['time_open'])) ,
                'time_close' => date("h:m", strtotime($req['time_close'])) ,
                'is_available' => $req['is_available'],

                'code_table' => ($slug) ,
                'uuid' => $table_entity->uuid ?: ShortUuid(),
            ];

            $validator = Validator::make($data,
                [
                    'user_id' => 'required|unique:view_transport_workshops_check_user,user_id,'.$req['id'],
                    'codepos' => 'max:6',
                    // 'user_id' => 'unique:view_transport_workshops_check_user,user_id,'.$req['id']

                    // susah karena pake softDelete, pakai cara manual saja
                    // 'ticket_id' => [
                    //     'required', \Illuminate\Validation\Rule::unique('transport_bookings')->ignore($req['id'])
                    // ],
                ],
                [
                    'user_id.unique' => 'User sudah terdaftar'
                ]
            );
            if ($validator->fails()) {
                $errors = json_decode($validator->errors(), True);
                foreach ($errors as $key => $value) {
                    return ApiResponse::failed(implode('',$value));
                }
            }

            \TransportWorkshops::where('id', $request->data['id'])->update($data);
            $updated['old_data'] = $table_entity;
            $updated['updated_data'] = \TransportWorkshops::where('id', $request->data['id'])->first();

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

        //isOnlyAdminTransport();

        try {

            // get slug by route name and get data type in table
            $slug = $this->getSlug($request);

            $data_type = $this->getDataType($slug);

            $req = request()['data'];
            $data = [
                'user_id' => getUserId($req['user_id']) ,
                'name' => $req['name'] ,
                'email' => $req['email'] ,
                'phone' => $req['phone'] ,
                'location' => $req['location'] ,
                'image' => $req['image'] ,
                'address' => $req['address'] ,
                'codepos' => $req['codepos'] ,
                'city' => $req['city'] ,
                'country' => $req['country'] ,
                'policy' => $req['policy'] ,
                'category' => $req['category'] ,
                'year_exp' => $req['year_exp'] ,
                'day_open' => $req['day_open'] ,
                'day_close' => $req['day_close'] ,
                'time_open' => date("h:m", strtotime($req['time_open'])) ,
                'time_close' => date("h:m", strtotime($req['time_close'])) ,
                'is_available' => $req['is_available'],

                'code_table' => ($slug) ,
                'uuid' => ShortUuid(),
            ];

            $validator = Validator::make($data,
                [
                    'user_id' => 'required|unique:view_transport_workshops_check_user',
                    'codepos' => 'max:6',
                    // susah karena pake softDelete, pakai cara manual saja
                    // 'ticket_id' => [
                    //     'required', \Illuminate\Validation\Rule::unique('transport_bookings')->ignore($req['id'])
                    // ],
                ],
                [
                    'user_id.unique' => 'User sudah terdaftar'
                ]
            );
            if ($validator->fails()) {
                $errors = json_decode($validator->errors(), True);
                foreach ($errors as $key => $value) {
                    return ApiResponse::failed(implode('',$value));
                }
            }

            $stored_data = \TransportWorkshops::insert($data);

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
        $check = TransportWorkshops::where('id', $value)->with(['transportVehicle'])->first();
        if($check->transportVehicle) return ApiResponse::failed("Tidak bisa dihapus, data ini digunakan");

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

        //isOnlyAdminTransport();

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
            $filters = TransportWorkshops::whereIn('id', explode(",",request()['data'][0]['value']))->with('transportVehicle')->get();
            $temp = [];
            foreach ($filters as $value) {
                if($value->transportVehicle == null) {
                    array_push($temp, $value['id']);
                }
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
