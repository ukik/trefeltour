<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeRooms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_rooms";


    public function lodgeRoomType()
    {
        return $this->belongsTo(LodgeRoomTypes::class,'room_type_id','id');
    }

    public function lodgeRoomTypes()
    {
        return $this->belongsToMany(LodgeRoomTypes::class, 'lodge_rooms', 'id', 'room_type_id');
    }


    public function lodgeProfile()
    {
        return $this->belongsTo(LodgeProfiles::class,'profile_id','id');
    }

    public function lodgeProfiles()
    {
        return $this->belongsToMany(LodgeProfiles::class, 'lodge_rooms', 'id', 'profile_id');
    }

    public function lodgePrice()
    {
        return $this->hasOne(LodgePrices::class, 'room_id', 'id');
    }

    public function lodgePrices()
    {
        return $this->hasMany(LodgePrices::class, 'room_id', 'id');
    }

}
