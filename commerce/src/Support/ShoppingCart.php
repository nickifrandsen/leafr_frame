<?php

namespace Leafr\Commerce\Support;

use Illuminate\Support\Collection;
use Leafr\Commerce\Shipping;
use Leafr\Commerce\CartItem;
use Leafr\Commerce\Cart;
use Leafr\Commerce\Sku;

class ShoppingCart 
{

	private $session;

	private $cart;

	public function __construct(Cart $cart)
	{
		// $this->session = $session;
		$this->cart = $cart->firstOrNew(['session_id' => \Session::getId()]);
	}

	public function add(Sku $sku, $qty = 1, array $options = [])
    {

    	if ( ! $this->cart->shipping_method_id )
    	{
    		$this->cart->shipping_method_id = 1;
    	}

    	$this->cart->save();

    	if( $item = $this->cart->items()->where('sku', $sku->sku)->first() )
    	{
    		return $this->updateItemQuantity($item, $qty);	
    	}

        $item = new CartItem([ 'sku' => $sku->sku, 'description' => $sku->product->name, 'quantity' => $qty]);

        $this->cart->items()->save($item);

        return $this;
    }

    public function items()
    {
    	return $this->cart->items;
    }

    public function count()
    {
    	return $this->cart->items->count();
    }

    public function update()
    {
        
    }

    public function remove($id)
    {
       	$item = $this->cart->items()->find($id);
		$item->delete();

        return $this;
    }

    public function destroy()
    {
        $this->cart->items()->where('cart_id', $this->cart->id)->delete();
        $this->cart->destroy( $this->cart->id );

        return $this;
    }

    public function discount() {
    	return '';
    }

	public function subtotal()
	{
		$total = 0;

		// dd($this->items()->all());

		foreach($this->items() as $item)
		{
			$subtotal = $item->quantity * $item->product->price;
			$total = $subtotal + $total;
		}
		
		return $total;
	}


	public function total()
	{
		$total = $this->subtotal() + $this->shippingPrice();
		
		return $total;
	}

	public function vat()
	{
		$tax = $this->total() * 0.2;
		return $tax;
	}

	public function shipping()
	{
		return Shipping::findOrNew($this->cart->shipping_method_id);
	}

	public function shippingPrice()
	{

        if( ! empty($this->shipping()->free_above) && $this->subtotal() >= $this->shipping()->free_above ) 
        {
            return floatval(0);
        }

        return $this->shipping()->unit_price;

	}

	private function updateItemQuantity($item, $qty = 1)
	{
		if( ! $item )
		{
			return $this;
		} 

		$item->quantity = $item->quantity + $qty;
    	$item->save();
    		
    	return $this;
	}

}