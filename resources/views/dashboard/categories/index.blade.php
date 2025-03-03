@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
    <div class="row mx-0">
        <div class="col-12 px-0 px-md-2">
            <x-alert />
            <div class="card rounded-0 rounded-md">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h4 class="mb-0">Categories Management</h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Add New Category</a>
                </div>
                <div class="card-body p-0 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
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
                                    <td><img src="{{ $category->imagePath }}" alt="{{ $category->title }}" height="50"></td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->products_count }}</td>
                                    <td>
                                        <div class="d-flex flex-column" style="max-width: 120px;">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
    </div>
</div>
@endsection