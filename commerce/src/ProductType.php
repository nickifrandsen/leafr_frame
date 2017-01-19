<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductVariation
 * @package Leafr
 */
class ProductType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_types';

    protected $fillable = ['identifier', 'name', 'description'];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsToMany('Nickifrandsen\Leafr\Models\Product');
    }

}
