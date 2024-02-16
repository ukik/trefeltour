<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentBookingsCheckPayements extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "talent_bookings_check_payments";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'tourism_bookings_check_payments', 'id', 'customer_id');
    }

    public function tourismBookings()
    {
        return $this->belongsToMany(TourismBookings::class, 'tourism_bookings_check_payments', 'id', 'booking_id');
    }

    public function tourismBooking()
    {
        return $this->belongsTo(TourismBookings::class,'booking_id','id');
    }

    public function tourismVenue()
    {
        return $this->belongsTo(TourismVenues::class,'venue_id','id');
    }

    public function tourismVenues()
    {
        return $this->belongsToMany(TourismVenues::class, 'tourism_facilities', 'id', 'venue_id');
    }


    public function tourismPayments()
    {
        return $this->hasMany(TourismPayments::class, 'booking_id', 'id');
    }

    public function tourismPayment()
    {
        return $this->hasOne(TourismPayments::class, 'booking_id', 'id');
    }

}
