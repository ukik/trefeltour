<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportPaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function transportPayments()
    {
        return $this->belongsToMany(TransportPayments::class, 'transport_payments_validations', 'id', 'payment_id');
    }

    public function transportPayment()
    {
        return $this->belongsTo(TransportPayments::class,'payment_id','id');
    }
}
