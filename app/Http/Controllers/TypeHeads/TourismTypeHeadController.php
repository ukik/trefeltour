<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TourismBookings;
use TourismCarts;
use TourismPrices;

use TourismPaymentsValidations;
use TourismVenues;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class TourismTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTourism()) {
            return Auth::user();
        }

        return TourismVenues::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        $temp = TourismVenues::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }



    function dialog_venue_tourism_venues() {
        $data = \TourismFacilities::where('id',request()->id)
            ->with([
                'tourismVenue',
            ])
            ->first();
        $data = $data->tourismVenue;
        return ApiResponse::onlyEntity($data);

        // $venue_id = \TourismFacilities::where('id',request()->id)->value('venue_id');
        // $data = \TourismVenues::where('id',$venue_id)->with([
        //     'badasoUsers',
        //     // 'tourismPrice',
        //     'tourismPrices',
        //     'tourismFacility',
        //     'tourismFacilities',
        //     'tourismService',
        //     'tourismServices',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_services() {
        $data = \TourismServices::where('id',request()->id)
            ->with([
                'tourismVenue',
            ])
            ->first();
        $data = $data->tourismVenue;
        return ApiResponse::onlyEntity($data);

        // $venue_id = \TourismServices::where('id',request()->id)->value('venue_id');
        // $data = \TourismVenues::where('id',$venue_id)->with([
        //     'badasoUsers',
        //     // 'tourismPrice',
        //     'tourismPrices',
        //     'tourismFacility',
        //     'tourismFacilities',
        //     'tourismService',
        //     'tourismServices',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_prices() {
        $data = \TourismPrices::where('id',request()->id)
            ->with([
                'tourismVenue',
            ])
            ->first();
        $data = $data->tourismVenue;
        return ApiResponse::onlyEntity($data);

        // $venue_id = \TourismPrices::where('id',request()->id)->value('venue_id');
        // $data = \TourismVenues::where('id',$venue_id)->with([
        //     'badasoUsers',
        //     // 'tourismPrice',
        //     'tourismPrices',
        //     'tourismFacility',
        //     'tourismFacilities',
        //     'tourismService',
        //     'tourismServices',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_facilities() {
        $data = \TourismFacilities::where('id',request()->id)
            ->with([
                'tourismVenue',
            ])
            ->first();
        $data = $data->tourismVenue;
        return ApiResponse::onlyEntity($data);

        // $venue_id = \TourismFacilities::where('id',request()->id)->value('venue_id');
        // $data = \TourismVenues::where('id',$venue_id)->with([
        //     'badasoUsers',
        //     // 'tourismPrice',
        //     'tourismPrices',
        //     'tourismFacility',
        //     'tourismFacilities',
        //     'tourismService',
        //     'tourismServices',
        // ])->first();
        // return ApiResponse::onlyEntity($data);
    }




    function dialog_cart_price(Request $request) {
        // return request();
        $data = \TourismPrices::with([
            'tourismVenues',
            'tourismVenue',
        ])->where('id', request()->price_id)->first();
        return ApiResponse::onlyEntity($data);
    }




    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \TourismCarts::with([
            'badasoUsers',
            'badasoUser',

            'tourismVenues',
            'tourismPrice',
            'tourismPrices',
            'tourismVenue.tourismFacility',
            'tourismVenue.tourismFacilities',
            'tourismVenue.tourismService',
            'tourismVenue.tourismServices',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }

    function add_to_cart(Request $request) {

        if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

        $data = TourismPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = TourismCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        TourismCarts::updateOrCreate([
                'customer_id' => request()->customer_id,
                'venue_id' => $data->venue_id,
                'price_id' => $data->id,
            ],
            [
                'customer_id' => request()->customer_id,
                'venue_id' => $data->venue_id,
                'price_id' => $data->id,
                'quantity' => !$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"), //DB::raw("quantity + $quantity"),
                'code_table' => "talent-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        TourismCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \TourismCarts::with([
            'badasoUsers',
            'badasoUser',

            'tourismVenues',
            'tourismPrice',
            'tourismPrices',
            'tourismVenue.tourismFacility',
            'tourismVenue.tourismFacilities',
            'tourismVenue.tourismService',
            'tourismVenue.tourismServices',
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





























    function dialog_booking_tourism_bookings() {

        $data = \TourismBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'tourismBookings',
            'tourismBooking',
            'tourismVenue',
            'tourismVenues',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_tourism_payments_validations() {

        // $payment_id = \TourismPaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = \TourismBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'tourismBookings',
        //     'tourismBooking',
        //     'tourismPrice',
        //     'tourismPrices',
        //     'tourismSkill',
        //     'tourismSkills',
        // ])->first();

        $data = TourismPaymentsValidations::where('id',request()->id)->with([
            'tourismPayment',
            'tourismPayment.badasoUsers',
            'tourismPayment.tourismBookings',
        ])->first();
        $data = $data->tourismPayment;
        return ApiResponse::onlyEntity($data);
    }


}
