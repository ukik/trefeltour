<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirBookingsItems extends Model
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

    protected $table = "souvenir_booking_items";



    public function souvenirBooking()
    {
        return $this->belongsTo(SouvenirBookings::class,'booking_id','id');
    }

    public function souvenirBookings()
    {
        return $this->belongsToMany(SouvenirBookings::class, 'souvenir_booking_items', 'id', 'booking_id');
    }


    public function souvenirProduct()
    {
        return $this->belongsTo(SouvenirProducts::class,'product_id','id');
    }

    public function souvenirProducts()
    {
        return $this->belongsToMany(SouvenirProducts::class, 'souvenir_products', 'id', 'product_id');
    }

}
