<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table\BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypeHeadController extends Controller
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
            $query->orWhere($value,'like','%'.$keyword.'%');
        }

        if(isAdmin() || isSuperAdmin()) {
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
        $customer_id = \TravelTickets::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $customer_id)->limit(1)->first();
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
            $query->orWhere($value,'like','%'.$keyword.'%');
        }

        if(isAdmin() || isSuperAdmin()) {
            return $query = $query->limit(20)->get();
        }
        return $query = $query->where('customer_id',userId())->limit(20)->get();
    }
    function edit_travel_bookings_ticket_id() {
        $id = \TravelBookings::where('id', request()->id)->value('ticket_id');
        return \TravelTickets::with('user')->where('id',$id)->first();
    }


}
