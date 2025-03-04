@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSettingModal">
            <i class="fas fa-plus mr-1"></i> Add Setting
        </button>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card border-0 mb-4">
        <div class="card-header bg-white">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-right-0"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="settingSearch" class="form-control border-left-0" placeholder="Search settings...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover" id="settingsTable">
                    <thead class="bg-light">
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $setting)
                            <tr>
                                <td class="align-middle">{{ $setting->key }}</td>
                                <td class="align-middle">
                                    @if(strlen($setting->value) > 50)
                                        {{ substr($setting->value, 0, 50) }}...
                                        <button type="button" class="btn btn-sm btn-link p-0 view-value" 
                                                data-value="{{ $setting->value }}">
                                            View All
                                        </button>
                                    @else
                                        {{ $setting->value }}
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary edit-setting" 
                                                data-toggle="modal" data-target="#editSettingModal"
                                                data-id="{{ $setting->id }}" 
                                                data-key="{{ $setting->key }}" 
                                                data-value="{{ $setting->value }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-setting" 
                                                data-toggle="modal" data-target="#deleteSettingModal"
                                                data-id="{{ $setting->id }}" 
                                                data-key="{{ $setting->key }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No settings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Setting Modal -->
<div class="modal fade" id="addSettingModal" tabindex="-1" role="dialog" aria-labelledby="addSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSettingModalLabel">Add New Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="key">Key</label>
                        <input type="text" class="form-control" id="key" name="key" required>
                        <small class="form-text text-muted">Use a descriptive name (e.g., site_title, contact_email)</small>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <textarea class="form-control" id="value" name="value" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Setting</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Setting Modal -->
<div class="modal fade" id="editSettingModal" tabindex="-1" role="dialog" aria-labelledby="editSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSettingModalLabel">Edit Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSettingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_key">Key</label>
                        <input type="text" class="form-control" id="edit_key" name="key" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_value">Value</label>
                        <textarea class="form-control" id="edit_value" name="value" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Setting</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Setting Modal -->
<div class="modal fade" id="deleteSettingModal" tabindex="-1" role="dialog" aria-labelledby="deleteSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSettingModalLabel">Delete Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the setting: <strong id="delete_key"></strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteSettingForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Value Modal -->
<div class="modal fade" id="viewValueModal" tabindex="-1" role="dialog" aria-labelledby="viewValueModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewValueModalLabel">Setting Value</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" id="full_value" rows="5" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        
        // Use event delegation for dynamically created elements
        // View full value
        $(document).on('click', '.view-value', function() {
            $('#full_value').val($(this).data('value'));
            $('#viewValueModal').modal('show');
        });
        
        // Instead of click handlers, update modals on show event using event.relatedTarget
        $('#editSettingModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var key = button.data('key');
            var value = button.data('value');
            
            var modal = $(this);
            modal.find('#edit_key').val(key);
            modal.find('#edit_value').val(value);
            modal.find('#editSettingForm').attr('action', '{{ url("/dashboard/settings") }}/' + id);
        });

        $('#deleteSettingModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var key = button.data('key');
            
            var modal = $(this);
            modal.find('#delete_key').text(key);
            modal.find('#deleteSettingForm').attr('action', '{{ url("/dashboard/settings") }}/' + id);
        });
    });
</script>
@endsection


