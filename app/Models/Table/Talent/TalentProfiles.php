<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentProfiles extends Model
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
        $user = $this?->badasoUser;
        return "Nama ($user?->name) - Username ($user?->username) - Email ($user?->email) - Telpon ($user?->phone)";
    }

    public function getUserColumnAttribute($value) {
        $user = $this?->badasoUser;
        return "(<i> $user->username </i>) $user->name";
    }

    protected $table = "talent_profiles";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'talent_profiles', 'id', 'user_id');
    }

    // public function tourismPrices()
    // {
    //     return $this->hasMany(TourismPrices::class, 'venue_id', 'id');
    // }

    // public function tourismPrice()
    // {
    //     return $this->hasOne(TourismPrices::class, 'venue_id', 'id');
    // }

    // public function tourismFacilities()
    // {
    //     return $this->hasMany(TourismFacilities::class, 'venue_id', 'id');
    // }

    // public function tourismFacility()
    // {
    //     return $this->hasOne(TourismFacilities::class, 'venue_id', 'id');
    // }

    // public function tourismServices()
    // {
    //     return $this->hasMany(TourismServices::class, 'venue_id', 'id');
    // }

    // public function tourismService()
    // {
    //     return $this->hasOne(TourismServices::class, 'venue_id', 'id');
    // }

    // public function tourismBookings()
    // {
    //     return $this->hasMany(TourismBookings::class, 'venue_id', 'id');
    // }

    // public function tourismBooking()
    // {
    //     return $this->hasOne(TourismBookings::class, 'venue_id', 'id');
    // }


}
