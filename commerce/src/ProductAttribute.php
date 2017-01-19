<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;


/**
 * Class ProductVariation
 * @package Leafr
 */
class ProductAttribute extends LeafrModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $fillable = [
        'identifier',
        'name',
        'description',
        'feature'
    ];

    public $timestamps = false;


    protected $notNullable = ['name', 'product_id', 'product_variation_group_id'];

    public function values()
    {
        return $this->hasMany('Leafr\Commerce\ProductAttributeValue');
    }

    public function variation()
    {
        return $this->belongsTo('Leafr\Commerce\ProductVariation', 'attribute_id');
    }

}
