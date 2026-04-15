@extends('Layouts.admin')
@section('title', 'Tambah Instansi')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.agencies.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-header">
        <h3>Tambah Instansi Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.agencies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Instansi</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

