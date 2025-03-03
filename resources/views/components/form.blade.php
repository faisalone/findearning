@props([
	'formId',
	'formAction',
	'method' => 'POST',
	'enctype' => null,
	'title' => null,
	'discardRoute' => null,
])
@if($title)
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1>{{ $title }}</h1>
		<div>
			@if($discardRoute)
				<a href="{{ $discardRoute }}" class="btn btn-outline-secondary mr-2 mb-2 mb-md-0">
					<i class="bi bi-x-circle"></i> Discard
				</a>
			@endif
			<button type="submit" form="{{ $formId }}" class="btn btn-primary">
				<i class="bi bi-check-circle"></i> Submit
			</button>
		</div>
	</div>
@endif
<form id="{{ $formId }}" action="{{ $formAction }}" method="POST" @if($enctype) enctype="{{ $enctype }}" @endif>
	@csrf
	@if(strtoupper($method) !== 'POST')
		@method($method)
	@endif
	{{ $slot }}
	<!-- ...existing code... -->
</form>
