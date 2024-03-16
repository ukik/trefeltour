<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryPaymentsValidations extends Model
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

    protected $table = "culinary_payments_validations";


    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'validator_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'culinary_payments_validations', 'id', 'validator_id');
    }

    public function culinaryPayment()
    {
        return $this->belongsTo(CulinaryPayments::class,'payment_id','id');
    }

    public function culinaryPayments()
    {
        return $this->belongsToMany(CulinaryPayments::class, 'culinary_payments_validations', 'id', 'payment_id');
    }
}
