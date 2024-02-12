<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewTransportPaymentsCheckValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "view_transport_payments_check_validations";

    // customer_id
    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    // booking_id
    public function transportBookings()
    {
        return $this->belongsToMany(TransportBookings::class, 'view_transport_payments_check_validations', 'id', 'booking_id');
    }

    public function transportBooking()
    {
        return $this->belongsTo(TransportBookings::class,'booking_id','id');
    }

}
