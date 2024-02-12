<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportReturns extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function transportBookings()
    {
        return $this->belongsToMany(TransportBookings::class, 'transport_returns', 'id', 'booking_id');
    }

    public function transportBooking()
    {
        return $this->belongsTo(TransportBookings::class,'booking_id','id');
    }

    public function transportDrivers()
    {
        return $this->belongsToMany(TransportDrivers::class, 'transport_returns', 'id', 'driver_id');
    }

    public function transportDriver()
    {
        return $this->belongsTo(TransportDrivers::class,'driver_id','id');
    }
}
