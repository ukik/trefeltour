<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismServices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tourism_services";

    public function tourismVenue()
    {
        return $this->belongsTo(TourismVenues::class,'venue_id','id');
    }

    public function tourismVenues()
    {
        return $this->belongsToMany(TourismVenues::class, 'tourism_services', 'id', 'venue_id');
    }

    public function tourismPrices()
    {
        return $this->hasMany(TourismPrices::class, 'venue_id', 'id');
    }

    public function tourismPrice()
    {
        return $this->hasOne(TourismPrices::class, 'venue_id', 'id');
    }

}
