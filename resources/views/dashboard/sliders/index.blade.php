@extends('dashboard.layouts.app')

@section('content')
<div class="container">
	<x-alert />
	<div class="row">
		<div class="col-12">
			<h1>Sliders</h1>
			<a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3">Add New Slider</a>
			<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>Preview</th>
						<th>Title</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sliders as $slider)
					<tr>
						<td><img src="{{ $slider->imagePath }}" alt="{{ $slider->title }}" height="30"></td>
						<td>{{ $slider->title }}</td>
						<td>
							<a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>
							<form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
