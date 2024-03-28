<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBookingsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // uuid
    // store_id
    // booking_id
    // ticket_id
    // name
    // get_price
    // get_discount
    // get_cashback
    // get_total_amount
    // quantity
    // get_final_amount
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "travel_booking_items";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_booking_items', 'id', 'customer_id');
    }

    public function travelBooking()
    {
        return $this->belongsTo(TravelBookings::class,'booking_id','id');
    }

    public function travelBookings()
    {
        return $this->belongsToMany(TravelBookings::class, 'travel_booking_items', 'id', 'booking_id');
    }

    public function travelStore()
    {
        return $this->belongsTo(TravelStores::class,'store_id','id');
    }

    public function travelStores()
    {
        return $this->belongsToMany(TravelStores::class, 'travel_booking_items', 'id', 'store_id');
    }


    public function travelTicket()
    {
        return $this->belongsTo(TravelTickets::class,'ticket_id','id');
    }

    public function travelTickets()
    {
        return $this->belongsToMany(TravelTickets::class, 'travel_booking_items', 'id', 'ticket_id');
    }

}
