<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = [''];

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_bookings', 'id', 'customer_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelTickets()
    {
        return $this->belongsToMany(TravelTickets::class, 'travel_bookings', 'id', 'ticket_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelPayment()
    {
        return $this->hasOne(TravelPayments::class, 'booking_id', 'id');
    }

    public function travelReservation()
    {
        // return $this->belongsToMany(TravelReservations::class, 'travel_bookings', 'id', 'reservation_id');
        return $this->belongsTo(TravelReservations::class,'reservation_id','id');
    }


    public function travelPaymentsValidation() {

        // return $this->hasManyThrough(TravelPaymentsValidations::class, TravelPayments::class);
        return $this->hasManyThrough(
            TravelPaymentsValidations::class,
            TravelPayments::class,
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
