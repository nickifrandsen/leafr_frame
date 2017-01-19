<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{

    protected $fillable = [
        'name',
        'attribute_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo('Leafr\Commerce\ProductAttribute');
    }

    public function variations()
    {
        return $this->belongsTo('Leafr\Commerce\ProductVariation', 'value_id');
    }
}
