@extends('Layouts.admin')
@section('title', 'Edit Instansi')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.agencies.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-header">
        <h3>Edit Instansi</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.agencies.update', $agency) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Instansi</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $agency->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $agency->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

