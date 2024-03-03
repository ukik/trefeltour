<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_bookings";



    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'lodge_bookings', 'id', 'customer_id');
    }


    public function lodgeStore()
    {
        return $this->belongsTo(LodgeProfiles::class,'profile_id','id');
    }

    public function lodgeStores()
    {
        return $this->belongsToMany(LodgeProfiles::class, 'lodge_bookings', 'id', 'profile_id');
    }

    public function lodgeBookingBill()
    {
        return $this->hasOne(LodgeBookingsBills::class, 'booking_id', 'id');
    }

    public function lodgeBookingBills()
    {
        return $this->hasMany(LodgeBookingsBills::class, 'booking_id', 'id');
    }

    public function lodgePayment()
    {
        return $this->hasOne(LodgePayments::class, 'booking_id', 'id');
    }

    public function lodgePayments()
    {
        return $this->hasMany(LodgePayments::class, 'booking_id', 'id');
    }
}
