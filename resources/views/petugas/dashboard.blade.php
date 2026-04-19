@extends('Layouts.petugas')

@section('content')
<div class="row g-4 mb-5">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6">
        <div class="stats-card text-center">
            <div class="stats-icon bg-warning text-dark">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h3 class="mt-3 mb-1">{{ $stats['total'] ?? 0 }}</h3>
            <p class="text-muted mb-0">Total Laporan</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card text-center">
            <div class="stats-icon bg-info">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="mt-3 mb-1">{{ $stats['pending'] ?? 0 }}</h3>
            <p class="text-muted mb-0">Menunggu</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card text-center">
            <div class="stats-icon bg-warning">
                <i class="fas fa-cogs"></i>
            </div>
            <h3 class="mt-3 mb-1">{{ $stats['processing'] ?? 0 }}</h3>
            <p class="text-muted mb-0">Diproses</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card text-center">
            <div class="stats-icon bg-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="mt-3 mb-1">{{ \App\Models\Reports::where('status', 'selesai')->count() }}</h3>
            <p class="text-muted mb-0">Selesai</p>
        </div>
    </div>
</div>

<!-- Recent Reports -->
<div class="row">
    <div class="col-12">
        <div class="reports-table">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No Tiket</th>
                            <th>Pelapor</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignedReports ?? [] as $report)
                            <tr>
                                <td><strong>{{ $report->ticket_number }}</strong></td>
                                <td>{{ $report->user->name ?? '-' }}</td>
                                <td>{{ Str::limit($report->title, 40) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($report->status == 'menunggu') bg-secondary
                                        @elseif($report->status == 'diproses') bg-warning
                                        @elseif($report->status == 'selesai') bg-success
                                        @else bg-info @endif">
                                        {{ ucwords(str_replace('_', ' ', $report->status)) }}
                                    </span>
                                </td>
                                <td>{{ $report->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada laporan ditugaskan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
