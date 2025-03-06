@extends('dashboard.layouts.app')
@section('title', 'Messages')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Messages</h1>
    </div>
    
    <!-- Desktop view -->
    <div class="card d-none d-md-block">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="15%">Name</th>
                            <th width="20%">Contact</th>
                            <th width="15%">Subject</th>
                            <th width="30%">Message</th>
                            <th width="10%">Date</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                        <tr>
                            <td>{{ $msg->name }}</td>
                            <td>
                                <div>{{ $msg->email ?? 'No Email' }}</div>
                                <div>{{ $msg->phone ?? 'No Phone' }}</div>
                            </td>
                            <td>{{ $msg->subject }}</td>
                            <td>{{ Str::limit($msg->message, 100) }}</td>
                            <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($msg->email)
                                    <a href="mailto:{{ $msg->email }}" class="btn btn-sm btn-primary mb-1 d-block">
                                        Email
                                    </a>
                                @endif
                                @if($msg->phone)
                                    <a href="tel:{{ $msg->phone }}" class="btn btn-sm btn-outline-secondary d-block">
                                        Call
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Mobile view - Accordion Cards -->
    <div class="d-md-none">
        @forelse($messages as $msg)
            <div class="card mb-3">
                <div class="card-header collapsed" id="header-{{ $msg->id }}" 
                     onclick="toggleCollapse('collapse-{{ $msg->id }}', this)">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $msg->subject ?: 'No Subject' }}</strong>
                            <div class="small">From: {{ $msg->name }} - {{ $msg->created_at->format('Y-m-d H:i') }}</div>
                        </div>
						<i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                
                <div class="collapse" id="collapse-{{ $msg->id }}">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold">Message:</div>
                            <div class="col-8">{{ $msg->message }}</div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold">Email:</div>
                            <div class="col-8">{{ $msg->email ?? 'N/A' }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-4 font-weight-bold">Phone:</div>
                            <div class="col-8">{{ $msg->phone ?? 'N/A' }}</div>
                        </div>
                        
                        <div class="d-flex">
                            @if($msg->email)
                                <a href="mailto:{{ $msg->email }}" class="btn btn-primary mr-2">
                                    Reply via Email
                                </a>
                            @endif
                            @if($msg->phone)
                                <a href="tel:{{ $msg->phone }}" class="btn btn-outline-secondary">
                                    Call
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No messages found.</div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $messages->links() }}
    </div>
</div>

<!-- Improved Script for toggling collapse -->
<script>
    function toggleCollapse(targetId, headerElement) {
        const target = document.getElementById(targetId);
        if (target) {
            // Toggle the collapse element
            if (target.classList.contains('show')) {
                target.classList.remove('show');
                headerElement.classList.add('collapsed');
            } else {
                target.classList.add('show');
                headerElement.classList.remove('collapsed');
            }
            
            // Toggle the chevron icon
            const icon = headerElement.querySelector('.bi');
            if (icon) {
                icon.classList.toggle('bi-chevron-down');
                icon.classList.toggle('bi-chevron-up');
            }
        }
    }
</script>
@endsection
