<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeStaffs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lodge_staffs";

    public function lodgeProfile()
    {
        return $this->belongsTo(LodgeProfiles::class,'profile_id','id');
    }

    public function lodgeProfiles()
    {
        return $this->belongsToMany(LodgeProfiles::class, 'lodge_staffs', 'id', 'profile_id');
    }
}
