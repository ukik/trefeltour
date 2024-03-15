<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryBookingsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    // id
    // uuid
    // store_id
    // booking_id
    // product_id
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

    protected $table = "culinary_booking_items";



    public function culinaryBooking()
    {
        return $this->belongsTo(CulinaryBookings::class,'booking_id','id');
    }

    public function culinaryBookings()
    {
        return $this->belongsToMany(CulinaryBookings::class, 'culinary_booking_items', 'id', 'booking_id');
    }

    public function culinaryStore()
    {
        return $this->belongsTo(CulinaryStores::class,'store_id','id');
    }

    public function culinaryStores()
    {
        return $this->belongsToMany(CulinaryStores::class, 'culinary_booking_items', 'id', 'store_id');
    }


    public function culinaryProduct()
    {
        return $this->belongsTo(CulinaryProducts::class,'product_id','id');
    }

    public function culinaryProducts()
    {
        return $this->belongsToMany(CulinaryProducts::class, 'culinary_booking_items', 'id', 'product_id');
    }

}
