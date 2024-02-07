<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismCategories extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
