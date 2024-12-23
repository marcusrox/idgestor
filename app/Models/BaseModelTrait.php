<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait BaseModelTrait
{
    use LogsActivity;
    //use UserstampTrait;

    // Campos que serão logados por LogsActivity
    // protected static $logFillable = true;
    // protected static $logOnlyDirty = true;

    // public function hasAttribute($attr)
    // {
    //     return array_key_exists($attr, $this->attributes);
    // }

    // public function getTypeName($colName)
    // {
    //     return DB::getSchemaBuilder()->getColumnType($this->getTable(), $colName);
    //     // Schema::getColumnType('table', 'column');
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll(); // Registra logs para todos os campos
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    // public function getDescriptionForEvent($eventName)
    // {
    //     return __CLASS__ . " model has been {$eventName}";
    // }
    /*
    public static function boot()
    {
        parent::boot();

        // create a event to happen on updating
        static::updating(function ($table) {
            if (array_key_exists('updated_by', $table->attributes) && Auth::check())
            {
                $table->updated_by = Auth::user()->id;
            }
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            if (array_key_exists('deleted_by', $table->attributes) && Auth::check())
            {
                $table->deleted_by = Auth::user()->id;
            }
        });

        // create a event to happen on creating
        static::creating(function ($table) {
            dd($table);
            if (array_key_exists('created_by', $table->attributes) && Auth::check())
            {
                $table->created_by = Auth::user()->id;
            }
        });
    }    */
}
