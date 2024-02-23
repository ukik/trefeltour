<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirPaymentsValidations extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // validator_id
    // payment_id
    // uuid
    // is_valid
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "souvenir_payments_validations";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'validator_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'souvenir_payments_validations', 'id', 'validator_id');
    }

    public function souvenirPayment()
    {
        return $this->belongsTo(SouvenirPayments::class,'payment_id','id');
    }

    public function souvenirPayments()
    {
        return $this->belongsToMany(SouvenirPayments::class, 'souvenir_payments_validations', 'id', 'payment_id');
    }
}
