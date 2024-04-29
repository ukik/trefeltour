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
use SouvenirPrices;

use SouvenirPaymentsValidations;
use SouvenirStores;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class SouvenirTypeHeadController extends Controller
{
    function getUser() {
        // if(isAdminSouvenir()) {
        //     return Auth::user();
        // }

        return SouvenirStores::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        // $temp = SouvenirStores::where('id', request()->id)->value('user_id');
        // return BadasoUsers::where('id', $temp)->first();
    }








    function dialog_product_souvenir_stores() {
        $data = \SouvenirProducts::where('id',request()->id)
            ->with('souvenirStore.badasoUsers')
            ->first();
        $data = $data->souvenirStore;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_souvenir_products() {
        $data = \SouvenirPrices::where('id',request()->id)
            ->with([
                'souvenirProduct.souvenirStores',
            ])
            ->first();
        $data = $data->souvenirProduct;
        return ApiResponse::onlyEntity($data);
    }







    function dialog_cart_price(Request $request) {
        // return request();
        $data = \SouvenirPrices::with([
            'souvenirStores',
            'souvenirStore',
            'souvenirProduct',
            'souvenirProducts',
        ])->where('id', request()->price_id)->first();
        return ApiResponse::onlyEntity($data);
    }


    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \SouvenirCarts::with([
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

    function add_to_cart(Request $request) {


        isAddOrUpdateToCart();

        DB::beginTransaction();

        try {
            // get slug by route name and get data type in table
            //$slug = getSlug($request);

            $data_type = getDataType('souvenir-prices'); // nama table

            if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

            $data = SouvenirPrices::where('id', request()->price_id)->first();

            $quantity = request()->quantity;

            $carts = SouvenirCarts::query()
                ->where('customer_id', request()->customer_id)
                ->where('price_id', request()->price_id)
                ->first();

            $carts = SouvenirCarts::updateOrCreate([
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

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties(['attributes' => [$carts]])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            return ApiResponse::onlyEntity([$carts]);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
        // return request();
    }

    function update_to_cart(Request $request) {

        isAddOrUpdateToCart();

        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        SouvenirCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \SouvenirCarts::with([
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













    function dialog_booking_souvenir_bookings() {

        $data = SouvenirBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'souvenirBookings',
            'souvenirBooking',
            'souvenirStore',
            'souvenirStores',
        ])
        ->withCount([
            'souvenirBookingItems AS quantity_sum' => function ($query) {
                    $query->select(DB::raw("CONCAT(SUM(quantity), ' barang') as paidsum"));
                }
            ])
        ->first();
        return ApiResponse::onlyEntity($data);
    }


    function dialog_booking_souvenir_payments_validations() {

        // $payment_id = SouvenirPaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = SouvenirBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'souvenirBookings',
        //     'souvenirBooking',
        //     'souvenirStore',
        //     'souvenirStores',
        // ])->first();

        $data = SouvenirPaymentsValidations::where('id',request()->id)->with([
            'souvenirPayment',
            'souvenirPayment.badasoUsers',
            'souvenirPayment.souvenirBookings',
        ])->first();
        $data = $data->souvenirPayment;
        return ApiResponse::onlyEntity($data);
    }


}
