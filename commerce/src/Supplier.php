<?php

namespace Leafr\Commerce;

use Leafr\Core\LeafrModel;

class Supplier extends LeafrModel
{
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'description',
        'contact',
        'email',
        'phone',
        'website'
    ];

    protected $notNullable = ['name', 'description'];

    public function products() {
        return $this->hasMany('Nickifrandsen\Leafr\Models\Product');
    }
}
