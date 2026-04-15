@extends('Layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Admin Dashboard</h1>
    <a href="/reports" class="btn btn-primary">Manage Reports</a>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>Total Users</h5>
                <h2>{{ \App\Models\User::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Admin Users</h5>
                <h2>{{ \App\Models\User::where('role', 'admin')->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5>User Reports</h5>
                <h2>0</h2> {{-- To be implemented --}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5>Total Categories</h5>
                <h2>{{ \App\Models\Categories::count() }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection

