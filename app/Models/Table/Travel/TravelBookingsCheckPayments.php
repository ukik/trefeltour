<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBookingsCheckPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    // booking_id
    // payment_id
    // payment_uuid
    // id
    // customer_id
    // store_id
    // uuid
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at
    // get_final_amount

    protected $table = "travel_bookings_check_payments";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_bookings_check_payments', 'id', 'customer_id');
    }


    public function travelBooking()
    {
        return $this->belongsTo(TravelBookings::class,'booking_id','id');
    }

    public function travelBookings()
    {
        return $this->belongsToMany(TravelBookings::class, 'travel_bookings_check_payments', 'id', 'booking_id');
    }

    public function travelStore()
    {
        return $this->belongsTo(TravelStores::class,'store_id','id');
    }

    public function travelStores()
    {
        return $this->belongsToMany(TravelStores::class, 'travel_bookings_check_payments', 'id', 'store_id');
    }
}