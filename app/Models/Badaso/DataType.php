<?php

namespace App\Models\Badaso;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Uasoft\Badaso\Facades\Badaso;

use App\Observers\Observer\CodeTableObserver;

class DataType extends Model
{
    protected $table = null;

    // public static function boot()
    // {
    //     parent::boot();

    //     static::observe(\App\Observers\Observer\CodeTableObserver::class);
    //     // static::saving( function ($model) {
    //     //     $model->slug = Str::slug($model->title);
    //     // })
    // }

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'slug',
        'display_name_singular',
        'display_name_plural',
        'icon',
        'model_name',
        'policy_name',
        'controller',
        'description',
        'generate_permissions',
        'server_side',
        'order_column',
        'order_display_column',
        'order_direction',
        'default_search_key',
        'scope',
        'details',
    ];

    public function dataRows()
    {
        return $this->hasMany(Badaso::model('DataRow'))->orderBy('order', 'asc');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->dontSubmitEmptyLogs();
    }
}
