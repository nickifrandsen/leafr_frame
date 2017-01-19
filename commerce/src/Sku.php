<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;


/**
 * Class ProductVariation
 * @package Leafr
 */
class Sku extends LeafrModel
{

    public $primaryKey = 'sku';

    public $incrementing = false;

    protected $fillable = [
        'sku',
        'product_id',
        'weight',
        'cost_price',
        'sale_price',
        'unit_price' ,
    ];

    public function product()
    {
        return $this->belongsTo('Leafr\Commerce\Product');
    }

    public function variations()
    {
        return $this->hasMany('Leafr\Commerce\ProductVariation', 'sku', 'sku');
    }

    public function stock()
    {
        $in = Inventory::where('sku', $this->sku)->sum('in');
        $out = Inventory::where('sku', $this->sku)->sum('out');
        
        return ($in - $out);
    }

    public function inStock()
    {
        if( $this->stock() > 0 ) {
            return true;
        }

        return false;
    }

    public function inStockText()
    {
        if( $this->inStock() ) {
            return 'På lager';
        }

        return 'Ikke på lager';
    }

    public function getPriceAttribute()
    {
        if ($this->sale_price) {
            return $this->sale_price;
        }

        return $this->unit_price;
    }

}
