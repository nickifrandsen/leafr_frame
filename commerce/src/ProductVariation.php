<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;


/**
 * Class ProductVariation
 * @package Leafr
 */
class ProductVariation extends LeafrModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $fillable = [
        'sku',
        'product_id',
        'attribute_id',
        'value_id'
    ];

    public $incrementing = false;

    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo('Leafr\Commerce\Product');
    }

    public function the_sku()
    {
        return $this->hasOne('Leafr\Commerce\Sku', 'sku', 'sku');
    }

    public function group()
    {
        return $this->hasOne('Leafr\Commerce\ProductAttribute', 'id', 'attribute_id');
    }

    public function value()
    {
        return $this->hasOne('Leafr\Commerce\ProductAttributeValue', 'id', 'value_id');
    }

    public function getPriceAttribute()
    {
        if($this->sale_price) {
            return $this->sale_price;
        }

        return $this->unit_price;
    }

}
