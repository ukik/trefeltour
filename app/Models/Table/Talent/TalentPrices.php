<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentPrices extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->appends = [
            'user_label',
            'user_column'
        ];

        parent::__construct($attributes);
    }

    public function getUserLabelAttribute($value) {
        $user = $this?->talentSkill?->talentProfile?->badasoUser;
        return "Nama ($user?->name) - Username ($user?->username) - Email ($user?->email) - Telpon ($user?->phone)";
    }

    public function getUserColumnAttribute($value) {
        $user = $this?->talentSkill?->talentProfile?->badasoUser;
        return "(<i> $user->username </i>) $user->name";
    }

    protected $table = "talent_prices";

    public function talentSkill()
    {
        return $this->belongsTo(TalentSkills::class,'skill_id','id');
    }

    public function talentSkills()
    {
        return $this->belongsToMany(TalentSkills::class, 'talent_prices', 'id', 'skill_id');
    }

}
