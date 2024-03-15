<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryProducts extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // uuid
    // store_id
    // name
    // category
    // others
    // stock
    // description
    // is_available
    // image
    // code_table
    // created_at
    // updated_at
    // deleted_at

    protected $table = "culinary_products";

    public function culinaryStore()
    {
        return $this->belongsTo(CulinaryStores::class,'store_id','id');
    }

    public function culinaryStores()
    {
        return $this->belongsToMany(CulinaryStores::class, 'culinary_products', 'id', 'store_id');
    }

    public function culinaryPrice()
    {
        return $this->hasOne(CulinaryPrices::class, 'product_id', 'id');
    }

    public function culinaryPrices()
    {
        return $this->hasMany(CulinaryPrices::class, 'product_id', 'id');
    }

}
