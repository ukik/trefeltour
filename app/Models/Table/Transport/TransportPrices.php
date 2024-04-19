<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportPrices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "transport_prices";

    public function transportRental()
    {
        return $this->belongsTo(TransportRentals::class,'vehicle_id','id');
    }

    public function transportRentals()
    {
        return $this->belongsToMany(TransportRentals::class, 'transport_prices', 'id', 'vehicle_id');
    }

    public function transportVehicle()
    {
        return $this->belongsTo(TransportVehicles::class,'vehicle_id','id');
    }

    public function transportVehicles()
    {
        return $this->belongsToMany(TransportVehicles::class, 'transport_prices', 'id', 'vehicle_id');
    }


    public function transportCart()
    {
        return $this->hasOne(TransportCarts::class, 'price_id', 'id');
    }

    public function transportCarts()
    {
        return $this->hasMany(TransportCarts::class, 'price_id', 'id');
    }
}
