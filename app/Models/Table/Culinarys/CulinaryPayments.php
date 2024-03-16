<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // booking_id
    // customer_id
    // uuid
    // total_amount
    // code_transaction
    // method
    // date
    // status
    // receipt
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "culinary_payments";

    protected $fillable = [
        'id',
        'booking_id',
        'customer_id',
        'uuid',
        'total_amount',
        'code_transaction',
        'method',
        'date',
        'status',
        'receipt',
        'description',
        'code_table',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_selected',
    ];

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'culinary_payments', 'id', 'customer_id');
    }

    public function culinaryBooking()
    {
        return $this->belongsTo(CulinaryBookings::class,'booking_id','id');
    }

    public function culinaryBookings()
    {
        return $this->belongsToMany(CulinaryBookings::class, 'culinary_payments', 'id', 'booking_id');
    }

    public function culinaryPaymentsValidation()
    {
        return $this->hasOne(CulinaryPaymentsValidations::class, 'payment_id', 'id');
    }

    public function culinaryPaymentsValidations()
    {
        return $this->hasMany(CulinaryPaymentsValidations::class, 'payment_id', 'id');
    }
}
