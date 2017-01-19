<?php

namespace Leafr\Core;

class Page extends LeafrModel
{
    protected $table = 'pages';

    protected $casts = [
      'show_in_menu' => 'boolean'
    ];

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'show_in_menu',
        'parent_id'
    ];

    protected $notNullable = ['slug', 'title', 'content', 'show_in_menu'];

    public function parent()
    {
        return $this->belongsTo('Leafr\Core\Page', 'parent_id' , 'id');
    }

    public function children()
    {
        return $this->hasMany('Leafr\Core\Page', 'parent_id', 'id');
    }

    public function medias()
    {
        return $this->morphToMany('Leafr\Core\Media', 'mediable');
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value);
    }

    public function scopeTopLevel($query)
    {
        return $query->where('parent_id', null);
    }

    public function list()
    {
        return $this::pluck('title', 'id')->all();
    }

    public function hasChildren()
    {

        if($this->children->count() === 0) {

            return false;
        
        }

        return true;
    }

}
