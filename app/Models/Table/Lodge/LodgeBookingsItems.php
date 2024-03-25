<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeBookingsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_booking_items";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'lodge_booking_items', 'id', 'customer_id');
    }

    public function lodgeBooking()
    {
        return $this->belongsTo(LodgeBookings::class,'booking_id','id');
    }

    public function lodgeBookings()
    {
        return $this->belongsToMany(LodgeBookings::class, 'lodge_booking_items', 'id', 'booking_id');
    }

    public function lodgeProfile()
    {
        return $this->belongsTo(LodgeProfiles::class,'profile_id','id');
    }

    public function lodgeProfiles()
    {
        return $this->belongsToMany(LodgeProfiles::class, 'lodge_booking_items', 'id', 'profile_id');
    }


    public function lodgeRoom()
    {
        return $this->belongsTo(LodgeRooms::class,'room_id','id');
    }

    public function lodgeRooms()
    {
        return $this->belongsToMany(LodgeRooms::class, 'lodge_booking_items', 'id', 'room_id');
    }

}
