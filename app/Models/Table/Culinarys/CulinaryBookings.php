<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // customer_id
    // store_id
    // uuid
    // description
    // get_final_amount
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "culinary_bookings";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'culinary_bookings', 'id', 'customer_id');
    }


    public function culinaryStore()
    {
        return $this->belongsTo(CulinaryStores::class,'store_id','id');
    }

    public function culinaryStores()
    {
        return $this->belongsToMany(CulinaryStores::class, 'culinary_bookings', 'id', 'store_id');
    }

    public function culinaryBookingItem()
    {
        return $this->hasOne(CulinaryBookingsItems::class, 'booking_id', 'id');
    }

    public function culinaryBookingItems()
    {
        return $this->hasMany(CulinaryBookingsItems::class, 'booking_id', 'id');
    }

    public function culinaryPayment()
    {
        return $this->hasOne(CulinaryPayments::class, 'booking_id', 'id');
    }

    public function culinaryPayments()
    {
        return $this->hasMany(CulinaryPayments::class, 'booking_id', 'id');
    }
}
