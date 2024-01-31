<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_payments', 'id', 'customer_id');
    }

    public function transportBookings()
    {
        return $this->belongsToMany(TransportBookings::class, 'transport_payments', 'id', 'booking_id');
    }

    public function transportBooking()
    {
        return $this->belongsTo(TransportBookings::class,'booking_id','id');
    }

    public function transportPaymentsValidations()
    {
        return $this->hasMany(TransportPaymentsValidations::class, 'payment_id', 'id');
    }

    public function transportPaymentsValidation()
    {
        return $this->hasOne(TransportPaymentsValidations::class, 'payment_id', 'id');
    }
}
