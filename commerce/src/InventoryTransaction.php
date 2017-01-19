<?php 

namespace Leafr\Commerce;

class InventoryTransaction
{


    public function transaction(int $amount)
    {
        if ($amount > 0) 
        {
           $this->in = abs($amount);
           
           return $this;
        }

       $this->out = abs($amount);

       return $this;
    }

    public function price($price)
    {
        if ( $price > 0) {
            $this->price = $price;
        }
        
        return $this;
    }

    public function origin(string $origin)
    {
        $this->origin = $origin;

        return $this;
    }

    public function make(Sku $sku)
    {

        $this->product_id = $sku->product_id;
        $this->sku = $sku->sku;

        return (new Inventory((array) $this))->save();
    }
}
