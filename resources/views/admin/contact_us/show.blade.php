@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>Contact Us Details</h4>
            </div>

            @if (!$contactUs)
                <div class="alert alert-danger">No contact data found.</div>
            @else
                <div class="card-body">
                    <h5><strong>Name:</strong> {{ $contactUs->name }}</h5>
                    <p><strong>Email:</strong> {{ $contactUs->email }}</p>
                    <p><strong>Phone:</strong> {{ $contactUs->phone }}</p>
                    <p><strong>Country:</strong> {{ $contactUs->country }}</p>
                    <p><strong>Query:</strong><br> {{ $contactUs->query }}</p>
                </div>
            @endif

            <div class="card-footer">
                <a href="{{ route('admin.contact_us.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
