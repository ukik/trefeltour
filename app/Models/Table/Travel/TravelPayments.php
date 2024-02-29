<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'uuid',
        'booking_id',
        'reservation_id',
        'ticket_id',
        'customer_id',
        'total_amount',
        'code_transaction',
        'method',
        'date',
        'status',
        'receipt',
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

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_payments', 'id', 'customer_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelBookings()
    {
        return $this->belongsToMany(TravelBookings::class, 'travel_payments', 'id', 'booking_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelBooking()
    {
        return $this->belongsTo(TravelBookings::class,'booking_id','id');
    }

    public function travelPaymentsValidation()
    {
        return $this->hasOne(TravelPaymentsValidations::class, 'payment_id', 'id');
    }
}
