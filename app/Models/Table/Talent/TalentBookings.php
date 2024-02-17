<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentBookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->appends = [
            'user_label',
            'user_column'
        ];

        parent::__construct($attributes);
    }

    public function getUserLabelAttribute($value) {
        $user = $this?->user;
        return "Nama ($user?->name) - Username ($user?->username) - Email ($user?->email) - Telpon ($user?->phone)";
    }

    public function getUserColumnAttribute($value) {
        $user = $this?->user;
        return "(<i> $user->username </i>) $user->name";
    }

    protected $table = "talent_bookings";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'talent_bookings', 'id', 'customer_id');
    }

    public function talentProfile()
    {
        return $this->belongsTo(TalentProfiles::class,'profile_id','id');
    }

    public function talentProfiles()
    {
        return $this->belongsToMany(TalentProfiles::class, 'talent_bookings', 'id', 'profile_id');
    }

    public function talentPayments()
    {
        return $this->hasMany(TalentPayments::class, 'booking_id', 'id');
    }

    public function talentPayment()
    {
        return $this->hasOne(TalentPayments::class, 'booking_id', 'id');
    }

}
