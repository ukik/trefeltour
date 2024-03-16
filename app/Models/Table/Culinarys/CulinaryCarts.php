<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryCarts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "culinary_carts";

    public $fillable = [
        'customer_id',
        'store_id',
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
        return $this->belongsToMany(BadasoUsers::class, 'culinary_carts', 'id', 'customer_id');
    }

    public function culinaryStore()
    {
        return $this->belongsTo(CulinaryStores::class,'store_id','id');
    }

    public function culinaryStores()
    {
        return $this->belongsToMany(CulinaryStores::class, 'culinary_carts', 'id', 'store_id');
    }

    public function culinaryProduct()
    {
        return $this->belongsTo(CulinaryProducts::class,'product_id','id');
    }

    public function culinaryProducts()
    {
        return $this->belongsToMany(CulinaryProducts::class, 'culinary_carts', 'id', 'product_id');
    }

    public function culinaryPrice()
    {
        return $this->belongsTo(CulinaryPrices::class,'price_id','id');
    }

    public function culinaryPrices()
    {
        return $this->belongsToMany(CulinaryPrices::class, 'culinary_carts', 'id', 'price_id');
    }
}
