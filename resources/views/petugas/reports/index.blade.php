@extends('Layouts.petugas')
@section('title', 'Kelola Laporan - Petugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Laporan</h3>
    <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Dashboard
    </a>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h6>Total {{ $reports->total() }} Laporan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No Tiket</th>
                        <th>Pelapor</th>
                        <th>Instansi</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td><strong>{{ $report->ticket_number }}</strong></td>
                            <td>
                                {{ $report->user->name ?? '-' }}<br>
                                <small>{{ $report->user->no_hp ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $report->agency->name ?? '-' }}</span>
                            </td>
                            <td>
                                {{ $report->title }}<br>
                                <small class="text-muted">{{ Str::limit($report->description, 60) }}</small>
                            </td>
                            <td>
                                <span class="badge @if($report->status == 'menunggu') bg-secondary @elseif($report->status == 'di-tinjau') bg-info @elseif($report->status == 'di-kerjakan') bg-warning @elseif($report->status == 'selesai') bg-success @endif">
                                    {{ ucwords(str_replace('-', ' ', $report->status)) }}
                                </span>
                            </td>
                            <td>
                                {{ $report->created_at->format('d/m/Y H:i') }}<br>
                                <small>{{ $report->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <form action="{{ route('petugas.reports.updateStatus', $report) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm me-1" onchange="this.form.submit()">
                                        <option value="menunggu" {{ $report->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="di-tinjau" {{ $report->status == 'di-tinjau' ? 'selected' : '' }}>Di Tinjau</option>
                                        <option value="di-kerjakan" {{ $report->status == 'di-kerjakan' ? 'selected' : '' }}>Di Kerjakan</option>
                                        <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                                @if($report->photo)
                                    <a href="{{ asset('storage/' . $report->photo) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat Foto">
                                        <i class="fas fa-image"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada laporan untuk diproses</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $reports->appends(request()->query())->links() }}
    </div>
</div>
@endsection
