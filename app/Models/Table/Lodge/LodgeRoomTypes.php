<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeRoomTypes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_room_types";


    public function lodgeStaffs()
    {
        return $this->hasMany(LodgeRooms::class, 'room_type_id', 'id');
    }
}
