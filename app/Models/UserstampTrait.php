<?php

namespace App\Models;

/**
 * Trait UserstampTrait
 *
 * Automatically set the current logged in user id on create, update and delete.
 *
 * @package App\Models
 */

trait UserstampTrait
{
    /**
     * Boot the trait to handle model events.
     */
    protected static function bootUserstampTrait()
    {
        static::creating(function ($model) {
            $loggedInUserId = auth()->id();
            if (!empty($loggedInUserId)) {
                if (self::hasColumn($model, 'created_by')) {
                    $model->created_by = $loggedInUserId;
                }
                if (self::hasColumn($model, 'updated_by')) {
                    $model->updated_by = $loggedInUserId;
                }
            }
        });

        static::updating(function ($model) {
            $loggedInUserId = auth()->id();
            if (!empty($loggedInUserId) && self::hasColumn($model, 'updated_by')) {
                $model->updated_by = $loggedInUserId;
            }
        });

        // Evento para exclusão (soft delete)
        static::deleting(function ($model) {
            $loggedInUserId = auth()->id();
            if (!empty($loggedInUserId) && self::hasColumn($model, 'deleted_by')) {
                $model->deleted_by = $loggedInUserId;
                $model->save();
            }
        });
    }

    /**
     * Check if the model has a given column.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $column
     * @return bool
     */
    protected static function hasColumn($model, $column)
    {
        return in_array(
            $column,
            $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable())
        );
    }
}
