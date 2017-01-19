@extends('leafr.core::_layouts.app')

@section('content-header', '<h1 class="page-title">Pages / Edit / ' . $page->title . '</h1>')

@section('content')

<form class="container flex is-primary" action="/backoffice/pages/{{ $page->id }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="id" value="{{ $page->id }}" readonly />

    @include('leafr.core::pages.form', ['page' => $page, 'formButtonText' => 'Save'])
</form>

@endsection



@section('scripts')

    <script>
        var simplemde = new SimpleMDE({
            forceSync: true,
            promptURLs: true,
            element: $(".markdown-editor")[0]
        });

        $(document).ready(function() {
          $('.select').niceSelect();
        //   $('#medias').dropzone({autoProcessQueue:false});
        });
    </script>

@endsection
