<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'booking_id',
        'customer_id',
        'driver_id',
        'uuid',
        'total_amount',
        'total_amount_driver',
        'code_transaction',
        'method',
        'date',
        'status',
        'receipt',
        'description',
        'code_table',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_selected',
    ];

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUser()
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

    public function transportDriver()
    {
        return $this->belongsTo(TransportDrivers::class,'driver_id','id');
    }

    public function transportDrivers()
    {
        return $this->belongsToMany(TransportDrivers::class, 'transport_payments', 'id', 'driver_id');
    }



    public function transportDriverUser()
    {
        return $this->belongsTo(TransportDriversUsers::class,'driver_id','id');
    }

    public function transportDriverUsers()
    {
        return $this->belongsToMany(TransportDriversUsers::class, 'transport_payments', 'id', 'driver_id');
    }

}
