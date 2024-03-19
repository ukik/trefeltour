<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismCarts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tourism_carts";

    public $fillable = [
        'customer_id',
        'venue_id',
        'product_id',
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
        return $this->belongsToMany(BadasoUsers::class, 'tourism_carts', 'id', 'customer_id');
    }

    public function tourismVenue()
    {
        return $this->belongsTo(TourismVenues::class,'venue_id','id');
    }

    public function tourismVenues()
    {
        return $this->belongsToMany(TourismVenues::class, 'tourism_carts', 'id', 'venue_id');
    }

    public function tourismPrice()
    {
        return $this->belongsTo(TourismPrices::class,'price_id','id');
    }

    public function tourismPrices()
    {
        return $this->belongsToMany(TourismPrices::class, 'tourism_carts', 'id', 'price_id');
    }
}
