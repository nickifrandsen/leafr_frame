@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Inventory Transactions</h1>
    <a href="/backoffice/products/create" class="btn is-white">
        <span class="icon-right">
            <i class="material-icons">add</i>
        </span>
        New Transaction
    </a>
@endsection

@section('content')

    @include('leafr.core::_layouts.search', [ 'action' => '/backoffice/products', 'placeholder' => 'Search products...', 'submit' => 'Søg'])
    <table class="table">

        @if( ! $transactions)

            <tr><td colspan="3" align="center">No transactions have been made for this product yet!</td></tr>

        @else

            <thead>
                <tr>
                    <th></th>
                    <th><i class="material-icons is-success-text">expand_more</i> in <i class="material-icons is-danger-text">expand_less</i> out</th>
                    <th>Price</th>
                    <th>Origin</th>
                    <th><i class="material-icons">schedule</i></th>
                </tr>
            </thead>

            <tbody>

                @each('leafr.commerce::inventory.card', $transactions, 'transaction')

            </tbody>

        @endif

    </table>
@endsection
