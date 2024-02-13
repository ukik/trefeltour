<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismVenues extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tourism_venues";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'tourism_venues', 'id', 'user_id');
    }

    public function tourismPrices()
    {
        return $this->hasMany(TourismPrices::class, 'venue_id', 'id');
    }

    public function tourismPrice()
    {
        return $this->hasOne(TourismPrices::class, 'venue_id', 'id');
    }

    public function tourismFacilities()
    {
        return $this->hasMany(TourismFacilities::class, 'venue_id', 'id');
    }

    public function tourismFacility()
    {
        return $this->hasOne(TourismFacilities::class, 'venue_id', 'id');
    }

    public function tourismServices()
    {
        return $this->hasMany(TourismServices::class, 'venue_id', 'id');
    }

    public function tourismService()
    {
        return $this->hasOne(TourismServices::class, 'venue_id', 'id');
    }

    public function tourismBookings()
    {
        return $this->hasMany(TourismBookings::class, 'venue_id', 'id');
    }

    public function tourismBooking()
    {
        return $this->hasOne(TourismBookings::class, 'venue_id', 'id');
    }

}
