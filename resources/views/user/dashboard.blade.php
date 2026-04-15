@extends('Layouts.app')
@section('title', 'User Dashboard')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>

<div class="row mt-4">
    <div class="col-md-6">
        <a href="" class="btn btn-lg btn-outline-primary w-100 mb-3">My Reports</a>
    </div>
    <div class="col-md-6">
        <a href="{{ Route('report.create') }}" class="btn btn-lg btn-primary w-100 mb-3">Create New Report</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5>Your Info</h5>
        <p><strong>No. HP:</strong> {{ auth()->user()->no_hp }}</p>
        <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role ?? 'user') }}</p>
    </div>
</div>
@endsection

