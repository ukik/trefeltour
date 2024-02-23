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

    // public function __construct(array $attributes = [])
    // {
    //     $this->appends = [
    //         'user_label',
    //         'user_column'
    //     ];

    //     parent::__construct($attributes);
    // }

    // public function getUserLabelAttribute($value) {
    //     $user = $this?->badasoUser;
    //     return "Nama ($user?->name) - Username ($user?->username) - Email ($user?->email) - Telpon ($user?->phone)";
    // }

    // public function getUserColumnAttribute($value) {
    //     $user = $this?->badasoUser;
    //     return "(<i> $user?->username </i>) $user?->name";
    // }

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

    public function talentPrices()
    {
        return $this->hasMany(TalentPrices::class, 'profile_id', 'id');
    }

    public function talentPrice()
    {
        return $this->hasOne(TalentPrices::class, 'profile_id', 'id');
    }

    public function talentSkills()
    {
        return $this->hasMany(TalentSkills::class, 'profile_id', 'id');
    }

    public function talentSkill()
    {
        return $this->hasOne(TalentSkills::class, 'profile_id', 'id');
    }

    // public function talentBookings()
    // {
    //     return $this->hasMany(TalentSkills::class, 'profile_id', 'id');
    // }

    // public function talentBooking()
    // {
    //     return $this->hasOne(TalentSkills::class, 'profile_id', 'id');
    // }

}
