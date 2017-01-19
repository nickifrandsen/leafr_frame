@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Product Types</h1>
    <a href="/backoffice/products/create" class="btn is-white">
        <span class="icon-right">
            <i class="material-icons">add</i>
        </span>
        New Product Type
    </a>
@endsection

@section('content')

    <table class="table">

        @if( ! $types)

            <tr><td colspan="3" align="center">No product types have been created yet!</td></tr>

        @else

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Identifier</th>
                    <th>Description</th>
                </tr>
            </thead>

            <tbody>

                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->identifier }}</td>
                        <td>{{ $type->description }}</td>
                    </tr>
                @endforeach

            </tbody>

        @endif

    </table>
@endsection
