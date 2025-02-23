@extends('dashboard.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    /* Added to break long words in table cells */
    #customerTable th,
    #customerTable td {
        word-break: break-all;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        {{ $customer->name }}
                                        <br><span>{{ $customer->email }}</span>
                                        <br><span>{{ $customer->contact ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $customer->email_verified_at ? 'success' : 'warning' }}">
                                            {{ $customer->email_verified_at ? 'Verified' : 'Unverified' }}
                                        </span>
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
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]],
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