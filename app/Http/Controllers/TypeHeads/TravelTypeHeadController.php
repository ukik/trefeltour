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
        // if(isAdminTravel()) {
        //     return Auth::user();
        // }

        return TravelStores::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        // $temp = TravelReservations::where('id', request()->id)->value('user_id');
        // return BadasoUsers::where('id', $temp)->first();
    }

    function travel_stores_dialog_user() {
        // if(isAdminTravel()) {
        //     return Auth::user();
        // }

        return TravelStores::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];
    }

    function travel_reservations_dialog_user() {
        // if(isAdminTravel()) {
        //     return Auth::user();
        // }

        return TravelReservations::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];
    }








    function dialog_prices_travel_stores() {
        $data = \TravelPrices::where('id',request()->id)
            ->with([
                'travelStore',
            ])
            ->first();
        $data = $data->travelStore;
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




    function dialog_cart_price(Request $request) {
        // return request();
        $data = \TravelPrices::with([
            'badasoUser',
            'badasoUsers',
            'travelStores',
            'travelStore',
            'travelReservation',
            'travelReservations',
            'travelCart',
            'travelCarts',
        ])->where('id', request()->price_id)->first();
        return ApiResponse::onlyEntity($data);
    }



    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);

        $data = \TravelCarts::with([
            'badasoUsers',
            'badasoUser',
            'travelPrice',
            'travelPrices',
            'travelReservation',
            'travelReservations',
            'travelStore',
            'travelStores',
        ])->whereIn('id', $payload)->get();

        // $data = \TravelCarts::whereIn('id', $payload)->select('price_id')->pluck('price_id');
        // $data = TravelPrices::whereIn('id', $data)
        //     ->with([
        //         'badasoUser',
        //         'travelStore',
        //         'travelReservation'
        //     ])->get();

        return ApiResponse::onlyEntity($data);
    }


    function add_to_cart(Request $request) {

        isAddOrUpdateToCart();

        DB::beginTransaction();

        try {
            // get slug by route name and get data type in table
            //$slug = getSlug($request);

            $data_type = getDataType('travel-carts'); // nama table

            if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

            $data = TravelPrices::where('id', request()->price_id)->first();

            $carts = TravelCarts::query()
                ->where('customer_id', request()->customer_id)
                ->where('price_id', request()->price_id)
                ->first();

            if($carts) return ApiResponse::failed("Data ini sudah di keranjang");

            $carts = TravelCarts::updateOrCreate([
                    'customer_id' => request()->customer_id,
                    'reservation_id' => $data->reservation_id,
                    'store_id' => $data->store_id,
                    'price_id' => $data->id,
                ],
                [
                    'customer_id' => request()->customer_id,
                    'reservation_id' => $data->reservation_id,
                    'store_id' => $data->store_id,
                    'price_id' => $data->id,
                    'quantity' => 1,
                    'code_table' => "travel-carts",
                    'uuid' => $carts?->uuid ?: ShortUuid(),
                ]
            );

            /*
            // untuk travel rental (TIDAK PERLU, SAAT checkout di cart aja)
            // ===================================================================
            # check dimulai hari ini dan seterusnya
            $GET_TravelCartsCalenders = TravelCartsCalenders::query()
                ->where('vehicle_id', $data->vehicle_id)
                ->whereDate('value_id', '>=', now())
                ->get();

            foreach ($GET_TravelCartsCalenders as $value1) {
                foreach ($travel_carts_calenders as $value2) {
                    # code...
                    if(
                        $value1['value_id'] == $value2['value_id'] &&
                        $value1['vehicle_id'] == $value2['vehicle_id']
                    ) {
                        return ApiResponse::failed("Tanggal $value1->value_id sudah dipakai");
                        break;
                    }
                }
                # code...
            }

            $TravelCartsCalenders = TravelCartsCalenders::insert($travel_carts_calenders);
            // $TravelCartsCalenders = TravelCartsCalenders::upsert(
            //     $travel_carts_calenders,
            //     uniqueBy: ['customer_id', 'rental_id', 'vehicle_id', 'price_id', 'value_id'],
            //     update: ['value_id','value_date']
            // );
            // ===================================================================
            */

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
    }


    function update_to_cart(Request $request) {

        isAddOrUpdateToCart();

        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        TravelCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \TravelCarts::with([
            'badasoUsers',
            'badasoUser',
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
            'travelStore',
            'travelStores',
            // 'travelReservation',
            // 'travelReservations',
        ])
        ->withCount([
            'travelBookingItems AS quantity_sum' => function ($query) {
                    $query->select(DB::raw("CONCAT(SUM(quantity), ' tiket') as paidsum")); //->where('status', 'paid');
                }
            ])
        ->first();
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
