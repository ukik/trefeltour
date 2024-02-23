<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirCarts extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // customer_id
    // store_id
    // product_id
    // price_id
    // name
    // get_price
    // get_discount
    // get_cashback
    // get_total_amount
    // quantity
    // get_final_amount
    // description
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "souvenir_carts";

    public $fillable = [
        'customer_id',
        'store_id',
        'product_id',
        'price_id',
        'name',
        'get_price',
        'get_discount',
        'get_cashback',
        'get_total_amount',
        'quantity',
        'get_final_amount',
        'description',
        'code_table',
    ];

    public function souvenirStore()
    {
        return $this->belongsTo(SouvenirStores::class,'store_id','id');
    }

    public function souvenirStores()
    {
        return $this->belongsToMany(SouvenirStores::class, 'souvenir_carts', 'id', 'store_id');
    }

    public function souvenirProduct()
    {
        return $this->belongsTo(SouvenirProducts::class,'product_id','id');
    }

    public function souvenirProducts()
    {
        return $this->belongsToMany(SouvenirProducts::class, 'souvenir_carts', 'id', 'product_id');
    }

}
