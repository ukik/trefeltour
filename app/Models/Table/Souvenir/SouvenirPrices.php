<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirPrices extends Model
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

    protected $table = "souvenir_prices";

    public function customer()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

    public function souvenirStore()
    {
        return $this->belongsTo(SouvenirStores::class,'store_id','id');
    }

    public function souvenirStores()
    {
        return $this->belongsToMany(SouvenirStores::class, 'souvenir_prices', 'id', 'store_id');
    }

    public function souvenirProduct()
    {
        return $this->belongsTo(SouvenirProducts::class,'product_id','id');
    }

    public function souvenirProducts()
    {
        return $this->belongsToMany(SouvenirProducts::class, 'souvenir_prices', 'id', 'product_id');
    }


    public function souvenirCart()
    {
        return $this->hasOne(SouvenirCarts::class, 'price_id', 'id');
    }

    public function souvenirCarts()
    {
        return $this->hasMany(SouvenirCarts::class, 'price_id', 'id');
    }
}
