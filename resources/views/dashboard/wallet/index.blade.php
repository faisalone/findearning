@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
	<h2>eWallet Transactions</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr class="align-middle">
					<!-- Merged ID & Created column -->
					<th>ID <br> Created</th>
					<th>User</th>
					<!-- Merged Payment Method & Amount column -->
					<th>Payment Method <br> Amount</th>
					<th>Screenshot</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr>
					<!-- Merged ID and Created -->
					<td>
						{{ $transaction->id }}<br>
						{{ $transaction->created_at->format('Y-m-d H:i') }}
					</td>
					<td>
						{{ $transaction->user->name }}<br>
						{{ $transaction->user->contact }}<br>
						{{ $transaction->user->email }}
					</td>
					<!-- Merged Payment Method and Amount -->
					<td>
						{{ $transaction->paymentMethod->name }}<br>
						<div class="d-flex align-items-center">
							{{ number_format($transaction->amount, 2) }}
							@if($transaction->status === 'pending' || $transaction->status === 'rejected')
								<button type="button" class="btn btn-primary btn-sm ml-2 adjust-btn" 
									data-id="{{ $transaction->id }}" 
									data-amount="{{ $transaction->amount }}">
									<i class="fa fa-edit"></i>
								</button>
							@endif
						</div>
					</td>
					<td>
						@if(isset($transaction->screenshot))
							<div class="magnify-container">
								<div class="clickable-image-container">
									<img src="{{ asset('storage/transactions/' . $transaction->screenshot) }}" alt="Screenshot" class="screenshot-thumbnail" data-screenshot="{{ asset('storage/transactions/' . $transaction->screenshot) }}">
									<div class="zoom-icon">
										<i class="fa fa-search-plus"></i>
									</div>
								</div>
							</div>
						@else
							-
						@endif
					</td>
					<!-- Fixed Status Column -->
					<td>
						@if($transaction->status === 'approved')
							<span class="badge badge-success">Approved</span>
						@elseif($transaction->status === 'rejected')
							<span class="badge badge-danger">Rejected</span>
						@else
							<span class="badge badge-warning text-dark">Pending</span>
						@endif
					</td>
					<td>
						@if($transaction->status === 'pending')
							<a href="{{ route('transactions.approve', $transaction->id) }}" class="btn btn-success btn-sm mr-1 w-100 mb-1">
								<i class="fa fa-check-circle"></i>
							</a>
							<a href="{{ route('transactions.reject', $transaction->id) }}" class="btn btn-danger btn-sm w-100">
								<i class="fa fa-times-circle"></i>
							</a>
						@elseif($transaction->status === 'approved')
							<a href="{{ route('transactions.reject', $transaction->id) }}" class="btn btn-danger btn-sm w-100">
								<i class="fa fa-times-circle"></i>
							</a>
						@elseif($transaction->status === 'rejected')
							<a href="{{ route('transactions.approve', $transaction->id) }}" class="btn btn-success btn-sm w-100">
								<i class="fa fa-check-circle"></i>
							</a>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<!-- Screenshot Modal -->
<div class="modal fade" id="screenshotModal" tabindex="-1" role="dialog" aria-labelledby="screenshotModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="screenshotModalLabel">Payment Screenshot</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img id="fullScreenshot" src="" alt="Full Screenshot" style="max-width: 100%;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Amount Adjustment Modal -->
<div class="modal fade" id="adjustModal" tabindex="-1" role="dialog" aria-labelledby="adjustModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="adjustModalLabel">Adjust Transaction Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="adjustForm" action="" method="POST">
				@csrf
				@method('PATCH')
				<div class="modal-body">
					<div class="form-group">
							<label>Original Amount</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="text" class="form-control" id="originalAmount" readonly>
							</div>
						</div>
					<div class="form-group">
						<label for="adjustAmount">New Amount</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input type="number" class="form-control" id="adjustAmount" name="amount" step="0.01" min="0" required>
						</div>
						<small class="form-text text-muted">Enter the new amount for this transaction.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save Changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
	$(document).ready(function() {
		// Make the entire container clickable
		$('.clickable-image-container').click(function() {
			var screenshotSrc = $(this).find('.screenshot-thumbnail').data('screenshot');
			$('#fullScreenshot').attr('src', screenshotSrc);
			$('#screenshotModal').modal('show');
		});
		
		// Adjust amount functionality with improved handling
		$(document).on('click', '.adjust-btn', function(e) {
			e.preventDefault();
			console.log('Adjust button clicked');
			
			var transactionId = $(this).data('id');
			var currentAmount = $(this).data('amount');
			
			console.log('Transaction ID:', transactionId);
			console.log('Current Amount:', currentAmount);
			
			// Format the original amount for display
			$('#originalAmount').val(parseFloat(currentAmount).toFixed(2));
			$('#adjustAmount').val(parseFloat(currentAmount).toFixed(2));
			$('#adjustForm').attr('action', '/dashboard/transactions/' + transactionId + '/adjust');
			
			// Show the modal using Bootstrap
			try {
				$('#adjustModal').modal('show');
			} catch(err) {
				console.error('Error showing modal:', err);
			}
		});
	});
</script>
@endpush