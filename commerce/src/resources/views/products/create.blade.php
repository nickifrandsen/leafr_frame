@extends('leafr.core::_layouts/app')

@section('content-header', 'Product / Create')

@section('content')

<form class="container flex is-primary" action="/backoffice/products" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}
    @include('leafr.commerce::products.form', compact('product'))

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

        //   $('#medias').dropzone({autoProcessQueue:false});
        });
    </script>

@endsection
