@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <x-alert />
    <div class="row">
        <div class="col-12">
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
						<th>Preview</th>
                        <th>Title</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
						<td><img src="{{ $category->imagePath }}" alt="{{ $category->title }}" height="30"></td>
						<td>{{ $category->title }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td class="d-flex flex-column">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mb-1 w-100">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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