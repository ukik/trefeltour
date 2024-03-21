<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TransportBookings;
use TransportBookingsCheckPayments;
use TransportCarts;
use TransportPrices;

use TransportPaymentsValidations;
use TransportRentals;
use Uasoft\Badaso\Helpers\ApiResponse;

class TransportTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTransport()) {
            return Auth::user();
        }

        return TransportRentals::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        $temp = TransportRentals::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }




    function dialog_product_transport_stores() {
        $data = \TransportVehicles::where('id',request()->id)
            ->with('transportRental.badasoUsers')
            ->first();
        $data = $data->transportRental;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_transport_products() {
        $data = \TransportPrices::where('id',request()->id)
            ->with([
                'transportVehicle.transportRentals',
            ])
            ->first();
        $data = $data->transportVehicle;
        return ApiResponse::onlyEntity($data);
    }



    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \TransportCarts::with([
            'badasoUsers',
            'badasoUser',

            'transportVehicle',
            'transportVehicles',
            'transportPrice',
            'transportPrices',
            'transportRental',
            'transportRentals',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }

    function add_to_cart(Request $request) {

        if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

        $data = TransportPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = TransportCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        TransportCarts::updateOrCreate([
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
                'code_table' => "transport-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        TransportCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \TransportCarts::with([
            'badasoUsers',
            'badasoUser',

            'transportVehicle',
            'transportVehicles',
            'transportPrice',
            'transportPrices',
            'transportRentals',
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





    function dialog_booking_transport_bookings() {

        $data = TransportBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'transportBookings',
            'transportBooking',
            'transportRental',
            'transportRentals',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_transport_payments_validations() {

        // $payment_id = TransportPaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = TransportBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'transportBookings',
        //     'transportBooking',
        //     'transportRental',
        //     'transportRentals',
        // ])->first();

        $data = TransportPaymentsValidations::where('id',request()->id)->with([
            'souvenirPayment',
            'souvenirPayment.badasoUsers',
            'souvenirPayment.souvenirBookings',
        ])->first();
        $data = $data->souvenirPayment;
        return ApiResponse::onlyEntity($data);
    }


}
