<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelCarts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "travel_carts";

    public $fillable = [
        'customer_id',
        'store_id',
        'ticket_id',
        'price_id',
        'quantity',
        'description',
        'code_table',
    ];

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_carts', 'id', 'customer_id');
    }

    public function travelStore()
    {
        return $this->belongsTo(TravelStores::class,'store_id','id');
    }

    public function travelStores()
    {
        return $this->belongsToMany(TravelStores::class, 'travel_carts', 'id', 'store_id');
    }

    public function travelTicket()
    {
        return $this->belongsTo(TravelTickets::class,'ticket_id','id');
    }

    public function travelTickets()
    {
        return $this->belongsToMany(TravelTickets::class, 'travel_carts', 'id', 'ticket_id');
    }

    public function travelPrice()
    {
        return $this->belongsTo(TravelPrices::class,'price_id','id');
    }

    public function travelPrices()
    {
        return $this->belongsToMany(TravelPrices::class, 'travel_carts', 'id', 'price_id');
    }
}