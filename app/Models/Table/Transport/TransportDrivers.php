<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportDrivers extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_drivers', 'id', 'user_id');
    }

    public function transportReturns()
    {
        return $this->hasMany(TransportReturns::class, 'driver_id', 'id');
    }

    public function transportReturn()
    {
        return $this->hasOne(TransportReturns::class, 'driver_id', 'id');
    }


    public function transportBookings()
    {
        return $this->hasMany(TransportBookings::class, 'driver_id', 'id');
    }

    public function transportBooking()
    {
        return $this->hasOne(TransportBookings::class, 'driver_id', 'id');
    }

}
