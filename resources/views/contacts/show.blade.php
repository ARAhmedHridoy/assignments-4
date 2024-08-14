@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Contact Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $contact->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $contact->phone ?? 'N/A' }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $contact->address ?? 'N/A' }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $contact->created_at->format('d M Y, H:i:s') }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $contact->updated_at->format('d M Y, H:i:s') }}</p>

                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
