@extends('leafr.core::_layouts.app')

@section('content-header', 'Product / Edit / ' . $product->name . ' / Kategorier')

@section('content')

@include('leafr.commerce::products.nav')

<section class="container flex is-primary">
    <form action="/backoffice/products/{{ $product->id }}/categories" method="post" class="flex is-column is-primary box">

        {{ csrf_field() }}

        <div class="is-primary">
           
            @if( $categories->isEmpty() )
                <p>Der er endnu ikke oprettet nogle kategorier.</p>
            @else

                @foreach($categories as $category)
                    <div class="checkbox">
                        <input type="hidden" name="category[{{ $category->id }}]" value="0">
                        <input type="checkbox" 
                               id="category[{{ $category->id }}]" 
                               name="category[{{ $category->id }}]" 
                               value="1"
                               @if($product->categories()->where('category_id', $category->id)->first()) checked @endif>
                        <label for="category[{{ $category->id }}]">{{ $category->name }}</label>
                    </div>
                @endforeach
               
            @endif
        </div>
        <button type="submit" class="btn is-wide is-success">
             <div>
                <span class="icon-left">
                    <i class="material-icons">done</i>
                </span>
                Save
            </div>
        </button>
</form>  

<aside id="content-aside">

    <h3>Opret ny kategori</h3>
    
    @include('leafr.core::categories.form')

</aside>

</section>
@endsection