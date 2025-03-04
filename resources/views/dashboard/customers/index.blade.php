@extends('dashboard.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="container-fluid px-0 px-md-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> <!-- Added responsive wrapper -->
                        <table id="customerTable" class="table table-bordered table-striped" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Customer Info</th>
                                    <th>Registration Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        {{ $customer->name }}
                                        <br><span>{{ $customer->email }}</span>
                                        <br><span>{{ $customer->contact ?? 'N/A' }}</span>
										<br><strong>Balance: <span class="text-primary">{{ $customer->wallet ? '$' . $customer->wallet->balance : 'No Wallet' }}</span></strong>
                                    </td>
                                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $customer->email_verified_at ? 'success' : 'warning' }}">
                                            {{ $customer->email_verified_at ? 'Verified' : 'Unverified' }}
                                        </span>
                                        <br>
                                        <span class="badge bg-{{ $customer->role == 0 ? 'success' : 'danger' }} mt-1">
                                            {{ $customer->role == 0 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('customers.toggle', $customer->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-{{ $customer->role == 0 ? 'danger' : 'success' }} btn-sm">
                                                {{ $customer->role == 0 ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End responsive wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized on this table
        if ($.fn.DataTable.isDataTable('#customerTable')) {
            // Destroy existing DataTable instance
            $('#customerTable').DataTable().destroy();
        }
        
        // Initialize DataTable
        $('#customerTable').DataTable({
            responsive: true,
            "order": [[ 1, "desc" ]],  // Changed to use registration date column
            "pageLength": 25,
            "language": {
                "search": "Search customers:",
                "lengthMenu": "Show _MENU_ customers per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ customers"
            }
        });
    });
</script>
@endpush