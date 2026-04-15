@extends('layouts.app')
@section('title','Report')

@section('content')
<div class="container mt-4">

    {{-- Header + Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Laporan Pengaduan</h3>
        <a href="{{ route('report.create') }}" class="btn btn-primary">
            + Buat Laporan
        </a>
    </div>

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Kategori</th>
                        <th>Instansi</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Foto</th>
                        <th>No Tiket</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->user->name ?? '-' }}</td>
                            <td>{{ $report->category->name ?? '-' }}</td>
                            <td>{{ $report->agency->name ?? '-' }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ Str::limit($report->description, 50) }}</td>
                            <td>{{ $report->location ?? '-' }}</td>
                            
                            <td>
                                @if($report->photo)
                                    <img src="{{ asset('storage/'.$report->photo) }}" width="60">
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $report->ticket_number }}</td>

                            <td>
                                <span class="badge 
                                    @if($report->status == 'menunggu') bg-secondary
                                    @elseif($report->status == 'terverifikasi') bg-info
                                    @elseif($report->status == 'diproses') bg-warning
                                    @elseif($report->status == 'selesai') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ $report->status }}
                                </span>
                            </td>

                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('report.edit', $report) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('report.destroy', $report) }}" method="POST" class="d-inline" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus laporan {{ $report->title }}?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection