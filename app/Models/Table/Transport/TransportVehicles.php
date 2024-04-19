<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportVehicles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "transport_vehicles";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_rentals', 'id', 'user_id');
    }

    public function transportRentals()
    {
        return $this->belongsToMany(TransportRentals::class, 'transport_vehicles', 'id', 'rental_id');
    }

    public function transportRental()
    {
        return $this->belongsTo(TransportRentals::class,'rental_id','id');
    }

    public function transportBookings()
    {
        return $this->hasMany(TransportBookings::class, 'vehicle_id', 'id');
    }

    public function transportBooking()
    {
        return $this->hasOne(TransportBookings::class, 'vehicle_id', 'id');
    }

    public function transportMaintenances()
    {
        return $this->hasMany(TransportMaintenances::class, 'vehicle_id', 'id');
    }

    public function transportMaintenance()
    {
        return $this->hasOne(TransportMaintenances::class, 'vehicle_id', 'id');
    }


    public function transportPrice()
    {
        return $this->hasOne(TransportPrices::class, 'vehicle_id', 'id');
    }

    public function transportPrices()
    {
        return $this->hasMany(TransportPrices::class, 'vehicle_id', 'id');
    }
}
