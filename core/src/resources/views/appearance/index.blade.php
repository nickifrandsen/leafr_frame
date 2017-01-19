@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Appearance / {{ $title }}</h1>
    <ul>
    	<li><a href="/backoffice/appearance?block=product_card">Product Card</a></li>
    	<li><a href="/backoffice/appearance?block=article_card">Article Card</a></li>
    </ul>
@endsection


@section('content')
	
	<div class="container flex is-primary">
		<form action="/backoffice/appearance" method="post" id="code-edit-form">
			{{ csrf_field() }}
			<input type="hidden" id="code-content" name="content">
			
		</form>
		<section id="content-main" class="box has-margin">{{ $contents }}</section>
	
		<aside id="content-aside">
			<button type="submit" id="code-save" class="btn">Save</a>
		</aside>

	</div>
@endsection



@section('scripts')

	<script src="/assets/js/ace/ace.js"></script>
	<script>
	    var editor = ace.edit("content-main");
	    editor.setTheme("ace/theme/dawn");
	    editor.getSession().setMode("ace/mode/html");
		editor.getSession().setTabSize(4);
		editor.setShowPrintMargin(false);

		$('#code-save').on('click', function(e) {
			e.preventDefault();

			$('#code-content').val(editor.getValue())

			$('#code-edit-form').submit();
		});
	</script>

@endsection