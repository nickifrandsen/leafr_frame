@extends('leafr.core::_layouts.app')

@section('content-header')
<h1 class="page-title">Orders</h1>
<a class="btn is-white" href="/backoffice/orders/create">
    <span class="icon-left">
        <i class="material-icons">add</i>
    </span>
    New Order
</a>
@endsection

@section('content')

@include('leafr.core::_layouts.search', [ 'action' => '/backoffice/orders', 'placeholder' => 'Search orders...', 'submit' => 'Search'])

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Online</th>
            <th>Parent</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="/backoffice/orders/{{ $order->id }}/edit">
                  <i class="material-icons">edit</i>
              </a>
          </td>
      </tr>
    @endforeach
  </tbody>


</table>

@endsection
