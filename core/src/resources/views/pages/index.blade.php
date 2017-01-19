@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Pages</h1>
    <a class="btn is-white" href="/backoffice/pages/create">
        <span class="icon-left">
            <i class="material-icons">add</i>
        </span>
        Create Page
    </a>
@endsection

@section('content')

    @include('leafr.core::_layouts.search', [ 'action' => '/backoffice/pages', 'placeholder' => 'Search pages...', 'submit' => 'Search'])

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
        @each('leafr.core::pages.recursive_list', $pages, 'page')
    </table>


    <!-- Basic Modal -->
    <a class="modal-button" href="#" data-target="custom-modal">Open modal</a>

    <div id="custom-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            Dette er modal indhold.
        </div>
        <button type="button" class="modal-close">
            <i class="material-icons">close</i>
        </button>
    </div>



@endsection
