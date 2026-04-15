@extends('layouts.app')
@section('title', 'Edit Laporan')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Laporan Pengaduan</h4>
                    <a href="{{ route('report.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('report.update', $report) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="categories_id" class="form-select @error('categories_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('categories_id', $report->categories_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instansi <span class="text-danger">*</span></label>
                            <select name="agencies_id" class="form-select @error('agencies_id') is-invalid @enderror" required>
                                <option value="">Pilih Instansi</option>
                                @foreach($agencies as $agency)
                                    <option value="{{ $agency->id }}" {{ old('agencies_id', $report->agencies_id) == $agency->id ? 'selected' : '' }}>
                                        {{ $agency->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agencies_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $report->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="5" required>{{ old('description', $report->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                   value="{{ old('location', $report->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            @if($report->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $report->photo) }}" class="img-thumbnail" width="200">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="delete_photo">
                                    <label class="form-check-label" for="delete_photo">
                                        Hapus foto saat ini
                                    </label>
                                </div>
                            @else
                                <p class="text-muted">Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Foto (kosongkan jika tidak ingin ganti)</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Maksimal 2MB (JPG, PNG). Kosongkan untuk mempertahankan foto lama.</div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Tiket</label>
                            <input type="text" class="form-control bg-light" value="{{ $report->ticket_number }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control bg-light" value="{{ ucfirst($report->status) }}" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">
                                <i class="fas fa-save"></i> Update Laporan
                            </button>
                            <a href="{{ route('report.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('delete_photo')?.addEventListener('change', function() {
    if (this.checked) {
        document.querySelector('input[name="photo"]').required = false;
    }
});
</script>
@endsection
