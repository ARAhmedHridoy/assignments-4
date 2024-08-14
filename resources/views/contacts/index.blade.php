@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-3">
        <h2>Contact List</h2>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <form method="GET" action="{{ route('contacts.index') }}" class="mb-3">
        <div class="d-flex">
            <div class="form-group col-4">
                <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                    <option value="name_asc" {{ request()->get('sort') == 'name_asc' ? 'selected' : '' }}>Name (Ascending)</option>
                    <option value="name_desc" {{ request()->get('sort') == 'name_desc' ? 'selected' : '' }}>Name (Descending)</option>
                    <option value="created_at_asc" {{ request()->get('sort') == 'created_at_asc' ? 'selected' : '' }}>Created At (Ascending)</option>
                    <option value="created_at_desc" {{ request()->get('sort') == 'created_at_desc' ? 'selected' : '' }}>Created At (Descending)</option>
                </select>
            </div>
            <div class="d-flex col-6" style="margin-left: 15px; margin-right: 25px">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary" style="margin-left: 5px">Search</button>
            </div>
            <a href="{{ route('contacts.index') }}" class="btn btn-danger">Reset</a>
        </div>
    </form>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary" style="float: right">Add New</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone ?? 'N/A' }}</td>
                <td>{{ $contact->address ?? 'N/A' }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->appends(request()->query())->links() }}
</div>
@endsection
