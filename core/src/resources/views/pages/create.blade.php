@extends('leafr.core::_layouts.app')

@section('content-header', 'Pages / New')

@section('content')

<form class="container flex is-primary" action="/backoffice/pages" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    @include('leafr.core::pages.form', ['page' => $page , 'formButtonText' => 'Create'])
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
