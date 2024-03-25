<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportCartsCalenders extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = "transport_carts_calenders";

    public $fillable = [
        'customer_id',
        'rental_id',
        'vehicle_id',
        'price_id',
        'value_id',
        'value_date',
        'color',
        'code_table',
    ];

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_carts_calenders', 'id', 'customer_id');
    }

    public function transportRental()
    {
        return $this->belongsTo(TransportRentals::class,'rental_id','id');
    }

    public function transportRentals()
    {
        return $this->belongsToMany(TransportRentals::class, 'transport_carts_calenders', 'id', 'rental_id');
    }

    public function transportVehicle()
    {
        return $this->belongsTo(TransportVehicles::class,'vehicle_id','id');
    }

    public function transportVehicles()
    {
        return $this->belongsToMany(TransportVehicles::class, 'transport_carts_calenders', 'id', 'vehicle_id');
    }

    public function transportPrice()
    {
        return $this->belongsTo(TransportPrices::class,'price_id','id');
    }

    public function transportPrices()
    {
        return $this->belongsToMany(TransportPrices::class, 'transport_carts_calenders', 'id', 'price_id');
    }
}
