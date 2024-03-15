<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirStores extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "souvenir_stores";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'souvenir_stores', 'id', 'user_id');
    }

    public function souvenirBooking()
    {
        return $this->hasOne(SouvenirBookings::class, 'store_id', 'id');
    }

    public function souvenirBookings()
    {
        return $this->hasMany(SouvenirBookings::class, 'store_id', 'id');
    }

    public function souvenirProduct()
    {
        return $this->hasOne(SouvenirProducts::class, 'store_id', 'id');
    }

    public function souvenirProducts()
    {
        return $this->hasMany(SouvenirProducts::class, 'store_id', 'id');
    }
}
