<?php

// namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadasoUserRoles extends Model
{
    use HasFactory;

    protected $table = "badaso_user_roles";

    public function role()
    {
        return $this->belongsTo(BadasoRoles::class,'role_id','id');
    }

    public function roles()
    {
        return $this->belongsToMany(BadasoRoles::class, 'badaso_user_roles', 'id', 'role_id');
    }

}
