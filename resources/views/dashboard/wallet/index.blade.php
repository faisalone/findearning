@extends('dashboard.layouts.app')

@section('content')
<div class="container">
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
					<td>{{ $transaction->wallet->user->name }}</td>
					<!-- Merged Payment Method and Amount -->
					<td>
						{{ $transaction->paymentMethod->name }}<br>
						{{ number_format($transaction->amount, 2) }}
					</td>
					<td>
						@if(isset($transaction->screenshot))
							<div class="magnify-container">
								<img src="{{ asset('storage/screenshots/' . $transaction->screenshot) }}" alt="Screenshot" style="max-width: 50px;">
							</div>
						@else
							-
						@endif
					</td>
					<!-- Fixed Status Column -->
					<td>
						@if($transaction->status === 'approved')
							<span class="badge bg-success">Approved</span>
						@elseif($transaction->status === 'rejected')
							<span class="badge bg-danger">Rejected</span>
						@else
							<span class="badge bg-warning text-dark">Pending</span>
						@endif
					</td>
					<td>
						@if($transaction->status === 'pending')
							<a href="{{ route('transactions.approve', $transaction->id) }}" class="btn btn-success btn-sm me-1 w-100">
								<i class="bi bi-check2-circle"></i>
							</a>
							<a href="{{ route('transactions.reject', $transaction->id) }}" class="btn btn-danger btn-sm w-100">
								<i class="bi bi-x-circle"></i>
							</a>
						@else
							<!-- Action already taken -->
							-
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <div id="lightbox">
        <img id="lightbox-img" src="" alt="Enlarged Screenshot">
    </div>
</div>

<!-- Script for lightbox functionality -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightbox-img');
    document.querySelectorAll('.magnify-container img').forEach(function(img) {
        img.addEventListener('click', function() {
            lightboxImg.src = this.src;
            lightbox.style.display = 'flex';
        });
    });
    lightbox.addEventListener('click', function() {
        lightbox.style.display = 'none';
    });
});
</script>
@endsection