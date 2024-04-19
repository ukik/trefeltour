<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeProfiles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_profiles";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'lodge_profiles', 'id', 'user_id');
    }


    public function lodgeBooking()
    {
        return $this->hasOne(LodgeBookings::class, 'profile_id', 'id');
    }

    public function lodgeBookings()
    {
        return $this->hasMany(LodgeBookings::class, 'profile_id', 'id');
    }

    public function lodgeRoom()
    {
        return $this->hasOne(LodgeRooms::class, 'profile_id', 'id');
    }

    public function lodgeRooms()
    {
        return $this->hasMany(LodgeRooms::class, 'profile_id', 'id');
    }

    public function lodgeStaff()
    {
        return $this->hasOne(LodgeStaffs::class, 'profile_id', 'id');
    }

    public function lodgeStaffs()
    {
        return $this->hasMany(LodgeStaffs::class, 'profile_id', 'id');
    }

    public function lodgeFacility()
    {
        return $this->hasOne(LodgeFacility::class, 'profile_id', 'id');
    }

    public function lodgeFacilitys()
    {
        return $this->hasMany(LodgeFacility::class, 'profile_id', 'id');
    }

    public function lodgePrice()
    {
        return $this->hasOne(LodgePrices::class, 'profile_id', 'id');
    }

    public function lodgePrices()
    {
        return $this->hasMany(LodgePrices::class, 'profile_id', 'id');
    }
}
