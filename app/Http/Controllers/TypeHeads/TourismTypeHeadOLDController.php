<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TourismBookings;
use TourismPayments;
use TourismPaymentsValidations;
use TourismVenues;
use Uasoft\Badaso\Helpers\ApiResponse;

class TourismTypeHeadOLDController extends Controller
{
    function getUser() {
        $keyword = request()->keyword;

        if(isAdminTourism()) {
            return Auth::user();
        }

        if(!request()['keyword']) {
            $temp = TourismVenues::where('id', request()->id)->value('user_id');
            return BadasoUsers::where('id', $temp)->first();
        }

        return BadasoUsers::orWhere('name','like','%'.$keyword.'%')
            ->orWhere('email','like','%'.$keyword.'%')
            ->orWhere('phone','like','%'.$keyword.'%')
            ->limit(20)->get();
    }

    function getUserBookingEdit() {
        $keyword = request()->keyword;

        if(isAdminTourism()) {
            return Auth::user();
        }

        $temp = TourismBookings::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserPaymentValidationEdit() {
        $keyword = request()->keyword;

        if(isAdminTourism()) {
            return Auth::user();
        }

        $validator_id = TourismPaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $validator_id)->first();
    }

    function dialog_venue_tourism_venues() {
        $venue_id = \TourismFacilities::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_services() {
        $venue_id = \TourismServices::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_prices() {
        $venue_id = \TourismPrices::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_facilities() {
        $venue_id = \TourismFacilities::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_venue_tourism_bookings() {
        $venue_id = \TourismBookings::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
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

        $payment_id = \TourismPaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = \TourismBookingsCheckPayments::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'tourismBookings',
            'tourismBooking',
            'tourismVenue',
            'tourismVenues',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }



    function tourism_bookings() {

        if(request()->id && !request()['keyword'] && !request()['label']) {
            $data = \TourismBookingsCheckPayments::where('id',request()->id)->with([
                'badasoUsers',
                'tourismBookings',
                'tourismBooking',
                'tourismVenue',
                'tourismVenues',
            ])->first();
            return ApiResponse::onlyEntity($data);
        }
    }


    /*
    // MAINTENANCE
    function tourism_maintenances() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('tourism_maintenances');

        $query = \TransportMaintenances::query();

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        return $query = $query->limit(20)->get();
    }



    // RENTAL
    function tourism_rentals() {
        $keyword = request()->keyword;

        if(isAdminTourism() && !request()['keyword']) {
           return \TransportRentals::where('user_id',Auth::user()->id)->first();
        }

        $columns = Schema::getColumnListing('tourism_rentals');

        $query = \TransportRentals::where('is_available','true');

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        return $query = $query->limit(20)->get();
    }

    // RETURN
    function tourism_returns() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('tourism_returns');

        $query = \TransportRentals::where('is_available','true');

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        return $query = $query->limit(20)->get();
    }


    // VEHICLE
    function tourism_vehicles() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword']) {
            return \TransportVehicles::where('id',request()->id)->first();
        }


        $columns = Schema::getColumnListing('tourism_vehicles');

        $query = \TransportVehicles::where('is_available','true');

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        if(isAdminTourism()) {
            return $query = $query->where('user_id',Auth::user()->id)->limit(20)->get();
        }

        return $query = $query->limit(20)->get();
    }

    // WORKSHOP
    function tourism_workshops() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword']) {
            $workshop_id = \TransportMaintenances::where('id',request()->id)->value('workshop_id');
            return \TransportWorkshops::where('id',$workshop_id)->first();
        }

        $columns = Schema::getColumnListing('tourism_workshops');

        $query = \TransportWorkshops::query();

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        if(isAdminTourism()) {
            return $query = $query->where('user_id',Auth::user()->id)->limit(20)->get();
        }

        return $query = $query->limit(20)->get();
    }



    // PAYMENT
    function tourism_payments() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword'] && !request()['label']) {
            $check = \ViewTransportPaymentsCheckValidations::where('id',request()->id)->with('user')->first();
            return $check;
        }

        $columns = Schema::getColumnListing('view_tourism_payments_check_validations');

        $query = \ViewTransportPaymentsCheckValidations::with([
            'transportBooking',
            'user' => function($q) use ($keyword) {
                return $q;
            }])
        ->whereHas("transportBooking",function($q) use ($keyword) {
            $columns = Schema::getColumnListing('tourism_bookings');
            foreach ($columns as $value) {
                switch ($value) {
                    case "code_table":
                    case "created_at":
                    case "updated_at":
                    case "deleted_at":
                        # code...
                        break;
                    default:
                        $q->orWhere($value,'like','%'.$keyword.'%');
                        break;
                }
            }
            return $q;
        })
        ->whereHas("user",function($q) use ($keyword) {
            return $q
                ->where('email','like','%'.$keyword.'%')
                ->orWhere('name','like','%'.$keyword.'%')
                ->orWhere('phone','like','%'.$keyword.'%');
        });

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        return $query = $query->limit(20)->get();
    }

    function tourism_payments_validationsXXX() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('tourism_payments_validations');

        $query = \TransportPaymentsValidations::with([
            'transportPayment' => function($q) use ($keyword) {
                return $q;
            }])
        ->whereHas("transportPayment",function($q) use ($keyword) {
            $columns = Schema::getColumnListing('tourism_payments');
            foreach ($columns as $value) {
                switch ($value) {
                    case "code_table":
                    case "created_at":
                    case "updated_at":
                    case "deleted_at":
                        # code...
                        break;
                    default:
                        $q->orWhere($value,'like','%'.$keyword.'%');
                        break;
                }
            }
            return $q;
        });

        foreach ($columns as $value) {
            switch ($value) {
                case "code_table":
                case "created_at":
                case "updated_at":
                case "deleted_at":
                    # code...
                    break;
                default:
                    $query->orWhere($value,'like','%'.$keyword.'%');
                    break;
            }
        }

        return $query = $query->limit(20)->get();
    }
    */

}
