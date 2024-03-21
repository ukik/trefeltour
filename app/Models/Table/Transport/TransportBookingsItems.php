<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportBookingsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "transport_booking_items";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_booking_items', 'id', 'customer_id');
    }

    public function transportBooking()
    {
        return $this->belongsTo(TransportBookings::class,'booking_id','id');
    }

    public function transportBookings()
    {
        return $this->belongsToMany(TransportBookings::class, 'transport_booking_items', 'id', 'booking_id');
    }

    public function transportRental()
    {
        return $this->belongsTo(TransportRentals::class,'rental_id','id');
    }

    public function transportRentals()
    {
        return $this->belongsToMany(TransportRentals::class, 'transport_booking_items', 'id', 'rental_id');
    }


    public function transportVehicle()
    {
        return $this->belongsTo(TransportVehicles::class,'vehicle_id','id');
    }

    public function transportVehicles()
    {
        return $this->belongsToMany(TransportVehicles::class, 'transport_booking_items', 'id', 'vehicle_id');
    }

}
