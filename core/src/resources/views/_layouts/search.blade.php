	<form action="{{ $action or null }}" method="{{ $method or 'GET' }}">
		<div class="search-form-box">
			<input type="text" class="is-large" name="q" placeholder="{{ $placeholder  or 'Search...' }} ">
			<button class="btn" type="submit">
				<div>
					<span class="icon-left">
						<i class="material-icons">search</i>
					</span>
					{{ $submit or 'Search' }}
				</div>
			</button>
		</div>
	</form>