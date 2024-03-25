<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use LodgeBookings;
use LodgeBookingsCheckPayments;
use LodgeCarts;
use LodgeCartsCalenders;
use LodgePaymentsValidations;
use LodgePrices;

use LodgeProfiles;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class LodgeTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminLodge()) {
            return Auth::user();
        }

        return LodgeProfiles::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        $temp = LodgeProfiles::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }






    function dialog_room_lodge_profiles() {
        $data = \LodgeRooms::where('id',request()->id)
            ->with('lodgeProfile.badasoUsers')
            ->first();
        $data = $data->lodgeProfile;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_staff_lodge_profiles() {
        $data = \LodgeStaffs::where('id',request()->id)
            ->with('lodgeProfile.badasoUsers')
            ->first();
        $data = $data->lodgeProfile;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_facility_lodge_profiles() {
        $data = \LodgeFacility::where('id',request()->id)
            ->with('lodgeProfile.badasoUsers')
            ->first();
        $data = $data->lodgeProfile;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_lodge_rooms() {
        $data = \LodgePrices::where('id',request()->id)
            ->with([
                'lodgeRoom.lodgeProfiles',
            ])
            ->first();
        $data = $data->lodgeRoom;
        return ApiResponse::onlyEntity($data);
    }




    function get_calender_booked(Request $request) {  // untuk transport rental

        # check dimulai hari ini dan seterusnya
        return $data = LodgeCartsCalenders::query()
            ->where('room_id', request()->room_id)
            ->whereMonth('value_date', request()->month)
            ->whereYear('value_date', request()->year)
            ->with('badasoUser')
            ->get();

        //return ApiResponse::onlyEntity($data);
    }

    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \LodgeCarts::with([
            'badasoUsers',
            'badasoUser',
            'lodgeRoom',
            'lodgeRooms',
            'lodgePrice',
            'lodgePrices',
            'lodgeProfile',
            'lodgeProfiles',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }

    function add_to_cart(Request $request) {

        DB::beginTransaction();

        try {
            // get slug by route name and get data type in table
            //$slug = getSlug($request);

            $data_type = getDataType('lodge-prices'); // nama table

            if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

            $data = LodgePrices::where('id', request()->price_id)->first();

            $lodge_carts_calenders = [];  // untuk transport rental

            // lebih kecil dari hari ini akan di hapus
            $date_now = date("Y-m-d"); // this format is string comparable
            $date_in = json_decode(request()->date_checkin, true);
            $today_and_grater = [];
            foreach ($date_in as $value) {
                if ($date_now <= $value['id']) {
                    array_push($today_and_grater, $value);


                    $lodge_carts_calenders[] = [
                        'customer_id' => request()->customer_id,
                        'profile_id' => $data->profile_id,
                        'room_id' => $data->room_id,
                        'price_id' => $data->id,

                        'value_id' => $value['id'],
                        'value_date' => $value['date'],
                        'code_table' => "lodge-carts-calenders",
                    ];
                }
            }

            $quantity = request()->quantity;

            $carts = LodgeCarts::query()
                ->where('customer_id', request()->customer_id)
                ->where('price_id', request()->price_id)
                ->first();

            $LodgeCarts = LodgeCarts::updateOrCreate([
                    'customer_id' => request()->customer_id,
                    'profile_id' => $data->profile_id,
                    'room_id' => $data->room_id,
                    'price_id' => $data->id,
                ],
                [
                    'customer_id' => request()->customer_id,
                    'profile_id' => $data->profile_id,
                    'room_id' => $data->room_id,
                    'price_id' => $data->id,
                    'quantity' => $quantity, // karena lama waktu nginap, jadi di replace  //!$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"),
                    'date_checkin' => json_encode($today_and_grater), //request()->date_checkin,
                    'code_table' => "lodge-carts",
                    'uuid' => $carts?->uuid ?: ShortUuid(),
                ]
            );

            /*
            // untuk transport rental (MATIKAN SAJA)
            // ===================================================================
            # check dimulai hari ini dan seterusnya
            $GET_LodgeCartsCalenders = LodgeCartsCalenders::query()
                ->where('room_id', $data->room_id)
                ->whereDate('value_date', '>=', now())
                ->get();

            foreach ($GET_LodgeCartsCalenders as $value1) {
                foreach ($lodge_carts_calenders as $value2) {
                    # code...
                    if(
                        $value1['value_id'] == $value2['value_id'] &&
                        $value1['room_id'] == $value2['room_id']
                    ) {
                        return ApiResponse::failed("Tanggal $value1->value_id sudah dipakai");
                        break;
                    }
                }
                # code...
            }

            $LodgeCartsCalenders = LodgeCartsCalenders::insert($lodge_carts_calenders);
            // $LodgeCartsCalenders = LodgeCartsCalenders::upsert(
            //     $lodge_carts_calenders,
            //     uniqueBy: ['customer_id', 'profile_id', 'room_id', 'price_id', 'value_id'],
            //     update: ['value_id','value_date']
            // );
            // ===================================================================
            */

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties(['attributes' => [$LodgeCarts]])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            return ApiResponse::onlyEntity([$LodgeCarts]);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    function update_to_cart(Request $request) {

        // return (request()->dateCheckIn);
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        // lebih kecil dari hari ini akan di hapus
        $date_now = date("Y-m-d"); // this format is string comparable
        $date_in = json_decode(request()->dateCheckIn, true);
        $today_and_grater = [];
        foreach ($date_in as $value) {
            if ($date_now <= $value['id']) {
                array_push($today_and_grater, $value);
            }
        }

        LodgeCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
                'date_checkin' => $today_and_grater,
        ]);

        $data = \LodgeCarts::with([
            'badasoUsers',
            'badasoUser',
            'lodgeRoom',
            'lodgeRooms',
            'lodgePrice',
            'lodgePrices',
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
    }












    function dialog_booking_lodge_bookings() {

        $data = LodgeBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'lodgeBookings',
            'lodgeBooking',
            'lodgeProfile',
            'lodgeProfiles',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_lodge_payments_validations() {

        // $payment_id = LodgePaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = LodgeBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'lodgeBookings',
        //     'lodgeBooking',
        //     'lodgeProfile',
        //     'lodgeProfiles',
        // ])->first();

        $data = LodgePaymentsValidations::where('id',request()->id)->with([
            'souvenirPayment',
            'souvenirPayment.badasoUsers',
            'souvenirPayment.souvenirBookings',
        ])->first();
        $data = $data->souvenirPayment;
        return ApiResponse::onlyEntity($data);
    }


}
