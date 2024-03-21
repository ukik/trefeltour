<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismPaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tourism_payments_validations";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'validator_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'tourism_payments_validations', 'id', 'validator_id');
    }

    public function tourismPayment()
    {
        return $this->belongsTo(TourismPayments::class,'payment_id','id');
    }

    public function tourismPayments()
    {
        return $this->belongsToMany(TourismPayments::class, 'tourism_payments_validations', 'id', 'payment_id');
    }
}
