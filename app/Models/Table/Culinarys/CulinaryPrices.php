<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryPrices extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // uuid
    // store_id
    // product_id
    // name
    // general_price
    // discount_price
    // cashback_price
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "culinary_prices";

    public function customer()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function culinaryStore()
    {
        return $this->belongsTo(CulinaryStores::class,'store_id','id');
    }

    public function culinaryStores()
    {
        return $this->belongsToMany(CulinaryStores::class, 'culinary_prices', 'id', 'store_id');
    }

    public function culinaryProduct()
    {
        return $this->belongsTo(CulinaryProducts::class,'product_id','id');
    }

    public function culinaryProducts()
    {
        return $this->belongsToMany(CulinaryProducts::class, 'culinary_prices', 'id', 'product_id');
    }

    public function culinaryCart()
    {
        return $this->hasOne(CulinaryCarts::class, 'price_id', 'id');
    }

    public function culinaryCarts()
    {
        return $this->hasMany(CulinaryCarts::class, 'price_id', 'id');
    }

}
