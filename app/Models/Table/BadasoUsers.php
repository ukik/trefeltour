<?php

// namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadasoUsers extends Model
{
    use HasFactory;

    protected $hidden = [
        // 'id',
        // 'name',
        // 'username',
        // 'email',
        // 'additional_info',
        // 'gender',
        // 'avatar',
        // 'phone',
        // 'address',
        'email_verified_at',
        'password',
        'remember_token',
        'last_sent_token_at',
        // 'created_at',
        // 'updated_at',
    ];
}
