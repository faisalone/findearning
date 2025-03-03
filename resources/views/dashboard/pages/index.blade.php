@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Pages</h1>
        <a href="{{ route('pages.create') }}" class="btn btn-primary">Create New Page</a>
    </div>
    <div class="table-responsive"> <!-- Added for responsive table -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
						<td><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></td>
						<td>
							@if ($page->position == 1)
								Information Page
							@elseif ($page->position == 2)
								My Account
							@else
								{{ $page->position }}
							@endif
						</td>
						<td>
							@if($page->status)
								<span class="text-success font-weight-bold">Active</span>
							@else
								<span class="text-danger font-weight-bold">Inactive</span>
							@endif
						</td>
                        <td>
                            <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pages.destroy', $page) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No pages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{-- Pagination controls --}}
        {{ $pages->links() ?? '' }}
    </div>
</div>
@endsection
