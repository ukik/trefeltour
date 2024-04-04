<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tourism_bookings";

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
        return $this->belongsToMany(BadasoUsers::class, 'tourism_bookings', 'id', 'customer_id');
    }

    public function tourismVenue()
    {
        return $this->belongsTo(TourismVenues::class,'venue_id','id');
    }

    public function tourismVenues()
    {
        return $this->belongsToMany(TourismVenues::class, 'tourism_bookings', 'id', 'venue_id');
    }

    public function tourismPayments()
    {
        return $this->hasMany(TourismPayments::class, 'booking_id', 'id');
    }

    public function tourismPayment()
    {
        return $this->hasOne(TourismPayments::class, 'booking_id', 'id');
    }


    public function tourismBookingItems()
    {
        return $this->hasMany(TourismBookingsItems::class, 'booking_id', 'id');
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
