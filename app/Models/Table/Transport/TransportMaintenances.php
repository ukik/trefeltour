<?php

// namespace App\Models\Table\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Table\BadasoUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportMaintenances extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function transportWorkshops()
    {
        return $this->belongsToMany(TransportWorkshops::class, 'transport_maintenances', 'id', 'workshop_id');
    }

    public function transportWorkshop()
    {
        return $this->belongsTo(TransportWorkshops::class,'workshop_id','id');
    }

    public function transportVehicles()
    {
        return $this->belongsToMany(TransportVehicles::class, 'transport_maintenances', 'id', 'vehicle_id');
    }

    public function transportVehicle()
    {
        return $this->belongsTo(TransportVehicles::class,'vehicle_id','id');
    }

}
