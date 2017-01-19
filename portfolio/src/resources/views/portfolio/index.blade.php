@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Portfolio</h1>
    <a class="btn is-white" href="/backoffice/posts/create">
        <span class="icon-left">
            <i class="material-icons">add</i>
        </span>
        Opret Post
    </a>
@endsection

@section('content')


    <form action="/backoffice/portfolio/batch" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="file" name="media[]" multiple>

        <button type="submmit">Create batch</button>
    </form>

    @if($items)
        <ul>
            @foreach($items as $item)
                @if(!empty($item->medias))
                    <div class="thumbnails">
                        @foreach($item->medias as $media)
                            <a href="/backoffice/portfolio/{{ $item->id }}/edit">
                                <img src="{{ Storage::disk('local')->url($media->src) }}" alt="" height="75" />
                            </a>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </ul>
    @endif

	
	

@endsection

