<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentPayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "talent_payments";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'talent_payments', 'id', 'customer_id');
    }

    public function talentBookings()
    {
        return $this->belongsToMany(TalentBookings::class, 'talent_payments', 'id', 'booking_id');
    }

    public function talentBooking()
    {
        return $this->belongsTo(TalentBookings::class,'booking_id','id');
    }

    public function talentPaymentsValidations()
    {
        return $this->hasMany(TalentPaymentsValidations::class, 'payment_id', 'id');
    }

    public function talentPaymentsValidation()
    {
        return $this->hasOne(TalentPaymentsValidations::class, 'payment_id', 'id');
    }
}
