<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "offers";

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'user_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'offers', 'id', 'user_id');
    }

    public function badasoUserFollowup()
    {
        return $this->belongsTo(BadasoUsers::class,'user_followup_id','id');
    }

}
