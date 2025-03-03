@extends('dashboard.layouts.app')
@section('content')
<div class="container-fluid px-0 px-md-2">
	<x-alert />
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-3">
			<div class="card shadow-sm">
				<div class="card-body text-center">
					<!-- New Wallet Balance Block with Bootstrap icon -->
					<div class="card mb-3 shadow-sm">
						<div class="card-body d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="bi bi-wallet2 text-primary"></i>
								<strong class="ms-3">
                                    @if($customer->wallet)
                                        ${{ number_format($customer->wallet->balance, 2) }}
                                    @else
                                        $0.00
                                    @endif
                                </strong>
							</div>
							<!-- Changed recharge button to link to dedicated recharge page -->
							<a href="{{ route('recharge.index') }}" class="btn btn-outline-primary btn-sm">
								Recharge
							</a>
						</div>
					</div>
					<!-- Profile Initial Avatar -->
					<div class="profile-icon bg-primary rounded-circle mb-3 text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 36px;">
						{{ strtoupper(substr($customer->name, 0, 1)) }}
					</div>
					<!-- Customer Name and Email -->
					<h5 class="mb-1">{{ $customer->name }}</h5>
					<p class="text-muted mb-3">{{ $customer->email }}</p>
					<hr>
					<div class="d-flex justify-content-between mb-2">
						<span><i class="bi bi-cart"></i> Total Orders</span>
						<span class="font-weight-bold">{{ count($customer->orders) }}</span>
					</div>
					<div class="d-flex justify-content-between mb-2">
						<span><i class="bi bi-calendar"></i> Joined On</span>
						<span class="font-weight-bold">{{ $customer->created_at->format('M d, Y') }}</span>
					</div>
				</div>
			</div>
        </div>

        <!-- Profile Content -->
        <div class="col-lg-9">
            <!-- Removed tab functionality and orders section; Only profile update is kept -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <!-- Updated form tag without image upload field -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Full Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $customer->name }}">
								@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customer->email }}">
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Telegram/WhatsApp</label>
								<input type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $customer->contact }}">
								@error('contact')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
            
            <!-- Recharge History -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recharge History</h5>
                </div>
                <div class="card-body">
                    @if($customer->transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                                        <td>{{ number_format($transaction->amount, 2) }}</td>
                                        <td>{{ $transaction->paymentMethod->name }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $customer->transactions->links() }}
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-wallet2 text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">No recharge history found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection