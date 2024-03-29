<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TravelBookings;
use TravelBookingsCheckPayments;
use TravelCarts;
use TravelPrices;

use TravelPaymentsValidations;
use TravelReservations;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use TravelStores;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class TravelTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTravel()) {
            return Auth::user();
        }

        return TravelStores::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        // $temp = TravelReservations::where('id', request()->id)->value('user_id');
        // return BadasoUsers::where('id', $temp)->first();
    }

    function travel_stores_dialog_user() {
        if(isAdminTravel()) {
            return Auth::user();
        }

        return TravelStores::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];
    }

    function travel_reservations_dialog_user() {
        if(isAdminTravel()) {
            return Auth::user();
        }

        return TravelReservations::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];
    }














    function dialog_reservation_travel_stores() {
        $data = \TravelTickets::where('id',request()->id)
            ->with('travelReservation.badasoUsers')
            ->first();
        $data = $data->travelReservation;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_travel_reservations() {
        $data = \TravelPrices::where('id',request()->id)
            ->with([
                'travelReservation',
            ])
            ->first();
        $data = $data->travelReservation;
        return ApiResponse::onlyEntity($data);
    }



    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \TravelCarts::with([
            'badasoUsers',
            'badasoUser',

            'travelTicket',
            'travelTickets',
            'travelPrice',
            'travelPrices',
            'travelReservation',
            'travelReservations',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }

    function add_to_cart(Request $request) {

        if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

        $data = TravelPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = TravelCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        TravelCarts::updateOrCreate([
                'customer_id' => request()->customer_id,
                'store_id' => $data->store_id,
                'reservation_id' => $data->reservation_id,
                'price_id' => $data->id,
            ],
            [
                'customer_id' => request()->customer_id,
                'store_id' => $data->store_id,
                'reservation_id' => $data->reservation_id,
                'price_id' => $data->id,
                'quantity' => !$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"), //DB::raw("quantity + $quantity"),
                'code_table' => "travel-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        TravelCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \TravelCarts::with([
            'badasoUsers',
            'badasoUser',

            'travelTicket',
            'travelTickets',
            'travelPrice',
            'travelPrices',
            'travelReservations',
        ])->orderBy('id','desc');
        if(request()['showSoftDelete'] == 'true') {
            $data = $data->onlyTrashed();
        }

        if(request()->popup) {
            $data = $data->where('id', request()->id)->paginate(request()->perPage);
        } else {
            $data = $data->paginate(request()->perPage);
        }

        // $encode = json_encode($paginate);
        // $decode = json_decode($encode);
        // $data['data'] = $decode->data;
        // $data['total'] = $decode->total;

        return ApiResponse::onlyEntity($data);
    }





    function dialog_booking_travel_bookings() {

        $data = TravelBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'travelBookings',
            'travelBooking',
            'travelReservation',
            'travelReservations',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_travel_payments_validations() {

        // $payment_id = TravelPaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = TravelBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'travelBookings',
        //     'travelBooking',
        //     'travelReservation',
        //     'travelReservations',
        // ])->first();

        $data = TravelPaymentsValidations::where('id',request()->id)->with([
            'travelPayment',
            'travelPayment.badasoUsers',
            'travelPayment.travelBookings',
        ])->first();
        $data = $data->travelPayment;
        return ApiResponse::onlyEntity($data);
    }


}
