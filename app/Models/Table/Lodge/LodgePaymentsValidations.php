<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgePaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_payments_validations";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'validator_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'lodge_payments_validations', 'id', 'validator_id');
    }

    public function lodgePayment()
    {
        return $this->belongsTo(LodgePayments::class,'payment_id','id');
    }

    public function lodgePayments()
    {
        return $this->belongsToMany(LodgePayments::class, 'lodge_payments_validations', 'id', 'payment_id');
    }
}
