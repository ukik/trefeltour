<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentPrices extends Model
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
    //     $user = $this?->talentSkill?->talentProfile?->badasoUser;
    //     return "Nama ($user?->name) - Username ($user?->username) - Email ($user?->email) - Telpon ($user?->phone)";
    // }

    // public function getUserColumnAttribute($value) {
    //     $user = $this?->talentSkill?->talentProfile?->badasoUser;
    //     return "(<i> $user?->username </i>) $user?->name";
    // }

    protected $table = "talent_prices";

    public function customer()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'profile_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'talent_prices', 'id', 'profile_id');
    }

    public function talentSkill()
    {
        return $this->belongsTo(TalentSkills::class,'skill_id','id');
    }

    public function talentSkills()
    {
        return $this->belongsToMany(TalentSkills::class, 'talent_prices', 'id', 'skill_id');
    }

    public function talentProfile()
    {
        return $this->belongsTo(TalentProfiles::class,'profile_id','id');
    }

    public function talentProfiles()
    {
        return $this->belongsToMany(TalentProfiles::class, 'talent_prices', 'id', 'profile_id');
    }

    public function talentBooking()
    {
        return $this->hasOne(TalentBookings::class, 'skill_id', 'id');
    }

    public function talentBookings()
    {
        return $this->hasMany(TalentBookings::class, 'skill_id', 'id');
    }


    public function talentCart()
    {
        return $this->hasOne(TalentCarts::class, 'price_id', 'id');
    }

    public function talentCarts()
    {
        return $this->hasMany(TalentCarts::class, 'price_id', 'id');
    }
}
