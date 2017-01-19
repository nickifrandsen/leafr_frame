<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['name', 'description'];

    public function products() {
        return $this->hasMany('Leafr\Commerce\Product');
    }
}
