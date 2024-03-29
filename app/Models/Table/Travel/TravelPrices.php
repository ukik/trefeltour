<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPrices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "travel_prices";

    public function travelStore()
    {
        return $this->belongsTo(TravelStores::class,'store_id','id');
    }

    public function travelStores()
    {
        return $this->belongsToMany(TravelStores::class, 'travel_prices', 'id', 'store_id');
    }

    public function travelReservation()
    {
        return $this->belongsTo(TravelReservations::class,'reservation_id','id');
    }

    public function travelReservations()
    {
        return $this->belongsToMany(TravelReservations::class, 'travel_prices', 'id', 'reservation_id');
    }


}
