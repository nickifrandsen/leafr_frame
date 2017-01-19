@extends('leafr.core::_layouts.app')

@section('content-header', 'Product / Edit / ' . $product->name . ' / Lagerhåndtering')

@section('content')

@include('leafr.commerce::products.nav')

<section class="container flex is-primary">
    <form action="/backoffice/products/{{ $product->id }}/inventory" method="post" class="flex is-column is-primary box">

        {{ csrf_field() }}

        <div class="is-primary">
            @foreach($product->skus as $sku)
            <input type="hidden" name="sku[]" value="{{ $sku->sku }}">

            <section class="form is-horizontal">    
                <div class="form-group">
                    {{-- <label>Product</label> --}}
                    <p>{{ $sku->sku }}</p>
                </div>
                <div class="form-group">
                    {{-- <label for="amount[{{ $sku->sku }}]">Amount</label> --}}
                    <input type="number" step="1" name="amount[{{ $sku->sku }}]" id="amount[{{ $sku->sku }}]" placeholder="Antal">
                </div>
                <div class="form-group">
                    {{-- <label for="price[{{ $sku->sku }}]">Price</label> --}}
                    <input type="number" step=".50"name="price[{{ $sku->sku }}]" id="price[{{ $sku->sku }}]" placeholder="Pris">
                </div>
                <div class="form-group">
                    {{-- <label for="origin[{{ $sku->sku }}]">Origin</label> --}}
                    <select name="origin[{{ $sku->sku }}]" id="" class="select">
                        <option value="stock">Lagertilførelse</option>
                        <option value="sales">Salg</option>
                        <option value="return">Retur</option>
                        <option value="warranty">Garanti</option>
                        <option value="loss">Svind</option>
                    </select>
                </div>

                <div class="form-group">
                    {{-- <label>Currently in stock</label> --}}
                    <p>In stock: {{ $sku->stock() }}</p>
                </div>
            </section>
            @endforeach
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
    <h3>Transaktioner</h3>

    <table class="table compact centered">

        @if( ! $transactions)

            <tr><td colspan="3" align="center">No transactions have been made for this product yet!</td></tr>

        @else

            <thead>
                <tr>
                    <th></th>
                    <th><i class="material-icons is-success-text">expand_more</i><i class="material-icons is-danger-text">expand_less</i></th>
                    <th><i class="material-icons">euro_symbol</i></th>
                    <th><i class="material-icons">schedule</i></th>
                </tr>
            </thead>

            <tbody>

                @foreach($transactions as $transaction)

                    <tr>
                        <td>{{ $transaction->sku }}</td>
                        <td>
                            @if($transaction->in)
                            <i class="material-icons is-success-text">expand_more</i> {{ $transaction->in }} 
                            @else
                            <i class="material-icons is-danger-text">expand_less</i> {{ $transaction->out }}
                            @endif
                        </td>
                        <td>{{ $transaction->price }}</td>
                        <td>{{ $transaction->created_at->diffForHumans(null, true) }}</td>
                    </tr>

                @endforeach

            </tbody>

        @endif

    </table>
</aside>

</section>
@endsection