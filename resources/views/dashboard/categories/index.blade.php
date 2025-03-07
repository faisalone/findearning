@extends('dashboard.layouts.app')
@section('title', 'All Categories')
@section('content')
<div class="container-fluid px-0 px-md-2">
    <div class="row mx-0">
        <div class="col-12 px-0 px-md-2">
            <x-alert />
            <div class="card rounded-0 rounded-md">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h4 class="mb-0">Categories Management</h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Add New Category</a>
                    <!-- Removed the Save Order button -->
                </div>
                <div class="card-body p-0 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td><img src="{{ $category->imagePath }}" alt="{{ $category->title }}" height="50"></td>
									<td>{{ $category->title }} 
										@if($category->products_count == 0)
											(No Products)
										@elseif($category->products_count == 1)
											(1 Product)
										@else
											({{ $category->products_count }} Products)
										@endif
									</td>
                                    <td>
                                        <div class="d-flex flex-column" style="max-width: 120px;">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100 mb-1" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                            </form>
                                            <form action="{{ route('categories.toggleStatus', $category->id) }}" method="POST" class="mb-1">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-{{ $category->status ? 'primary' : 'secondary' }} btn-sm w-100">
                                                    {{ $category->status ? 'Active' : 'Deactive' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const tableBody = document.querySelector('table tbody');
  let draggedRow = null;

  tableBody.querySelectorAll('tr').forEach(row => {
    row.draggable = true;
    row.addEventListener('dragstart', e => {
      draggedRow = row;
      e.dataTransfer.effectAllowed = 'move';
      row.classList.add('dragging');
    });
    row.addEventListener('dragend', e => {
      row.classList.remove('dragging');
    });
    row.addEventListener('dragover', e => {
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
    });
    row.addEventListener('dragenter', e => {
      e.preventDefault();
      row.classList.add('drop-indicator');
    });
    row.addEventListener('dragleave', e => {
      row.classList.remove('drop-indicator');
    });
    row.addEventListener('drop', e => {
      e.preventDefault();
      if (draggedRow !== row) {
        const targetRect = row.getBoundingClientRect();
        const halfway = targetRect.top + (targetRect.height / 2);
        if (e.clientY < halfway) {
          tableBody.insertBefore(draggedRow, row);
        } else {
          tableBody.insertBefore(draggedRow, row.nextSibling);
        }
        const ids = Array.from(tableBody.querySelectorAll('tr')).map(r => {
          return r.querySelector('form')?.action.split('/').pop();
        });
        fetch("{{ route('categories.reorder') }}", {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',   // ensure JSON response
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ ids })
        })
        .then(res => res.json())
        .then(data => console.log(data.status))
        .catch(err => console.error(err));
      }
    });
  });

  // Removed the Save Order button listener
});
</script>
@endsection