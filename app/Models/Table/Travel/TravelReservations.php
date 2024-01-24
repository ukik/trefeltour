<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;

class TravelReservations extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_reservations', 'id', 'customer_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

}
