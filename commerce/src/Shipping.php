<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping_methods';

    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany('Nickifrandsen\Leafr\Models\Orders' , 'id' );
    }
}