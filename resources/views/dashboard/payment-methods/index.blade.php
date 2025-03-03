@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
	<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
		<h1 class="h3 mb-2 mb-md-0">Payment Methods</h1>
		<a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Create New Payment Method</a>
	</div>

	<!-- Desktop table view (hidden on small screens) -->
	<div class="table-responsive d-none d-md-block">
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name(Instruction)</th>
					<th>Address</th>
					<th>QR</th>
					<th>Rate</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($paymentMethods as $paymentMethod)
				<tr>
					<td>
						@if($paymentMethod->image)
							<img src="{{ $paymentMethod->image_path }}" alt="{{ $paymentMethod->name }}" class="img-fluid" style="max-width:50px;">
						@endif
					</td>
					<td>{{ $paymentMethod->name }}( {{ $paymentMethod->instruction }})</td>
					<td>
						@if($paymentMethod->address)
							<div class="d-flex align-items-center address-container">
								<span data-toggle="tooltip" title="{{ $paymentMethod->address }}" class="address-truncate">
									{{ strlen($paymentMethod->address) > 20 ? substr($paymentMethod->address, 0, 10).'...'.substr($paymentMethod->address, -10) : $paymentMethod->address }}
								</span>
								<button type="button" class="btn btn-sm btn-light ml-2 copy-btn" data-copy-text="{{ $paymentMethod->address }}">
									<i class="fas fa-copy"></i>
									<span class="custom-tooltip">Copied!</span>
								</button>
							</div>
						@else
							N/A
						@endif
					</td>
					<td>
						@if($paymentMethod->qr)
							<img src="{{ $paymentMethod->qr_path }}" alt="{{ $paymentMethod->name }}" class="img-fluid" style="max-width:50px;">
						@endif
					</td>					
					<td>{{ $paymentMethod->rate }}</td>
					<td>{{ $paymentMethod->status ? 'Active' : 'Inactive' }}</td>
					<td>
						<a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" class="btn btn-sm btn-info">Edit</a>
						<form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Mobile card view (visible only on small screens) -->
	<div class="d-md-none">
		@foreach($paymentMethods as $paymentMethod)
			<div class="card mb-3">
				<div class="card-body">
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Image:</div>
						<div class="col-8">
							@if($paymentMethod->image)
								<img src="{{ $paymentMethod->image_path }}" alt="{{ $paymentMethod->name }}" class="img-fluid" style="max-width:50px;">
							@else
								No image
							@endif
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Name:</div>
						<div class="col-8">{{ $paymentMethod->name }}</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Instruction:</div>
						<div class="col-8">{{ $paymentMethod->instruction }}</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Address:</div>
						<div class="col-8">
							@if($paymentMethod->address)
								<div class="d-flex align-items-center address-container">
									<span data-toggle="tooltip" title="{{ $paymentMethod->address }}" class="address-truncate">
										{{ strlen($paymentMethod->address) > 20 ? substr($paymentMethod->address, 0, 10).'...'.substr($paymentMethod->address, -10) : $paymentMethod->address }}
									</span>
									<button type="button" class="btn btn-sm btn-light ml-2 copy-btn" data-copy-text="{{ $paymentMethod->address }}">
										<i class="fas fa-copy"></i>
										<span class="custom-tooltip">Copied!</span>
									</button>
								</div>
							@else
								N/A
							@endif
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">QR:</div>
						<div class="col-8">
							@if($paymentMethod->qr)
								<img src="{{ $paymentMethod->qr_path }}" alt="{{ $paymentMethod->name }}" class="img-fluid" style="max-width:50px;">
							@else
								No QR
							@endif
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Rate:</div>
						<div class="col-8">{{ $paymentMethod->rate }}</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold">Status:</div>
						<div class="col-8">{{ $paymentMethod->status ? 'Active' : 'Inactive' }}</div>
					</div>
					<div class="mt-3">
						<a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" class="btn btn-info">Edit</a>
						<form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<div class="d-flex justify-content-center">
		{{ $paymentMethods->links() ?? '' }}
	</div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle click on copy buttons
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy-text');
                
                // Copy text to clipboard using native clipboard API
                copyToClipboard(textToCopy, this);
            });
        });
        
        // Initialize standard tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    function copyToClipboard(text, buttonElement) {
        // Check for modern clipboard API support
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showCopiedTooltip(buttonElement);
            }).catch(err => {
                // Fall back to older method if clipboard API fails
                fallbackCopyTextToClipboard(text, buttonElement);
            });
        } else {
            // For older browsers
            fallbackCopyTextToClipboard(text, buttonElement);
        }
    }
    
    function fallbackCopyTextToClipboard(text, buttonElement) {
        // Create temporary element
        const textArea = document.createElement("textarea");
        textArea.value = text;
        
        // Make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopiedTooltip(buttonElement);
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
        
        document.body.removeChild(textArea);
    }
    
    function showCopiedTooltip(buttonElement) {
        // Add active class to show the tooltip
        buttonElement.classList.add('active');
        
        // Remove active class after delay
        setTimeout(() => {
            buttonElement.classList.remove('active');
        }, 1500);
    }
</script>
@endpush
@endsection