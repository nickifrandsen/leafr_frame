<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $touches = ['order'];

    public $timestamps = false;

    /**
     * Which fields should be allowed to be mass assigned
     *
     * @var array
     */
    protected $fillable = [
        'product_id' ,
        'sku' ,
        'order_id',
        'description' ,
        'quantity',
        'unit_price' ,
        'subtotal',
        'variations'
    ];

    public function order()
    {
        return $this->belongsTo('Leafr\Commerce\Order', 'id');
    }

    public function product()
    {
        return $this->hasOne('Leafr\Commerce\Product', 'id', 'product_id');
    }

    public function sku()
    {
        return $this->hasOne('Leafr\Commerce\Sku', 'sku');
    }
}
