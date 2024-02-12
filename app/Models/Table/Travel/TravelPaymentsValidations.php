<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'travel_payments_validations', 'id', 'validator_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelPayments()
    {
        return $this->belongsToMany(TravelPayments::class, 'travel_payments_validations', 'id', 'payment_id');
        // return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function travelPayment()
    {
        return $this->belongsTo(TravelPayments::class,'payment_id','id');
    }

}

