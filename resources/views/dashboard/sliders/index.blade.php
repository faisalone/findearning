@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-2 py-2">
	<x-alert />
	<div class="row">
		<div class="col-12">
			<h1 class="h2 mb-3">Sliders</h1>
			<div class="d-flex justify-content-between flex-wrap mb-3">
				<a href="{{ route('sliders.create') }}" class="btn btn-primary mb-2">Add New Slider</a>
			</div>
			<div class="table-responsive">
				<table class="table table-striped w-100">
					<thead>
						<tr>
							<th class="text-nowrap">Preview</th>
							<th>Title</th>
							<th class="text-nowrap text-right">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sliders as $slider)
						<tr>
							<td><img src="{{ $slider->imagePath }}" alt="{{ $slider->title }}" class="img-fluid" style="max-height: 50px; max-width: 100px;"></td>
							<td class="text-break">{{ $slider->title }}</td>
							<td>
								<div class="d-flex flex-column flex-md-row justify-content-end">
									<a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-warning mb-1 mb-md-0 mr-md-2">Edit</a>
									<form action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</button>
									</form>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
