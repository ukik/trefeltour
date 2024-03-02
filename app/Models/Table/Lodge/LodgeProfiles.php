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

    // id
    // user_id
    // uuid
    // name
    // email
    // phone
    // location
    // image
    // address
    // codepos
    // city
    // country
    // policy
    // description
    // rating
    // checkin_time
    // checkout_time
    // additional_policy
    // shuttle_to_airport_price
    // additional_breakfast_price
    // late_checkout_price
    // is_clean_accomodation
    // is_breakfast
    // is_pet
    // is_available
    // code_table
    // created_at
    // updated_at
    // deleted_at

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

    public function lodgeType()
    {
        return $this->hasOne(LodgeTypes::class, 'profile_id', 'id');
    }

    public function lodgeTypes()
    {
        return $this->hasMany(LodgeTypes::class, 'profile_id', 'id');
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

}
