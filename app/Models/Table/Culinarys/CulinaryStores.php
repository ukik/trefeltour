<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryStores extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "culinary_stores";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'culinary_stores', 'id', 'user_id');
    }

    public function culinaryBooking()
    {
        return $this->hasOne(CulinaryBookings::class, 'store_id', 'id');
    }

    public function culinaryBookings()
    {
        return $this->hasMany(CulinaryBookings::class, 'store_id', 'id');
    }

    public function culinaryProduct()
    {
        return $this->hasOne(CulinaryProducts::class, 'store_id', 'id');
    }

    public function culinaryProducts()
    {
        return $this->hasMany(CulinaryProducts::class, 'store_id', 'id');
    }
}
