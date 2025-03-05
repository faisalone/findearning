@extends('dashboard.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="container-fluid px-0 px-md-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Reviews</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="reviewsTable" class="table table-bordered table-striped w-100 nowrap">
                            <thead>
                                <tr>
                                    <th class="product-column">Product</th>
                                    <th class="customer-column">Customer</th>
                                    <th class="review-column">Rating & Comment</th>
                                    <th class="date-column">Date</th>
                                    <th class="status-column">Status</th>
                                    <th class="action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <strong>{{ Str::limit($review->product->title ?? 'Unknown Product', 30) }}</strong>
                                    </td>
                                    <td>
                                        {{ Str::limit($review->user->name ?? 'Unknown User', 20) }}
                                        <br><small>{{ Str::limit($review->user->email ?? 'No email', 20) }}</small>
                                    </td>
                                    <td>
                                        <div class="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="mt-2 comment-text">{{ Str::limit($review->comment, 150) }}</p>
                                        @if($review->image_path)
                                            <img src="{{ asset('storage/'.$review->image_path) }}" 
                                                 alt="Review Image" 
                                                 class="review-image" 
                                                 data-toggle="modal" 
                                                 data-target="#imageModal{{ $review->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $review->status ? 'success' : 'warning' }}">
                                            {{ $review->status ? 'Approved' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('reviews.toggleStatus', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-{{ $review->status ? 'warning' : 'success' }} btn-sm">
                                                {{ $review->status ? 'Reject' : 'Approve' }}
                                            </button>
                                        </form>
                                        <!-- New Delete Review Form -->
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="margin-top:5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this review?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Image Modal -->
                                @if($review->image_path)
                                <div class="modal fade" id="imageModal{{ $review->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Review Image</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/'.$review->image_path) }}" class="modal-image" alt="Review Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
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

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized on this table
        if ($.fn.DataTable.isDataTable('#reviewsTable')) {
            // Destroy existing DataTable instance
            $('#reviewsTable').DataTable().destroy();
        }
        
        // Initialize DataTable with responsive features
        $('#reviewsTable').DataTable({
            responsive: true,
            autoWidth: false,
            ordering: true,
            paging: true,
            columnDefs: [
                { responsivePriority: 1, targets: [0, 2, 5] }, // Most important columns
                { responsivePriority: 2, targets: [4] },        // Medium priority
                { responsivePriority: 3, targets: [1, 3] }      // Least priority columns
            ],
            order: [[ 3, "desc" ]],  // Sort by date column
            pageLength: 25,
            language: {
                search: "Search reviews:",
                lengthMenu: "Show _MENU_ reviews per page",
                info: "Showing _START_ to _END_ of _TOTAL_ reviews"
            }
        });
        
        // Ensure proper resizing when window changes
        $(window).resize(function() {
            $('#reviewsTable').DataTable().responsive.recalc();
        });
    });
</script>
@endpush
