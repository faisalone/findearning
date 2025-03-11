@extends('dashboard.layouts.app')

@section('title', 'Newsletter Subscribers')

@push('styles')
<!-- DataTables CSS -->
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    .user-agent-pre {
        white-space: pre-wrap;
        word-break: break-all;
        max-height: 100px;
        overflow-y: auto;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Newsletter Subscribers</h1>
    <div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="exportCsv">
            <i class="fas fa-file-csv fa-sm text-white-50"></i> Export CSV
        </a>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Subscriber Statistics Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Subscribers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($subscribers) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Device Distribution Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Device Distribution</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php
                                $mobile = $subscribers->where('deviceInfo.device', 'Mobile')->count();
                                $desktop = $subscribers->where('deviceInfo.device', 'Desktop')->count();
                                $tablet = $subscribers->where('deviceInfo.device', 'Tablet')->count();
                                $total = count($subscribers);
                            @endphp
                            @if($total > 0)
                                <div class="progress progress-sm mr-2 mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($mobile/$total)*100 }}%"></div>
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ ($desktop/$total)*100 }}%"></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($tablet/$total)*100 }}%"></div>
                                </div>
                                <small>Mobile: {{ $mobile }} | Desktop: {{ $desktop }} | Tablet: {{ $tablet }}</small>
                            @else
                                No data available
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-mobile-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Browser Distribution Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Top Browsers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php
                                $browsers = $subscribers->groupBy('deviceInfo.browser');
                                $topBrowsers = collect($browsers)->sortByDesc(function($items) {
                                    return count($items);
                                })->take(3);
                            @endphp
                            
                            @forelse($topBrowsers as $browser => $items)
                                <div class="mb-1">
                                    <small>{{ $browser }}: <b>{{ count($items) }}</b>
                                    ({{ round((count($items)/$total)*100) }}%)</small>
                                </div>
                            @empty
                                <small>No data available</small>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-globe fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Subscribers List</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Actions:</div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#emailModal">
                            <i class="fas fa-envelope mr-2"></i>Email All Subscribers
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="subscribersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Device</th>
                                <th>OS</th>
                                <th>Browser</th>
                                <th>Subscribed Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>
                                    @if($subscriber->deviceInfo['device'] == 'Mobile')
                                        <span class="badge badge-primary"><i class="fas fa-mobile-alt mr-1"></i> Mobile</span>
                                    @elseif($subscriber->deviceInfo['device'] == 'Tablet')
                                        <span class="badge badge-info"><i class="fas fa-tablet-alt mr-1"></i> Tablet</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-desktop mr-1"></i> Desktop</span>
                                    @endif
                                </td>
                                <td>{{ $subscriber->deviceInfo['os'] }}</td>
                                <td>{{ $subscriber->deviceInfo['browser'] }}</td>
                                <td>{{ $subscriber->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info view-subscriber" data-id="{{ $subscriber->id }}">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                    <button type="button" class="btn btn-sm btn-info view-ua" 
                                        data-toggle="popover" 
                                        title="User Agent Details" 
                                        data-content="{{ $subscriber->user_agent }}">
                                        <i class="fas fa-info-circle"></i> User Agent
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No subscribers found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Email All Subscribers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="emailSubject">Subject</label>
                        <input type="text" class="form-control" id="emailSubject" placeholder="Enter email subject">
                    </div>
                    <div class="form-group">
                        <label for="emailContent">Message</label>
                        <textarea class="form-control" id="emailContent" rows="5" placeholder="Enter your message here"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Email</button>
            </div>
        </div>
    </div>
</div>

<!-- Subscriber Details Modal -->
<div class="modal fade" id="subscriberDetailsModal" tabindex="-1" role="dialog" aria-labelledby="subscriberDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="subscriberDetailsModalLabel">Subscriber Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Loading Indicator -->
                <div class="text-center mb-3" id="loadingIndicator">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Loading subscriber details...</p>
                </div>
                
                <!-- Subscriber Details Content -->
                <div id="subscriberDetails" style="display: none;">
                    <div class="row">
                        <!-- Basic Information Card -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user mr-1"></i> Basic Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Email:</strong> <span id="subscriberEmail"></span></p>
                                    <p><strong>Subscribed Date:</strong> <span id="subscriberCreatedAt"></span></p>
                                    <p><strong>Last Updated:</strong> <span id="subscriberUpdatedAt"></span></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Device Information Card -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-desktop mr-1"></i> Device Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3" id="deviceIcon"></div>
                                    <p><strong>Device Type:</strong> <span id="subscriberDevice"></span></p>
                                    <p><strong>Operating System:</strong> <span id="subscriberOS"></span></p>
                                    <p><strong>Browser:</strong> <span id="subscriberBrowser"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Agent Card -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-code mr-1"></i> User Agent String
                            </h6>
                        </div>
                        <div class="card-body">
                            <pre class="bg-light p-3 rounded user-agent-pre" id="subscriberUserAgent"></pre>
                        </div>
                    </div>
                </div>
                
                <!-- Error Message -->
                <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" target="_blank" class="btn btn-primary" id="emailSubscriber">
                    <i class="fas fa-envelope"></i> Email Subscriber
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables JavaScript -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Properly initialize or reinitialize DataTable
        if ($.fn.DataTable) {
            // Check if table is already initialized and destroy it first
            if ($.fn.DataTable.isDataTable('#subscribersTable')) {
                $('#subscribersTable').DataTable().destroy();
            }
            
            // Initialize DataTable with settings
            $('#subscribersTable').DataTable({
                "order": [[ 0, "desc" ]],
                "pageLength": 25
            });
        } else {
            console.error('DataTables plugin is not loaded properly');
        }
        
        // Initialize popovers with Bootstrap 4.6.0 settings
        $('.view-ua').popover({
            trigger: 'focus',
            placement: 'left',
            html: true,
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body text-wrap" style="max-width: 300px; word-break: break-all;"></div></div>',
            container: 'body'
        });

        // Export to CSV functionality
        $('#exportCsv').click(function(e) {
            e.preventDefault();
            
            // Prepare CSV content
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "ID,Email,Device,OS,Browser,Subscribed Date\n";
            
            @foreach($subscribers as $subscriber)
                csvContent += "{{ $subscriber->id }},{{ $subscriber->email }},{{ $subscriber->deviceInfo['device'] }},{{ $subscriber->deviceInfo['os'] }},{{ $subscriber->deviceInfo['browser'] }},{{ $subscriber->created_at->format('Y-m-d H:i:s') }}\n";
            @endforeach
            
            // Create download link
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "newsletter_subscribers.csv");
            document.body.appendChild(link);
            
            // Trigger download
            link.click();
            document.body.removeChild(link);
        });
        
        // View Subscriber Details Modal
        $('.view-subscriber').on('click', function() {
            const subscriberId = $(this).data('id');
            
            // Reset modal and show loading
            $('#subscriberDetails').hide();
            $('#errorMessage').hide();
            $('#loadingIndicator').show();
            
            // Show the modal with Bootstrap 4.6.0
            $('#subscriberDetailsModal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            
            // Fetch subscriber details with jQuery 3.6.0
            $.ajax({
                url: `{{ url('/dashboard/subscribers') }}/${subscriberId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const subscriber = response.subscriber;
                        
                        // Fill in subscriber details
                        $('#subscriberEmail').text(subscriber.email);
                        $('#subscriberCreatedAt').text(subscriber.formattedCreatedAt);
                        $('#subscriberUpdatedAt').text(subscriber.formattedUpdatedAt);
                        
                        // Device info
                        $('#subscriberDevice').text(subscriber.deviceInfo.device);
                        $('#subscriberOS').text(subscriber.deviceInfo.os);
                        $('#subscriberBrowser').text(subscriber.deviceInfo.browser);
                        $('#subscriberUserAgent').text(subscriber.user_agent);
                        
                        // Device icon
                        let iconHTML = '';
                        if (subscriber.deviceInfo.device === 'Mobile') {
                            iconHTML = '<i class="fas fa-mobile-alt fa-4x text-primary"></i>';
                        } else if (subscriber.deviceInfo.device === 'Tablet') {
                            iconHTML = '<i class="fas fa-tablet-alt fa-4x text-info"></i>';
                        } else {
                            iconHTML = '<i class="fas fa-desktop fa-4x text-secondary"></i>';
                        }
                        $('#deviceIcon').html(iconHTML);
                        
                        // Email link
                        $('#emailSubscriber').attr('href', `mailto:${subscriber.email}`);
                        
                        // Hide loading and show details
                        $('#loadingIndicator').hide();
                        $('#subscriberDetails').fadeIn(300);
                    } else {
                        showError('Failed to load subscriber details.');
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        showError(xhr.responseJSON.error);
                    } else {
                        showError('An error occurred while loading the subscriber details.');
                    }
                }
            });
        });
        
        // Error display function
        function showError(message) {
            $('#loadingIndicator').hide();
            $('#errorMessage').text(message).fadeIn(300);
        }
    });
</script>
@endpush
