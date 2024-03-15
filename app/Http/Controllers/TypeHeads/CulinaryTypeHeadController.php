<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use CulinaryBookings;
use CulinaryBookingsCheckPayments;
use CulinaryCarts;
use CulinaryPrices;

use CulinaryPaymentsValidations;
use CulinaryStores;
use Uasoft\Badaso\Helpers\ApiResponse;

class CulinaryTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminCulinary()) {
            return Auth::user();
        }

        $temp = CulinaryStores::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserBookingEdit() {
        if(isAdminCulinary()) {
            return Auth::user();
        }

        $temp = CulinaryBookings::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserPaymentValidationEdit() {
        if(isAdminCulinary()) {
            return Auth::user();
        }

        $validator_id = CulinaryPaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $validator_id)->first();
    }

    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \CulinaryCarts::with([
            // 'culinaryStore.culinaryBooking.badasoUsers',
            // 'culinaryStore.culinaryBooking.badasoUser',
            // 'culinaryStore.culinaryBookings',
            'badasoUsers',
            'badasoUser',

            'culinaryProduct',
            'culinaryProducts',
            'culinaryPrice',
            'culinaryPrices',
            'culinaryStore',
            'culinaryStores',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_product_culinary_stores() {
        $data = \CulinaryProducts::where('id',request()->id)
            ->with('culinaryStore.badasoUsers')
            ->first();
        $data = $data->culinaryStore;
        return ApiResponse::onlyEntity($data);

        // $id = \CulinaryProducts::where('id',request()->id)->value('store_id');
        // $data = \CulinaryStores::where('id',$id)->with([
        //     'badasoUsers',
        //     'badasoUser',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_culinary_products() {
        $data = \CulinaryPrices::where('id',request()->id)
            ->with([
                'culinaryProduct.culinaryStores',
            ])
            ->first();
        $data = $data->culinaryProduct;
        return ApiResponse::onlyEntity($data);

        // $skill_id = \CulinaryPrices::where('id',request()->id)->value('skill_id');
        // $data = \CulinarySkills::where('id',$skill_id)->with([
        //     'talentProfile',
        //     'talentProfiles',
        //     'talentProfile.badasoUser',
        //     'talentPrice',
        //     'talentPrices',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
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

        $data = CulinaryPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = CulinaryCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        CulinaryCarts::updateOrCreate([
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
                'code_table' => "culinary-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        CulinaryCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \CulinaryCarts::with([
            // 'culinaryStore.culinaryBooking.badasoUsers',
            // 'culinaryStore.culinaryBooking.badasoUser',
            // 'culinaryStore.culinaryBookings',
            'badasoUsers',
            'badasoUser',

            'culinaryProduct',
            'culinaryProducts',
            'culinaryPrice',
            'culinaryPrices',
            'culinaryStores',
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


    function dialog_booking_culinary_bookings() {

        $data = CulinaryBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'culinaryBookings',
            'culinaryBooking',
            'culinaryStore',
            'culinaryStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_culinary_payments_validations() {

        $payment_id = CulinaryPaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = CulinaryBookingsCheckPayments::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'culinaryBookings',
            'culinaryBooking',
            'culinaryStore',
            'culinaryStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


}
