@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
	<x-alert />

	<x-form 
		form-id="pageCreateForm" 
		form-action="{{ route('pages.store') }}" 
		method="POST"
		title="Create Page"
		:discardRoute="route('pages.index')"
	>
		<x-form.input 
			label="Title" 
			name="title" 
			:value="old('title')" 
		/>

		<x-form.textarea 
			label="Content" 
			name="content"
		>
			{{ old('content') }}
		</x-form.textarea>
		
		<x-form.option 
			name="status" 
			:options="['1' => 'Publish', '0' => 'Draft']"  
			label="Status"
			:selected="old('status', '1')"
		/>

		<x-form.option 
			name="position" 
			:options="['1' => 'Information Pages', '2' => 'My Account Pages']" 
			label="Position"
			:selected="old('position')"
		/>
	</x-form>
</div>
@endsection