@extends('leafr.core::_layouts.app')

@section('content-header')
    <h1 class="page-title">Settings</h1>
@endsection

@section('content')
	
	<form action="/backoffice/settings" class="container flex is-primary">
		
		{{ csrf_field() }}
		{{ method_field('PUT') }}

		<section id="content-main" class="box">
			@foreach($settings as $setting)
			
				<div class="form-group">

					<label for="{{ $setting->key }}">{{ $setting->description }}</label>

					@if($setting->type == 'string')
						<input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}">
					@elseif($setting->type == 'integer')
						<input type="number" name="{{ $setting->key }}" value="{{ $setting->value }}">
					@endif

				</div>

			@endforeach
		</section>
		

		<aside id="content-aside">
			<button type="submit">Save</button>
		</aside>
		
	</form>
	
@endsection