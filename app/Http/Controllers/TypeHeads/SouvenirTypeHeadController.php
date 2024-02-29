<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use SouvenirBookings;
use SouvenirBookingsCheckPayments;
use SouvenirCarts;
use SouvenirPaymentsValidations;
use SouvenirPrices;
use TalentBookings;

use TalentPaymentsValidations;
use TalentProfiles;
use Uasoft\Badaso\Helpers\ApiResponse;

class SouvenirTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $temp = TalentProfiles::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserBookingEdit() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $temp = TalentBookings::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserPaymentValidationEdit() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $validator_id = TalentPaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $validator_id)->first();
    }

    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \SouvenirCarts::with([
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

    function dialog_product_souvenir_stores() {
        $data = \SouvenirProducts::where('id',request()->id)
            ->with('souvenirStore.badasoUsers')
            ->first();
        $data = $data->souvenirStore;
        return ApiResponse::onlyEntity($data);

        // $id = \SouvenirProducts::where('id',request()->id)->value('store_id');
        // $data = \SouvenirStores::where('id',$id)->with([
        //     'badasoUsers',
        //     'badasoUser',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_souvenir_products() {
        $data = \SouvenirPrices::where('id',request()->id)
            ->with([
                'souvenirProduct.souvenirStores',
            ])
            ->first();
        $data = $data->souvenirProduct;
        return ApiResponse::onlyEntity($data);

        // $skill_id = \TalentPrices::where('id',request()->id)->value('skill_id');
        // $data = \TalentSkills::where('id',$skill_id)->with([
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

        $data = SouvenirPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = SouvenirCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        SouvenirCarts::updateOrCreate([
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

        SouvenirCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \SouvenirCarts::with([
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

        $data = SouvenirBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'souvenirBookings',
            'souvenirBooking',
            'souvenirStore',
            'souvenirStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_souvenir_payments_validations() {

        $payment_id = SouvenirPaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = SouvenirBookingsCheckPayments::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'souvenirBookings',
            'souvenirBooking',
            'souvenirStore',
            'souvenirStores',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


}
