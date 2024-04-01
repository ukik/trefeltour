<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TransportCarts;
use Uasoft\Badaso\Helpers\ApiResponse;


class TransportTypeHeadControllerOLD extends Controller
{
    function getUser() {
        $keyword = request()->keyword;

        if(isAdminTransport()) {
            return Auth::user();
        }

        return BadasoUsers::orWhere('name','like','%'.$keyword.'%')
            ->orWhere('email','like','%'.$keyword.'%')
            ->orWhere('phone','like','%'.$keyword.'%')
            ->limit(20)->get();
    }

    // DRIVER
    function transport_drivers() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword']) {
            return \TransportDrivers::where('id',request()->id)->with('user')->first();
        }

        $columns = Schema::getColumnListing('transport_drivers');

        $query = \TransportDrivers::with([
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


    // MAINTENANCE
    function transport_maintenances() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('transport_maintenances');

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
    function transport_rentals() {
        $keyword = request()->keyword;

        if(isAdminTransport() && !request()['keyword']) {
           return \TransportRentals::where('user_id',Auth::user()->id)->first();
        }

        $columns = Schema::getColumnListing('transport_rentals');

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
    function transport_returns() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('transport_returns');

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
    function transport_vehicles() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword']) {
            return \TransportVehicles::where('id',request()->id)->first();
        }


        $columns = Schema::getColumnListing('transport_vehicles');

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

        if(isAdminTransport()) {
            return $query = $query->where('user_id',Auth::user()->id)->limit(20)->get();
        }

        return $query = $query->limit(20)->get();
    }

    // WORKSHOP
    function transport_workshops() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword']) {
            $workshop_id = \TransportMaintenances::where('id',request()->id)->value('workshop_id');
            return \TransportWorkshops::where('id',$workshop_id)->first();
        }

        $columns = Schema::getColumnListing('transport_workshops');

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

        if(isAdminTransport()) {
            return $query = $query->where('user_id',Auth::user()->id)->limit(20)->get();
        }

        return $query = $query->limit(20)->get();
    }



    function dialog_cart_price(Request $request) {
        // return request();
        $data = \TransportCarts::with([
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


    function transport_bookings() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword'] && !request()['label']) {
            $check = \ViewTransportBookingsCheckPayments::where('id',request()->id)->with('user')->first();
            return $check;
        }

        if(request()['label'] == 'transport-returns') {
            $check = \ViewTransportBookingsCheckPayments::where('id',request()->id)->with('user')->first();
            return \TransportDrivers::where('id',$check?->driver_id)->with('user')->first();
        }

        $columns = Schema::getColumnListing('view_transport_bookings_check_payments');

        $query = \ViewTransportBookingsCheckPayments::with([
            'user' => function($q) use ($keyword) {
                return $q;
            }])
        ->whereHas("user",function($q) use ($keyword) {
            return $q
                ->where('email','like','%'.$keyword.'%')
                ->orWhere('name','like','%'.$keyword.'%')
                ->orWhere('phone','like','%'.$keyword.'%');
        })
        ->where('booking_id',NULL);

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

        if(isAdminTransport()) {
            return $query = $query->where('customer_id',userId())->limit(20)->get();
        }

        return $query = $query->limit(20)->get();
    }

    // PAYMENT
    function transport_payments() {
        $keyword = request()->keyword;

        if(request()->id && !request()['keyword'] && !request()['label']) {
            $check = \ViewTransportPaymentsCheckValidations::where('id',request()->id)->with('user')->first();
            return $check;
        }

        $columns = Schema::getColumnListing('view_transport_payments_check_validations');

        $query = \ViewTransportPaymentsCheckValidations::with([
            'transportBooking',
            'user' => function($q) use ($keyword) {
                return $q;
            }])
        ->whereHas("transportBooking",function($q) use ($keyword) {
            $columns = Schema::getColumnListing('transport_bookings');
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

    function transport_payments_validations() {
        $keyword = request()->keyword;

        $columns = Schema::getColumnListing('transport_payments_validations');

        $query = \TransportPaymentsValidations::with([
            'transportPayment' => function($q) use ($keyword) {
                return $q;
            }])
        ->whereHas("transportPayment",function($q) use ($keyword) {
            $columns = Schema::getColumnListing('transport_payments');
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

}
