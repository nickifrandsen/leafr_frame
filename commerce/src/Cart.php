<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;

class Cart extends LeafrModel
{

    protected $fillable = [
        'session_id',
        'voucher',
        'shipping_method_id',
        'order_id'
    ];

    /* Relationships */
    public function items()
    {
        return $this->hasMany('Leafr\Commerce\CartItem');
    }

    public function shipping()
    {
        return $this->belongsTo('Leafr\Commerce\Shipping');
    }

}