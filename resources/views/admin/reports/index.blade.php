@extends('Layouts.admin')
@section('title', 'Kelola Laporan')

@section('content')
<div class="container mt-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Kelola Laporan Pengaduan</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Total: {{ $reports->total() }} Laporan</span>
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="8%">No Tiket</th>
                            <th width="15%">Pelapor</th>
                            <th width="12%">Kategori</th>
                            <th width="12%">Instansi</th>
                            <th>Judul</th>
                            <th width="15%">Status</th>
                            <th width="12%">Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td><strong>{{ $report->ticket_number }}</strong></td>
                                <td>
                                    {{ $report->user->name ?? '-' }}<br>
                                    <small class="text-muted">{{ $report->user->no_hp ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $report->category->name ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $report->agency->name ?? '-' }}</span>
                                </td>
                                <td>
                                    {{ $report->title }}<br>
                                    <small class="text-muted">{{ Str::limit($report->description, 80) }}</small>
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($report->status == 'menunggu') bg-secondary
                                        @elseif($report->status == 'terverifikasi') bg-info
                                        @elseif($report->status == 'diproses') bg-warning
                                        @elseif($report->status == 'selesai') bg-success
                                        @else bg-danger
                                        @endif">
                                        {{ ucwords(str_replace('_', ' ', $report->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $report->created_at->format('d/m/Y') }}</strong><br>
                                    <small>{{ $report->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if($report->photo)
                                            <a href="{{ asset('storage/' . $report->photo) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat Foto">
                                                <i class="fas fa-image"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.reports.show', $report) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" class="d-inline" style="display: inline-block;" onsubmit="return confirm('Hapus laporan {{ $report->title }}? No. {{ $report->ticket_number }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Belum ada laporan pengaduan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-3">
            {{ $reports->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
