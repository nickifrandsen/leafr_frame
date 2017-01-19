<?php

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $casts = [
        'on_mailinglist' => 'boolean'
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'cvr',
        'email',
        'phone',
        'address',
        'zipcode',
        'city',
        'country',
        'on_mailinglist',
        'notes',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('Nickifrandsen\Leafr\Models\User' , 'id' );
    }

    public function orders()
    {
        return $this->hasMany('Nickifrandsen\Leafr\Models\Orders' , 'id' );
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
