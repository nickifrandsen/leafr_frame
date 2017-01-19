<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;

class CartItem extends LeafrModel
{

    protected $fillable = [
        'description',
        'sku',
        'quantity',
        'cart_id'
    ];

    public $timestamps = false;

    /* Relationships */
    public function cart()
    {
        return $this->belongsTo('Leafr\Commerce\Cart');
    }

    public function product()
    {
        return $this->belongsTo('Leafr\Commerce\Sku', 'sku', 'sku');
    }

}