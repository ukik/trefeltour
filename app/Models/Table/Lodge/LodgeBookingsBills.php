<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeBookingsBills extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_booking_bills";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'lodge_booking_bills', 'id', 'customer_id');
    }


    public function lodgeBooking()
    {
        return $this->belongsTo(LodgeBookings::class,'booking_id','id');
    }

    public function lodgeBookings()
    {
        return $this->belongsToMany(LodgeBookings::class, 'lodge_booking_bills', 'id', 'booking_id');
    }
}
