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
use LodgePaymentsValidations;
use LodgePrices;

use LodgeProfiles;
use Uasoft\Badaso\Helpers\ApiResponse;

class LodgeTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminLodge()) {
            return Auth::user();
        }

        $temp = LodgeProfiles::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserBookingEdit() {
        if(isAdminLodge()) {
            return Auth::user();
        }

        $temp = LodgeBookings::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserPaymentValidationEdit() {
        if(isAdminLodge()) {
            return Auth::user();
        }

        $validator_id = LodgePaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $validator_id)->first();
    }

    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \LodgeCarts::with([
            // 'souvenirStore.souvenirBooking.badasoUsers',
            // 'souvenirStore.souvenirBooking.badasoUser',
            // 'souvenirStore.souvenirBookings',
            'badasoUsers',
            'badasoUser',

            'souvenirProduct',
            'souvenirProducts',
            'souvenirPrice',
            'souvenirPrices',
            'souvenirStore',
            'souvenirStores',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
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

    function add_to_cart(Request $request) {

        // store_id
        // product_id
        // price_id
        // name
        // get_price
        // get_discount
        // get_cashback
        // get_total_amount
        // quantity
        // get_final_amount
        // description
        // code_table

        if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

        $data = LodgePrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = LodgeCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        LodgeCarts::updateOrCreate([
                'customer_id' => request()->customer_id,
                'store_id' => $data->store_id,
                'product_id' => $data->product_id,
                'price_id' => $data->id,
            ],
            [
                'customer_id' => request()->customer_id,
                'store_id' => $data->store_id,
                'product_id' => $data->product_id,
                'price_id' => $data->id,
                'quantity' => !$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"), //DB::raw("quantity + $quantity"),
                'code_table' => "souvenir-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        LodgeCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \LodgeCarts::with([
            // 'souvenirStore.souvenirBooking.badasoUsers',
            // 'souvenirStore.souvenirBooking.badasoUser',
            // 'souvenirStore.souvenirBookings',
            'badasoUsers',
            'badasoUser',

            'souvenirProduct',
            'souvenirProducts',
            'souvenirPrice',
            'souvenirPrices',
            'souvenirStores',
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


    function dialog_booking_souvenir_bookings() {

        $data = LodgeBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'souvenirBookings',
            'souvenirBooking',
            'souvenirStore',
            'souvenirStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_souvenir_payments_validations() {

        $payment_id = LodgePaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = LodgeBookingsCheckPayments::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'souvenirBookings',
            'souvenirBooking',
            'souvenirStore',
            'souvenirStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


}
