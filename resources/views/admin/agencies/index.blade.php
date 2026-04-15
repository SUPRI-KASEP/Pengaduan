@extends('Layouts.admin')
@section('title', 'Kelola Instansi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Kelola Instansi</h1>
    <a href="{{ route('admin.agencies.create') }}" class="btn btn-primary">Tambah Instansi</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agencies as $agency)
                        <tr>
                            <td>{{ $agency->id }}</td>
                            <td>{{ $agency->name }}</td>
                            <td>{{ $agency->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.agencies.edit', $agency) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.agencies.destroy', $agency) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada instansi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $agencies->links() }}
        </div>
    </div>
</div>
@endsection

