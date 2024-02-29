<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirPaymentsUnique extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // booking_id
    // customer_id
    // uuid
    // deleted_at

    protected $table = "souvenir_payments_unique";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'souvenir_payments_unique', 'id', 'customer_id');
    }

    public function souvenirBooking()
    {
        return $this->belongsTo(SouvenirBookings::class,'booking_id','id');
    }

    public function souvenirBookings()
    {
        return $this->belongsToMany(SouvenirBookings::class, 'souvenir_payments_unique', 'id', 'booking_id');
    }
}
