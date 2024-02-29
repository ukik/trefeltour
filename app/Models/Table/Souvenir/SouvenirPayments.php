<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirPayments extends Model
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

    protected $table = "souvenir_payments";

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
        return $this->belongsToMany(BadasoUsers::class, 'souvenir_payments', 'id', 'customer_id');
    }

    public function souvenirBooking()
    {
        return $this->belongsTo(SouvenirBookings::class,'booking_id','id');
    }

    public function souvenirBookings()
    {
        return $this->belongsToMany(SouvenirBookings::class, 'souvenir_payments', 'id', 'booking_id');
    }

    public function souvenirPaymentsValidation()
    {
        return $this->hasOne(SouvenirPaymentsValidations::class, 'payment_id', 'id');
    }

    public function souvenirPaymentsValidations()
    {
        return $this->hasMany(SouvenirPaymentsValidations::class, 'payment_id', 'id');
    }
}
