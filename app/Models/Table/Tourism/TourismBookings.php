<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_bookings', 'id', 'customer_id');
    }

    public function transportDrivers()
    {
        return $this->belongsToMany(TransportDrivers::class, 'transport_bookings', 'id', 'driver_id');
    }

    public function transportDriver()
    {
        return $this->belongsTo(TransportDrivers::class,'driver_id','id');
    }


    public function transportVehicles()
    {
        return $this->belongsToMany(TransportVehicles::class, 'transport_bookings', 'id', 'vehicle_id');
    }

    public function transportVehicle()
    {
        return $this->belongsTo(TransportVehicles::class,'vehicle_id','id');
    }


    public function transportReturns()
    {
        return $this->hasMany(TransportReturns::class, 'booking_id', 'id');
    }

    public function transportReturn()
    {
        return $this->hasOne(TransportReturns::class, 'booking_id', 'id');
    }

    public function transportPayments()
    {
        return $this->hasMany(TransportPayments::class, 'booking_id', 'id');
    }

    public function transportPayment()
    {
        return $this->hasOne(TransportPayments::class, 'booking_id', 'id');
    }

    public function transportPaymentsValidation() {

        // return $this->hasManyThrough(TravelPaymentsValidations::class, TravelPayments::class);
        return $this->hasManyThrough(
            TransportPaymentsValidations::class,
            TransportPayments::class,
                'booking_id', // Foreign key on the TravelPayments table...
                'payment_id', // Foreign key on the TravelPaymentsValidations table...
                'id', // Local key on the users table... // gak wajib
                'id' // Local key on the categories table...
        );

        // return $this->hasManyThrough(
        //     Item::class,
        //     Type::class,
        //     'category_id', // Foreign key on the types table...
        //     'type_id', // Foreign key on the items table...
        //     'id', // Local key on the users table...
        //     'id' // Local key on the categories table...
        //  );
    }


    protected function getGetTotalAmountAttribute()
    {
        return round((($this->get_price) - ((($this->get_price) * ($this->get_discount)/100)) - ($this->get_cashback)), 2);
    }

}
