<?php 

namespace Leafr\Commerce;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 **/
class Inventory extends Model
{
    protected $table = 'inventory_transactions';

    protected $fillable = [
        'product_id',
    	'sku',
    	'in',
    	'out',
    	'price',
    	'origin'
    ];

    public function sku()
    {
    	return $this->belongsTo('Leafr\Commerce\Sku', 'sku');
    }
}
