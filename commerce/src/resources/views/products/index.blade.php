@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Products</h1>
    <a href="/backoffice/products/create" class="btn is-white">
        <span class="icon-right">
            <i class="material-icons">add</i>
        </span>
        New Product
    </a>
@endsection

@section('content')

    @include('leafr.core::_layouts.search', [ 'action' => '/backoffice/products', 'placeholder' => 'Search products...', 'submit' => 'Søg'])

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Online</th>
                <th>Actions</th>
            </tr>
        </thead>
        
            @foreach($products as $product)
                <tr>
                    <td>
                        <input type="checkbox" name="name" value="" id="select-product-{{ $product->id }}">
                        <label for="select-product-{{ $product->id }}"></label>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->present()->price }}</td>
                    <td>
                        <span class="tag {{ ($product->is_online) ? 'is-success' : 'is-danger' }}">{{ ($product->is_online) ? 'online' : 'offline' }}</span>
                        @if($product->present()->on_sale)
                            <span class="tag is-warning">on sale</span>
                        @endif
                    </td>
                    <td>
                        <a class="" href="/backoffice/products/{{ $product->id }}/edit">
                            <i class="material-icons">mode_edit</i>
                        </a>
                    </td>
                </tr>
            @endforeach
       
    </table>
@endsection
