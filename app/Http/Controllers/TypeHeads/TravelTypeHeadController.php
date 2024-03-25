<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class TravelTypeHeadController extends Controller
{
    function getUser() {
        $keyword = request()->keyword;
        return BadasoUsers::orWhere('name','like','%'.$keyword.'%')
            ->orWhere('email','like','%'.$keyword.'%')
            ->orWhere('phone','like','%'.$keyword.'%')
            ->limit(20)->get();
    }
    function edit_get_user() {
        $customer_id = DB::table('travel_reservations')->where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $customer_id)->limit(1)->first();
    }

    // FOR
    // http://localhost:8000/trevolia-dashboard/general/travel-tickets
    function edit_travel_tickets_customer_id() {
        $customer_id = \TravelTickets::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $customer_id)->limit(1)->first();
    }
    function list_travel_tickets_reservation_id() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('travel_reservations');

        $query = \TravelReservations::with([
            'user' => function($q) use ($keyword) {
                return $q;
            }])
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

        if(isAdmin()) {
            return $query = $query->limit(20)->get();
        }
        return $query = $query->where('customer_id',userId())->limit(20)->get();
    }
    function edit_travel_tickets_reservation_id() {
        $id = \TravelTickets::where('id', request()->id)->value('reservation_id');
        return \TravelReservations::with('user')->where('id',$id)->first();
    }

    // FOR
    // http://localhost:8000/trevolia-dashboard/general/travel-bookings
    function edit_travel_bookings_customer_id() {
        $id = \TravelTickets::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $id)->limit(1)->first();
    }
    function list_travel_bookings_ticket_id() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('travel_tickets');

        $query = \TravelTickets::with([
            'user' => function($q) use ($keyword) {
                return $q;
            }])
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

        if(isAdmin()) {
            return $query = $query->limit(20)->get();
        }

        return $query = $query->where('customer_id',userId())->limit(20)->get();
    }
    function edit_travel_bookings_ticket_id() {
        $id = \TravelBookings::where('id', request()->id)->value('ticket_id');
        return \TravelTickets::with('user')->where('id',$id)->first();
    }

    // Route::get('/search-travel-payments', 'TravelTypeHeadController@list_travel_payments_booking_id');
    // Route::get('/edit-travel-payments', 'TravelTypeHeadController@edit_travel_payments_booking_id');
    function list_travel_payments_booking_id() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('travel_bookings');

        $query = \TravelBookings::with([
            'user' => function($q) use ($keyword) {
                return $q;
            }])
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
    function edit_travel_payments_booking_id() {
        $id = \TravelPayments::where('id', request()->id)->value('booking_id');
        return \TravelBookings::with('user')->where('id',$id)->first();
    }

    // // travel-payments-validations
    // Route::get('/user-travel-payments-validations', 'TravelTypeHeadController@edit_travel_payments_validations_validator_id');
    // Route::get('/search-travel-payments-validations', 'TravelTypeHeadController@list_travel_payments_validations_payment_id');
    // Route::get('/edit-travel-payments-validations', 'TravelTypeHeadController@edit_travel_payments_validations_payment_id');
    function edit_travel_payments_validations_validator_id() {
        $id = \TravelPaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $id)->limit(1)->first();
    }
    function list_travel_payments_validations_payment_id() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('travel_payments');

        $query = \TravelPayments::with([
            'user' => function($q) use ($keyword) {
                return $q;
            }])
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
    function edit_travel_payments_validations_payment_id() {
        $id = \TravelPaymentsValidations::where('id', request()->id)->value('validator_id');
        return \TravelPayments::with('user')->where('id',$id)->first();
    }
}
