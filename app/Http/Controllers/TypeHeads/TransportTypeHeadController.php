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

use Illuminate\Support\Facades\Validator;
use Exception;
use TransportCartsCalenders;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

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





    function dialog_rental_transport_vehicles() {
        $data = \TransportVehicles::where('id',request()->id)
            ->with([
                'transportRental',
            ])
            ->first();
        $data = $data->transportRental;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_vehicle_transport_maintenances() {
        $data = \TransportMaintenances::where('id',request()->id)
            ->with([
                'transportVehicle',
            ])
            ->first();
        $data = $data->transportVehicle;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_workshop_transport_maintenances() {
        $data = \TransportMaintenances::where('id',request()->id)
            ->with([
                'transportWorkshop',
            ])
            ->first();
        $data = $data->transportWorkshop;
        return ApiResponse::onlyEntity($data);
    }



    // function dialog_product_transport_stores() {
    //     $data = \TransportVehicles::where('id',request()->id)
    //         ->with('transportRental.badasoUsers')
    //         ->first();
    //     $data = $data->transportRental;
    //     return ApiResponse::onlyEntity($data);
    // }

    // function dialog_prices_transport_products() {
    //     $data = \TransportPrices::where('id',request()->id)
    //         ->with([
    //             'transportVehicle.transportRentals',
    //         ])
    //         ->first();
    //     $data = $data->transportVehicle;
    //     return ApiResponse::onlyEntity($data);
    // }

    function get_calender_booked(Request $request) {  // untuk transport rental

        # check dimulai hari ini dan seterusnya
        return $data = TransportCartsCalenders::query()
            ->where('vehicle_id', request()->vehicle_id)
            ->whereMonth('value_id', request()->month)
            ->whereYear('value_id', request()->year)
            ->with('badasoUser')
            ->get();

        //return ApiResponse::onlyEntity($data);
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

        DB::beginTransaction();

        try {
            // get slug by route name and get data type in table
            //$slug = getSlug($request);

            $data_type = getDataType('transport-carts'); // nama table

            if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

            $data = TransportPrices::where('id', request()->price_id)->first();

            $transport_carts_calenders = [];  // untuk transport rental
            $colors = ['gray','red','orange','yellow','green','teal','blue','indigo','purple','pink'];
            $color = $colors[array_rand($colors,1)];

            // lebih kecil dari hari ini akan di hapus
            $date_now = date("Y-m-d"); // this format is string comparable
            $date_in = json_decode(request()->date_checkin, true);
            $today_and_grater = [];
            foreach ($date_in as $value) {
                if ($date_now <= $value['id']) {
                    array_push($today_and_grater, $value);


                    $transport_carts_calenders[] = [
                        'customer_id' => request()->customer_id,
                        'rental_id' => $data->rental_id,
                        'vehicle_id' => $data->vehicle_id,
                        'price_id' => $data->id,

                        'value_id' => $value['id'],
                        'value_date' => $value['date'],
                        'color' => $color,
                        'code_table' => "transport-carts-calenders",
                    ];
                }
            }

            $quantity = request()->quantity;

            $carts = TransportCarts::query()
                ->where('customer_id', request()->customer_id)
                ->where('price_id', request()->price_id)
                ->first();

            $TransportCarts = TransportCarts::updateOrCreate([
                    'customer_id' => request()->customer_id,
                    'rental_id' => $data->rental_id,
                    'vehicle_id' => $data->vehicle_id,
                    'price_id' => $data->id,
                ],
                [
                    'customer_id' => request()->customer_id,
                    'rental_id' => $data->rental_id,
                    'vehicle_id' => $data->vehicle_id,
                    'price_id' => $data->id,
                    'quantity' => $quantity, // karena lama waktu nginap, jadi di replace  //!$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"),
                    'date_checkin' => json_encode($today_and_grater), //request()->date_checkin,
                    // 'date_checkout' => request()->date_checkout, // gak ada lagi
                    'code_table' => "transport-carts",
                    'uuid' => $carts?->uuid ?: ShortUuid(),
                ]
            );

            /*
            // untuk transport rental (TIDAK PERLU, SAAT checkout di cart aja)
            // ===================================================================
            # check dimulai hari ini dan seterusnya
            $GET_TransportCartsCalenders = TransportCartsCalenders::query()
                ->where('vehicle_id', $data->vehicle_id)
                ->whereDate('value_id', '>=', now())
                ->get();

            foreach ($GET_TransportCartsCalenders as $value1) {
                foreach ($transport_carts_calenders as $value2) {
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

            $TransportCartsCalenders = TransportCartsCalenders::insert($transport_carts_calenders);
            // $TransportCartsCalenders = TransportCartsCalenders::upsert(
            //     $transport_carts_calenders,
            //     uniqueBy: ['customer_id', 'rental_id', 'vehicle_id', 'price_id', 'value_id'],
            //     update: ['value_id','value_date']
            // );
            // ===================================================================
            */

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties(['attributes' => [$TransportCarts]])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            return ApiResponse::onlyEntity([$TransportCarts]);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }


    function update_to_cart(Request $request) {

        DB::beginTransaction();

        try {
            // get slug by route name and get data type in table
            //$slug = getSlug($request);

            $data_type = getDataType('transport-carts'); // nama table

            // return (request()->dateCheckIn);
            if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

            // $transport_carts_calenders = [];  // untuk transport rental
            // $colors = ['gray','red','orange','yellow','green','teal','blue','indigo','purple','pink'];
            // $color = $colors[array_rand($colors,1)];

            // lebih kecil dari hari ini akan di hapus
            $date_now = date("Y-m-d"); // this format is string comparable
            $date_in = json_decode(request()->dateCheckIn, true);
            $today_and_grater = [];
            foreach ($date_in as $value) {
                if ($date_now <= $value['id']) {
                    array_push($today_and_grater, $value);

                    // $transport_carts_calenders[] = [
                    //     'customer_id' => request()->customer_id,
                    //     'rental_id' => $data->rental_id,
                    //     'vehicle_id' => $data->vehicle_id,
                    //     'price_id' => $data->id,

                    //     'value_id' => $value['id'],
                    //     'value_date' => $value['date'],
                    //     'color' => $color,
                    //     'code_table' => "transport-carts-calenders",
                    // ];
                }
            }

            $TransportCarts = TransportCarts::where('id', request()->id)->update([
                    'quantity' => request()->quantity,
                    'date_checkin' => json_encode($today_and_grater),
            ]);


            /*
            // untuk transport rental (TIDAK PERLU, SAAT checkout di cart aja)
            // ===================================================================
            # check dimulai hari ini dan seterusnya
            $GET_TransportCartsCalenders = TransportCartsCalenders::query()
                ->where('vehicle_id', $data->vehicle_id)
                ->whereDate('value_id', '>=', now())
                ->get();

            foreach ($GET_TransportCartsCalenders as $value1) {
                foreach ($transport_carts_calenders as $value2) {
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

            $TransportCartsCalenders = TransportCartsCalenders::insert($transport_carts_calenders);
            // $TransportCartsCalenders = TransportCartsCalenders::upsert(
            //     $transport_carts_calenders,
            //     uniqueBy: ['customer_id', 'rental_id', 'vehicle_id', 'price_id', 'value_id'],
            //     update: ['value_id','value_date']
            // );
            // ===================================================================
            */


            $data = \TransportCarts::with([
                'badasoUsers',
                'badasoUser',
                'transportVehicle',
                'transportVehicles',
                'transportPrice',
                'transportPrices',
                'transportRental',
                'transportRentals',
            ])->orderBy('id','desc');
            if(request()['showSoftDelete'] == 'true') {
                $data = $data->onlyTrashed();
            }
            $data = $data->paginate(request()->perPage);

            // $encode = json_encode($paginate);
            // $decode = json_decode($encode);
            // $data['data'] = $decode->data;
            // $data['total'] = $decode->total;

            activity($data_type->display_name_singular)
                ->causedBy(auth()->user() ?? null)
                ->withProperties(['attributes' => [$TransportCarts]])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
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
