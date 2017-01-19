@extends('leafr.core::_layouts.app')

@section('content-header', 'Orders')

@section('content')
    @foreach($order->products as $product)
        {{ $product->quantity }} x {{ $product->product->name }} {{ $product->unit_price }} {{ $product->subtotal }} 
    @endforeach
@endsection
