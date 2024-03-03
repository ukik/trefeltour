<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgePayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_payments";

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
        return $this->belongsToMany(BadasoUsers::class, 'lodge_payments', 'id', 'customer_id');
    }

    public function lodgeBooking()
    {
        return $this->belongsTo(LodgeBookings::class,'booking_id','id');
    }

    public function lodgeBookings()
    {
        return $this->belongsToMany(LodgeBookings::class, 'lodge_payments', 'id', 'booking_id');
    }

    public function lodgePaymentsValidation()
    {
        return $this->hasOne(LodgePaymentsValidations::class, 'payment_id', 'id');
    }

    public function lodgePaymentsValidations()
    {
        return $this->hasMany(LodgePaymentsValidations::class, 'payment_id', 'id');
    }
}
