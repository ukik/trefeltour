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

    // id
    // uuid
    // store_id
    // ticket_id
    // name
    // general_price
    // discount_price
    // cashback_price
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "travel_prices";

    public function travelStore()
    {
        return $this->belongsTo(TravelStores::class,'store_id','id');
    }

    public function travelStores()
    {
        return $this->belongsToMany(TravelStores::class, 'travel_prices', 'id', 'store_id');
    }

    public function travelTicket()
    {
        return $this->belongsTo(TravelTickets::class,'ticket_id','id');
    }

    public function travelTickets()
    {
        return $this->belongsToMany(TravelTickets::class, 'travel_prices', 'id', 'ticket_id');
    }


}
