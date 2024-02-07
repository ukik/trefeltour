<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismPaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'validator_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'transport_payments_validations', 'id', 'validator_id');
    }

    public function transportPayments()
    {
        return $this->belongsToMany(TransportPayments::class, 'transport_payments_validations', 'id', 'payment_id');
    }

    public function transportPayment()
    {
        return $this->belongsTo(TransportPayments::class,'payment_id','id');
    }
}
