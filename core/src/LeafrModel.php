<?php

namespace Leafr\Core;

use Illuminate\Database\Eloquent\Model;

class LeafrModel extends Model
{

    protected $notNullable = [];

    public static function boot() {
        parent::boot();

        static::saving(function($model) {
            foreach ($model->attributes as $key => $value) {
                if($value !== 0 && !in_array($key, $model->notNullable)) {
                    $model->{$key} = empty($value) ? null : $value;
                }
            }
        });
    }
}
