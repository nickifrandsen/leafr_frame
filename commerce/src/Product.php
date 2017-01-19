<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;
use Leafr\Core\Presenters\Presentable;

/**
 * Class Product
 * @package Leafr
 */
class Product extends LeafrModel
{

    use Presentable;

    /**
     * Should some fields be casted by default
     *
     * @var array
     */
    protected $casts = [
        'is_online' => 'boolean',
        'has_variations' => 'boolean'
    ];

     protected $notNullable = [
        'description', 
        'sku', 
        'meta',
        'has_variations'
    ];

    protected $presenter = 'Leafr\Commerce\Presenters\Product'; 

    /**
     * Which fields should be allowed to be mass assigned
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'weight',
        'unit_price',
        'sale_price',
        'cost_price',
        'product_type_id',
        'supplier_id',
        'brand_id',
        'meta',
        'is_online',
        'has_variations'
    ];

    public function scopeOnline($query)
    {
        return $query->where('is_online', 1);
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value);
    }

    public function addMedia($file)
    {
        $media = (new \Leafr\Core\Media)->prepare([
            'name' => $this->name,
            'path' => 'product-images'
        ], $file);

        $this->medias()->attach($media->id);

        return $this;
    }

    public function addSku($attr)
    {
        return $this->skus()->save(new Sku($attr));
    }

    public function types()
    {
        return ProductType::pluck('name', 'id')->all();
    }

    public function listSkus()
    {
        return $this->skus()->pluck('sku')->all();
    }

    public function stock()
    {
        $in = Inventory::where('product_id', $this->id)->sum('in');
        $out = Inventory::where('product_id', $this->id)->sum('out');
        
        return ($in - $out);
    }

    public function inStock()
    {
       if( $this->stock() > 0 ) {
            return true;
        }

        return false;
    }

    public function suppliers()
    {
        return Supplier::pluck('name', 'id')->all();
    }

    public function brands()
    {
        return Brand::pluck('name', 'id')->all();
    }

    public function listVariationsByGroup()
    {
        return $this->variations->groupBy('attribute_id')->all();
    }

    public function variationGroups()
    {
        return ProductAttribute::pluck('name', 'id')->all();
    }

    public function hasVariationsInGroup($group)
    {
        return $this->variations()->where('attribute_id', '=' , $group)->get();
    }

    public function getVariationGroup($id)
    {
        return ProductAttribute::find($id);
    }

    public function createVariation($attr = [])
    {
        // Create new product attribute value
        //  1.1 Hold only the name of the value and the attribute id
        $attribute = (new ProductAttributeValue)->create([
            'name' => $attr['name'],
            'attribute_id' => $attr['attribute_id']
        ]);

        // Create a new sku entry
        //  2.1 Should have a sku number, a product id, optionally weight, cost price, sale price and unit price
        $sku = (new Sku)->create([
            'sku' => $attr['sku'],
            'product_id' => $this->id,
            // 'weight' => $variation['weight'],
            'cost_price' => $attr['cost_price'],
            'sale_price' => $attr['sale_price'],
            'unit_price' => !empty($attr['unit_price']) ? $attr['unit_price'] : $this->unit_price,
        ]);

        // Create the connection between sku, product and attribute in the product_variations
        //  3.1 Has a sku number, product id, attribute id, and a value id.
        $variation = (new ProductVariation)->create([
            'sku' => $sku->sku,
            'product_id' => $this->id,
            'attribute_id' => $attribute->attribute_id,
            'value_id' => $attribute->id,
        ]);

        return $this;
    }


    /* Relations */
    public function variations()
    {
        return $this->hasMany('Leafr\Commerce\ProductVariation');
    }

    public function type()
    {
        return $this->hasOne('Leafr\Commerce\ProductType');
    }

    public function skus()
    {
        return $this->hasMany('Leafr\Commerce\Sku');
    }

    public function sku()
    {
        return $this->belongsTo('Leafr\Commerce\Sku');
    }

    public function supplier()
    {
        return $this->belongsTo('Leafr\Commerce\Supplier');
    }

    public function brand()
    {
        return $this->belongsTo('Leafr\Commerce\Brand');
    }

    public function medias()
    {
        return $this->morphToMany('Leafr\Core\Media', 'mediable');
    }

    public function categories()
    {
        return $this->morphToMany('Leafr\Core\Category', 'categorizable');
    }

}
