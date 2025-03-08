@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
        <a href="{{ route('settings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Setting
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card border-0 shadow mb-4">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">All Settings</h6>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="settingSearch" class="form-control bg-light border-0" placeholder="Search settings...">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="settingsTable">
                    <thead class="bg-light">
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $setting)
                            <tr>
                                <td class="align-middle">{{ $setting->key }}</td>
                                <td class="align-middle">
                                    @if($setting->value && strlen($setting->value) > 50)
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            {{ $setting->value }}
                                        </span>
                                    @else
                                        {{ $setting->value ?? '--' }}
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($setting->image)
                                        <img src="{{ asset('storage/' . $setting->image) }}" alt="{{ $setting->key }}" class="img-thumbnail" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('settings.destroy', $setting->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this setting?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr></tr>
                                <td colspan="4" class="text-center py-4">No settings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Search functionality
        $("#settingSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#settingsTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection


