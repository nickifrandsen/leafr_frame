<?php

namespace Leafr\Core;

class Category extends LeafrModel
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'meta'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->morphedByMany('Leafr\Commerce\Product', 'categorizable');
    }

    public function productsOnline()
    {
        return $this->morphedByMany('Leafr\Commerce\Product', 'categorizable')->online();
    }

    public function posts()
    {
        return $this->morphedByMany('Leafr\Blogging\Post', 'categorizable');
    }

    public function portfolio()
    {
        return $this->morphedByMany('Leafr\Portfolio\PortfolioItem', 'categorizable');
    }

    public function parent()
    {
        return $this->belongsTo('Leafr\Core\Category', 'parent_id' , 'id');
    }

    public function children()
    {
        return $this->hasMany('Leafr\Core\Category', 'parent_id', 'id');
    }

    public static function getTopLevelCategories()
    {
        return static::where('parent_id', NULL)->get();
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value);
    }

    public function hasChildren()
    {

        if($this->children->count() === 0) {

            return false;
        
        }

        return true;
    }

}
