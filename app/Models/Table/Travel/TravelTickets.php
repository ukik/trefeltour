<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;

class TravelTickets extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_tickets', 'id', 'customer_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelReservations()
    {
        return $this->belongsToMany(TravelReservations::class, 'travel_tickets', 'id', 'reservation_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

}
