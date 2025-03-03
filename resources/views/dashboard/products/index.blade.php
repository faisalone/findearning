@extends('dashboard.layouts.app')
@section('title', 'All Products')
@section('content')
<div class="container-fluid px-0 px-md-2">
    <x-alert />
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h2 class="text-dark font-weight-bold">Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add Product
        </a>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Status</th>
                            <th>Preview</th>
                            <th>Product Details</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input toggle-status" id="statusSwitch{{ $product->id }}" 
                                               data-id="{{ $product->id }}" {{ $product->status ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="statusSwitch{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    @if($product->images->isNotEmpty())
                                        @foreach($product->imagePaths as $image)
                                            <img src="{{ $image['url'] }}" alt="{{ $product->title }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endforeach
                                    @else
                                        <span class="text-muted"><i class="fas fa-image"></i> No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ $product->category->title ?? 'No Category' }}
                                    </span>
                                    <h6 class="mt-2 font-weight-bold">
										<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="text-primary">{{ $product->title }}</a>
                                    </h6>
                                </td>
                                <td>
                                    @if($product->quantity > 10)
                                        <span class="badge bg-success">{{ $product->quantity }} in stock</span>
                                    @elseif($product->quantity > 0)
                                        <span class="badge bg-warning text-dark">{{ $product->quantity }} left</span>
                                    @else
                                        <span class="badge bg-danger">Out of stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
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
    
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/js/product.js') }}"></script>
@endpush