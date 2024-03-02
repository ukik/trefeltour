<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeTypes extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // uuid
    // profile_id
    // is_hotel
    // is_hostel
    // is_boutique_hotel
    // is_resort
    // is_cottage
    // is_motel
    // is_losmen
    // is_inn
    // is_villa
    // is_homestay
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "lodge_types";


    public function lodgeProfile()
    {
        return $this->belongsTo(LodgeProfiles::class,'profile_id','id');
    }

    public function lodgeProfiles()
    {
        return $this->belongsToMany(LodgeProfiles::class, 'lodge_types', 'id', 'profile_id');
    }

}
