@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp
@section('title', 'User Dashboard')

@section('content')

{{-- Lightbox Overlay --}}
<div id="lightbox" onclick="closeLightbox()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center; cursor:zoom-out;">
    <button onclick="closeLightbox()" style="position:absolute; top:20px; right:28px; background:none; border:none; color:#fff; font-size:2rem; cursor:pointer; line-height:1;">&times;</button>
    <img id="lightbox-img" src="" alt="" style="max-width:90vw; max-height:88vh; border-radius:10px; object-fit:contain; box-shadow:0 8px 40px rgba(0,0,0,0.5);">
</div>

<div class="container-xl py-4 px-3 px-md-4">

    {{-- Header Aksi --}}
    <div class="d-flex gap-3 mb-5 flex-wrap">
        <a href="{{ route('report.index') }}" class="btn-dash btn-dash-outline">
            <i class="fas fa-list"></i> Semua Postingan
        </a>
        <a href="{{ route('report.create') }}" class="btn-dash btn-dash-primary">
            <i class="fas fa-camera"></i> Posting Laporan Baru
        </a>
    </div>

    {{-- Postingan Saya --}}
    <section class="mb-5">
        <div class="section-header mb-3">
            <div class="section-icon-wrap bg-primary-soft">
                <i class="fas fa-user-circle text-primary"></i>
            </div>
            <div>
                <h5 class="section-title">Postingan Saya</h5>
                <p class="section-sub">Laporan yang Anda kirimkan</p>
            </div>
        </div>

        @if($myReports->count() > 0)
            <div class="report-grid">
                @foreach($myReports as $report)
                <div class="rcard">
                    <div class="rcard-badge">
                        <span class="status-badge status-{{ $report->status }}">{{ ucfirst($report->status) }}</span>
                    </div>
                    <div class="rcard-img-wrap" onclick="openLightbox('{{ asset('storage/' . $report->photo) }}', '{{ addslashes($report->title) }}')">
                        @if($report->photo)
                            <img src="{{ asset('storage/' . $report->photo) }}" class="rcard-img" alt="{{ $report->title }}">
                            <div class="rcard-zoom-hint"><i class="fas fa-search-plus"></i></div>
                        @else
                            <div class="rcard-no-img"><i class="fas fa-camera fa-2x"></i></div>
                        @endif
                    </div>
                    <div class="rcard-body">
                        <h6 class="rcard-title">{{ $report->title }}</h6>
                        <p class="rcard-desc">{{ $report->description }}</p>
                        <div class="rcard-meta">
                            <span><i class="fas fa-tag"></i> {{ $report->category->name ?? 'Umum' }}</span>
                            <span><i class="fas fa-clock"></i> {{ $report->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="rcard-footer">
                        <form action="{{ route('report.destroy', $report) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus postingan ini?')">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-images fa-3x"></i>
                <p class="mt-3 mb-1 fw-semibold">Belum ada postingan</p>
                <small>Jadilah yang pertama melaporkan!</small>
                <a href="{{ route('report.create') }}" class="btn-dash btn-dash-primary mt-3 d-inline-flex">
                    <i class="fas fa-plus-circle"></i> Buat Laporan
                </a>
            </div>
        @endif
    </section>

    {{-- Aktivitas Publik - Facebook Feed Style --}}
    <section class="mb-5">
        <div class="section-header mb-3">
            <div class="section-icon-wrap bg-info-soft">
                <i class="fas fa-users text-info"></i>
            </div>
            <div>
                <h5 class="section-title">Aktivitas Masyarakat</h5>
                <p class="section-sub">Laporan dari warga sekitar</p>
            </div>
        </div>

        <div class="fb-feed-wrap">
            <div class="fb-feed">
                @forelse($publicReports as $report)
                <div class="fb-post">

                    <div class="fb-post-header">
                        <div class="fb-avatar">
                            {{ strtoupper(substr($report->user->name ?? 'W', 0, 2)) }}
                        </div>
                        <div class="fb-post-meta">
                            <span class="fb-username">{{ $report->user->name ?? 'Warga' }}</span>
                            <div class="fb-submeta">
                                <span><i class="fas fa-tag" style="font-size:10px;"></i> {{ $report->category->name ?? 'Umum' }}</span>
                                <span class="fb-dot">·</span>
                                <span>{{ $report->created_at->diffForHumans() }}</span>
                                <span class="fb-dot">·</span>
                                <i class="fas fa-globe-asia" style="font-size:10px;" title="Publik"></i>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <span class="status-badge status-{{ $report->status }}">{{ ucfirst($report->status) }}</span>
                        </div>
                    </div>

                    <div class="fb-post-text">
                        <p class="fb-post-title">{{ $report->title }}</p>
                        <p class="fb-post-desc">{{ $report->description }}</p>
                    </div>

                    @if($report->photo)
                    <div class="fb-post-img-wrap" onclick="openLightbox('{{ asset('storage/' . $report->photo) }}', '{{ addslashes($report->title) }}')">
                        <img src="{{ asset('storage/' . $report->photo) }}" alt="{{ $report->title }}" class="fb-post-img">
                        <div class="fb-img-zoom"><i class="fas fa-search-plus"></i></div>
                    </div>
                    @endif

                    <div class="fb-post-footer">
                        <button class="fb-react-btn" onclick="toggleLike(this)">
                            <i class="far fa-thumbs-up"></i>
                            <span>Dukung</span>
                        </button>
                        <button class="fb-react-btn">
                            <i class="far fa-comment"></i>
                            <span>Komentar</span>
                        </button>
                        <button class="fb-react-btn">
                            <i class="far fa-share-square"></i>
                            <span>Bagikan</span>
                        </button>
                    </div>

                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-users fa-3x"></i>
                    <p class="mt-3 mb-1 fw-semibold">Belum ada aktivitas</p>
                    <small>Jadilah yang pertama posting!</small>
                </div>
                @endforelse

                @if($publicReports->count() > 0)
                <div class="text-center pt-2 pb-1">
                    <a href="{{ route('report.index') }}" class="btn-dash btn-dash-outline">
                        <i class="fas fa-th-large"></i> Lihat Lebih Banyak
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Info Akun --}}
    <div class="account-card mb-4">
        <div class="account-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
        <div class="account-info">
            <div class="account-field">
                <span class="acf-label">Nama</span>
                <span class="acf-val fw-semibold">{{ auth()->user()->name }}</span>
            </div>
            <div class="account-field">
                <span class="acf-label">No. HP</span>
                <span class="acf-val">{{ auth()->user()->no_hp }}</span>
            </div>
            <div class="account-field">
                <span class="acf-label">Email</span>
                <span class="acf-val">{{ auth()->user()->email }}</span>
            </div>
            <div class="account-field">
                <span class="acf-label">Role</span>
                <span class="role-badge">{{ ucfirst(auth()->user()->role ?? 'user') }}</span>
            </div>
        </div>
    </div>

</div>

<style>
/* ─── Layout ─── */
.container-xl { max-width: 1200px; margin: auto; }

/* ─── Tombol Aksi Utama ─── */
.btn-dash { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all .18s; border: 1.5px solid transparent; cursor: pointer; }
.btn-dash-primary { background: #2563eb; color: #fff; border-color: #2563eb; }
.btn-dash-primary:hover { background: #1d4ed8; color: #fff; }
.btn-dash-outline { background: transparent; color: #2563eb; border-color: #2563eb; }
.btn-dash-outline:hover { background: #eff6ff; }

/* ─── Section Header ─── */
.section-header { display: flex; align-items: center; gap: 12px; }
.section-icon-wrap { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.bg-primary-soft { background: #eff6ff; }
.bg-info-soft { background: #f0fdfa; }
.section-title { font-size: 16px; font-weight: 600; margin: 0; color: #111827; }
.section-sub { font-size: 12px; color: #6b7280; margin: 0; }

/* ─── Report Card Grid ─── */
.report-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(270px, 1fr)); gap: 20px; }

.rcard { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; overflow: hidden; display: flex; flex-direction: column; position: relative; transition: box-shadow .2s, transform .2s; }
.rcard:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.09); transform: translateY(-2px); }

.rcard-badge { position: absolute; top: 12px; right: 12px; z-index: 2; }

.rcard-img-wrap { width: 100%; aspect-ratio: 4/3; overflow: hidden; background: #f3f4f6; cursor: zoom-in; display: flex; align-items: center; justify-content: center; position: relative; }
.rcard-img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .3s ease; }
.rcard-img-wrap:hover .rcard-img { transform: scale(1.04); }
.rcard-zoom-hint { position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.5); color: #fff; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; opacity: 0; transition: opacity .2s; pointer-events: none; }
.rcard-img-wrap:hover .rcard-zoom-hint { opacity: 1; }
.rcard-no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9ca3af; }

.rcard-body { padding: 14px 16px 8px; flex: 1; }
.rcard-title { font-size: 14px; font-weight: 600; color: #111827; margin: 0 0 6px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.rcard-desc { font-size: 13px; color: #6b7280; line-height: 1.55; margin: 0 0 10px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.rcard-meta { display: flex; gap: 12px; font-size: 11px; color: #9ca3af; }
.rcard-meta i { margin-right: 3px; }

.rcard-footer { padding: 10px 16px 14px; border-top: 1px solid #f3f4f6; }
.btn-action { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 500; border: none; cursor: pointer; transition: background .15s; }
.btn-delete { background: #fef2f2; color: #b91c1c; }
.btn-delete:hover { background: #fee2e2; }

/* ─── Status Badge ─── */
.status-badge { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; white-space: nowrap; letter-spacing: .3px; }
.status-menunggu { background: #f1f5f9; color: #475569; }
.status-diproses { background: #fef9c3; color: #92400e; }
.status-selesai { background: #dcfce7; color: #166534; }
.status-ditolak { background: #fee2e2; color: #b91c1c; }

/* ─── Facebook Feed ─── */
.fb-feed-wrap { display: flex; justify-content: center; }

.fb-feed { display: flex; flex-direction: column; gap: 12px; width: 100%; max-width: 600px; }

.fb-post { background: #fff; border-radius: 12px; border: 1px solid #e4e6ea; overflow: hidden; transition: box-shadow .2s; }
.fb-post:hover { box-shadow: 0 4px 14px rgba(0,0,0,0.07); }

.fb-post-header { display: flex; align-items: center; gap: 10px; padding: 12px 14px 0; }

.fb-avatar { width: 38px; height: 38px; min-width: 38px; border-radius: 50%; background: #1877f2; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; }

.fb-post-meta { display: flex; flex-direction: column; gap: 1px; }
.fb-username { font-size: 13px; font-weight: 600; color: #050505; line-height: 1.3; }
.fb-submeta { font-size: 11px; color: #65676b; display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
.fb-dot { font-size: 8px; }

.fb-post-text { padding: 8px 14px 0; }
.fb-post-title { font-size: 14px; font-weight: 600; color: #050505; margin: 0 0 4px; }
.fb-post-desc { font-size: 13px; color: #3c4043; line-height: 1.5; margin: 0; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }

.fb-post-img-wrap { margin-top: 10px; width: 100%; overflow: hidden; background: #f0f2f5; cursor: zoom-in; position: relative; max-height: 380px; }
.fb-post-img { width: 100%; max-height: 380px; object-fit: cover; display: block; transition: transform .3s ease; }
.fb-post-img-wrap:hover .fb-post-img { transform: scale(1.02); }
.fb-img-zoom { position: absolute; bottom: 8px; right: 10px; background: rgba(0,0,0,0.42); color: #fff; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; opacity: 0; transition: opacity .2s; pointer-events: none; }
.fb-post-img-wrap:hover .fb-img-zoom { opacity: 1; }

.fb-post-footer { display: flex; border-top: 1px solid #e4e6ea; margin-top: 8px; }
.fb-react-btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 5px; padding: 7px 4px; background: none; border: none; color: #65676b; font-size: 12px; font-weight: 600; cursor: pointer; transition: background .15s; }
.fb-react-btn:hover { background: #f0f2f5; color: #1877f2; }
.fb-react-btn.liked { color: #1877f2; }
.fb-react-btn.liked i { color: #1877f2; }

/* ─── Empty State ─── */
.empty-state { text-align: center; padding: 48px 20px; color: #9ca3af; display: flex; flex-direction: column; align-items: center; background: #fff; border-radius: 16px; border: 1px dashed #e5e7eb; }

/* ─── Account Card ─── */
.account-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 20px 24px; display: flex; gap: 20px; align-items: flex-start; flex-wrap: wrap; }
.account-avatar { width: 52px; height: 52px; min-width: 52px; border-radius: 50%; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; }
.account-info { display: flex; flex-wrap: wrap; gap: 20px; flex: 1; }
.account-field { display: flex; flex-direction: column; min-width: 130px; }
.acf-label { font-size: 11px; color: #9ca3af; margin-bottom: 2px; text-transform: uppercase; letter-spacing: .5px; }
.acf-val { font-size: 14px; color: #111827; }
.role-badge { display: inline-block; background: #eff6ff; color: #1d4ed8; padding: 3px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; width: fit-content; }

/* ─── Lightbox ─── */
#lightbox.active { display: flex !important; }

@media (max-width: 640px) {
    .fb-feed { max-width: 100%; }
    .account-info { gap: 14px; }
}
</style>

<script>
function openLightbox(src, title) {
    if (!src || src.includes('undefined')) return;
    const lb = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    img.src = src;
    img.alt = title || '';
    lb.classList.add('active');
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.remove('active');
    lb.style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

function toggleLike(btn) {
    btn.classList.toggle('liked');
    const icon = btn.querySelector('i');
    const label = btn.querySelector('span');
    if (btn.classList.contains('liked')) {
        icon.className = 'fas fa-thumbs-up';
        label.textContent = 'Didukung';
    } else {
        icon.className = 'far fa-thumbs-up';
        label.textContent = 'Dukung';
    }
}
</script>

@endsection