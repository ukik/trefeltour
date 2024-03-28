<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelStores extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "travel_stores";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_stores', 'id', 'user_id');
    }

    public function travelBooking()
    {
        return $this->hasOne(TravelBookings::class, 'store_id', 'id');
    }

    public function travelBookings()
    {
        return $this->hasMany(TravelBookings::class, 'store_id', 'id');
    }

    public function travelTicket()
    {
        return $this->hasOne(TravelTickets::class, 'store_id', 'id');
    }

    public function travelTickets()
    {
        return $this->hasMany(TravelTickets::class, 'store_id', 'id');
    }
}
