@extends('dashboard.layouts.app')

@section('content')
<div class="container rounded bg-white p-2 shadow-sm">
    <x-alert />
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Add Product
    </a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Status</th>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-status" type="checkbox" role="switch" id="flexSwitchCheckChecked{{ $product->id }}" data-id="{{ $product->id }}" {{ $product->status ? 'checked' : '' }}>
                            </div>
                        </td>
						<td>
							@if($product->images->isNotEmpty())
								@foreach($product->imagePaths as $image)
									<img src="{{ $image['url'] }}" alt="{{ $product->title }}" class="img-thumbnail" style="width: 50px; height: 50px;">
								@endforeach
							@else
								<span>No Image</span>
							@endif
						</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $product->category->title ?? 'No Category' }}
                            </span><br>
                            <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                        </td>

                        <td>
                            <div class="d-flex flex-column">
                                <a href="{{ route('products.addVariant', $product) }}" class="btn btn-info btn-sm mb-1 w-100">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm mb-1 w-100">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="mb-1 w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
	<script src="{{ asset('backend/js/product.js') }}"></script>
@endpush