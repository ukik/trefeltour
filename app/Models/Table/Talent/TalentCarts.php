<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentCarts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "talent_carts";

    public $fillable = [
        'customer_id',
        'profile_id',
        'skill_id',
        'price_id',
        // 'name',
        // 'get_price',
        // 'get_discount',
        // 'get_cashback',
        // 'get_total_amount',
        'quantity',
        // 'get_final_amount',
        'description',
        'code_table',
    ];

    public function badasoUser()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function badasoUsers()
    {
        return $this->belongsToMany(BadasoUsers::class, 'talent_carts', 'id', 'customer_id');
    }

    public function talentProfile()
    {
        return $this->belongsTo(TalentProfiles::class,'profile_id','id');
    }

    public function talentProfiles()
    {
        return $this->belongsToMany(TalentProfiles::class, 'talent_carts', 'id', 'profile_id');
    }

    public function talentSkill()
    {
        return $this->belongsTo(TalentSkills::class,'skill_id','id');
    }

    public function talentSkills()
    {
        return $this->belongsToMany(TalentSkills::class, 'talent_carts', 'id', 'skill_id');
    }

    public function talentPrice()
    {
        return $this->belongsTo(TalentPrices::class,'price_id','id');
    }

    public function talentPrices()
    {
        return $this->belongsToMany(TalentPrices::class, 'talent_carts', 'id', 'price_id');
    }
}
