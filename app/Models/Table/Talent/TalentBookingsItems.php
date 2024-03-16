<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentBookingsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "talent_booking_items";



    public function talentBooking()
    {
        return $this->belongsTo(TalentBookings::class,'booking_id','id');
    }

    public function talentBookings()
    {
        return $this->belongsToMany(TalentBookings::class, 'talent_booking_items', 'id', 'booking_id');
    }

    public function talentProfile()
    {
        return $this->belongsTo(TalentProfiles::class,'profile_id','id');
    }

    public function talentProfiles()
    {
        return $this->belongsToMany(TalentProfiles::class, 'talent_booking_items', 'id', 'profile_id');
    }


    public function talentSkill()
    {
        return $this->belongsTo(TalentSkills::class,'skill_id','id');
    }

    public function talentSkills()
    {
        return $this->belongsToMany(TalentSkills::class, 'talent_booking_items', 'id', 'skill_id');
    }

}
