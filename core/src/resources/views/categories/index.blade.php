@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Categories</h1>
    <a class="btn is-white modal-button" href="#" data-target="custom-modal">
        <span class="icon-left">
            <i class="material-icons">add</i>
        </span>
        Create Category
    </a>
@endsection

@section('content')

    @include('leafr.core::_layouts.search', [ 'action' => '/backoffice/categories', 'placeholder' => 'Search categories...', 'submit' => 'Search'])

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent</th>
                <th>Actions</th>
            </tr>
        </thead>
        @each('leafr.core::categories.recursive_list', $categories, 'category')
    </table>

    <!-- Create Category Modal -->
    <div id="custom-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            @include('leafr.core::categories.form')
        </div>
        <button type="button" class="modal-close">
            <i class="material-icons">close</i>
        </button>
    </div>



@endsection
