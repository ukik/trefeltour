<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewTransportBookingsCheckPayements extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "view_transport_bookings_check_payments";

    public function user()
    {
        return $this->belongsTo(BadasoUsers::class,'customer_id','id');
    }

}
