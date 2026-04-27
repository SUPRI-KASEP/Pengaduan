@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp
@section('title', 'Dashboard — Lapor Warga')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;1,9..144,400&display=swap');

*, *::before, *::after { box-sizing: border-box; }

:root {
  --navy:     #0f172a;
  --blue:     #1d4ed8;
  --blue-lt:  #3b82f6;
  --teal:     #0d9488;
  --teal-lt:  #14b8a6;
  --slate:    #475569;
  --muted:    #94a3b8;
  --line:     #e2e8f0;
  --bg:       #f1f5f9;
  --white:    #ffffff;
  --radius:   14px;
  --shadow:   0 2px 12px rgba(15,23,42,.07);
  --shadow-md: 0 6px 24px rgba(15,23,42,.10);
  --shadow-lg: 0 12px 40px rgba(15,23,42,.14);
}

body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--navy); }

/* ── Page Shell ── */
.dash-wrap { max-width: 1160px; margin: auto; padding: 36px 24px 64px; }

/* ── Page Header ── */
.page-topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 32px;
}

.page-greeting {
  font-family: 'Fraunces', serif;
  font-size: 1.65rem;
  font-weight: 700;
  color: var(--navy);
  line-height: 1.2;
}
.page-greeting span { color: var(--blue); }
.page-sub { font-size: 13.5px; color: var(--muted); margin-top: 3px; }

.topbar-actions { display: flex; gap: 10px; flex-wrap: wrap; }

/* ── Buttons ── */
.btn-d {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 10px 20px;
  border-radius: 10px;
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none;
  transition: all .17s;
  cursor: pointer;
  border: none;
  white-space: nowrap;
}
.btn-d-primary { background: var(--blue); color: #fff; box-shadow: 0 4px 14px rgba(29,78,216,.25); }
.btn-d-primary:hover { background: #1e40af; color:#fff; box-shadow: 0 6px 20px rgba(29,78,216,.35); transform: translateY(-1px); }
.btn-d-outline { background: var(--white); color: var(--navy); border: 1.5px solid var(--line); box-shadow: var(--shadow); }
.btn-d-outline:hover { border-color: #93c5fd; color: var(--blue); transform: translateY(-1px); }

/* ── Section Header ── */
.sec-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
}

.sec-icon {
  width: 40px; height: 40px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}
.sec-icon.blue { background: #eff6ff; color: var(--blue); }
.sec-icon.teal { background: #f0fdfa; color: var(--teal); }

.sec-title { font-size: 15.5px; font-weight: 700; color: var(--navy); margin: 0; line-height: 1.3; }
.sec-sub { font-size: 12px; color: var(--muted); margin: 0; }

/* ── Report Grid ── */
.report-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 18px;
}

/* ── Card ── */
.rcard {
  background: var(--white);
  border-radius: 18px;
  border: 1px solid var(--line);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  position: relative;
  transition: box-shadow .2s, transform .2s, border-color .2s;
  box-shadow: var(--shadow);
}
.rcard:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); border-color: transparent; }

.rcard-badge { position: absolute; top: 12px; right: 12px; z-index: 2; }

.rcard-img-wrap {
  width: 100%;
  aspect-ratio: 16/10;
  overflow: hidden;
  background: #f1f5f9;
  cursor: zoom-in;
  display: flex; align-items: center; justify-content: center;
  position: relative;
}
.rcard-img { width:100%; height:100%; object-fit:cover; display:block; transition: transform .4s ease; }
.rcard-img-wrap:hover .rcard-img { transform: scale(1.06); }

.rcard-zoom {
  position: absolute; bottom: 10px; right: 10px;
  background: rgba(15,23,42,.55);
  color: #fff;
  width: 32px; height: 32px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 12px;
  opacity: 0;
  transition: opacity .2s;
  pointer-events: none;
  backdrop-filter: blur(4px);
}
.rcard-img-wrap:hover .rcard-zoom { opacity: 1; }

.rcard-no-img {
  width: 100%; height: 100%;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  color: var(--muted);
  gap: 8px;
  font-size: 12px;
}

.rcard-body { padding: 16px 18px 10px; flex: 1; }
.rcard-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--navy);
  margin: 0 0 7px;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.rcard-desc {
  font-size: 13px;
  color: var(--slate);
  line-height: 1.6;
  margin: 0 0 12px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.rcard-meta { display: flex; gap: 14px; font-size: 11.5px; color: var(--muted); }
.rcard-meta i { margin-right: 4px; color: var(--muted); }

.rcard-footer {
  padding: 10px 18px 14px;
  border-top: 1px solid #f1f5f9;
  display: flex;
  gap: 8px;
}

.btn-del {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  background: #fef2f2;
  color: #b91c1c;
  border: 1px solid #fecaca;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: background .15s, border-color .15s;
}
.btn-del:hover { background: #fee2e2; border-color: #fca5a5; }

/* ── Status Badges ── */
.sbadge {
  font-size: 11px;
  font-weight: 600;
  padding: 4px 11px;
  border-radius: 100px;
  letter-spacing: .2px;
  white-space: nowrap;
}
.status-menunggu { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }
.status-diproses  { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
.status-selesai   { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
.status-ditolak   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

/* ── Empty State ── */
.empty-state {
  text-align: center;
  padding: 52px 24px;
  color: var(--muted);
  display: flex;
  flex-direction: column;
  align-items: center;
  background: var(--white);
  border-radius: 18px;
  border: 1.5px dashed var(--line);
}
.empty-state p { margin: 14px 0 4px; font-weight: 600; color: var(--navy); font-size: 15px; }
.empty-state small { font-size: 13px; }

/* ── Feed Section ── */
.feed-outer { display: flex; justify-content: center; }
.feed-col {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 kolom */
  gap: 18px;
  width: 100%;
  max-width: 900px;
}

/* ── Post Card ── */
.post-card {
  background: var(--white);
  border-radius: 16px;
  border: 1px solid var(--line);
  overflow: hidden;
  box-shadow: var(--shadow);
  transition: box-shadow .2s;
}
.post-card:hover { box-shadow: var(--shadow-md); }

.post-head {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 14px 16px 4px;
}

.post-avatar {
  width: 40px; height: 40px; min-width: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--blue), var(--blue-lt));
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 13px;
  flex-shrink: 0;
}

.post-username { font-size: 13.5px; font-weight: 700; color: var(--navy); line-height: 1.3; }
.post-meta-row {
  font-size: 11px;
  color: var(--muted);
  display: flex;
  align-items: center;
  gap: 5px;
  flex-wrap: wrap;
  margin-top: 1px;
}
.meta-sep { font-size: 7px; }

.post-body { padding: 8px 16px 2px; }
.post-title { font-size: 14px; font-weight: 700; color: var(--navy); margin-bottom: 5px; line-height: 1.4; }
.post-desc {
  font-size: 13px;
  color: var(--slate);
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.post-img-wrap {
  margin-top: 12px;
  width: 100%;
  max-height: 360px;
  overflow: hidden;
  background: var(--bg);
  cursor: zoom-in;
  position: relative;
}
.post-img {
  width: 100%;
  max-height: 360px;
  object-fit: cover;
  display: block;
  transition: transform .35s ease;
}
.post-img-wrap:hover .post-img { transform: scale(1.03); }
.post-img-zoom {
  position: absolute; bottom: 10px; right: 12px;
  background: rgba(15,23,42,.5);
  color: #fff;
  width: 30px; height: 30px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px;
  opacity: 0;
  transition: opacity .2s;
  pointer-events: none;
  backdrop-filter: blur(4px);
}
.post-img-wrap:hover .post-img-zoom { opacity: 1; }

/* ── Reaction Bar ── */
.react-bar {
  display: flex;
  border-top: 1px solid #f1f5f9;
  margin-top: 10px;
}
.react-btn {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 9px 6px;
  background: none;
  border: none;
  color: var(--muted);
  font-size: 12.5px;
  font-weight: 600;
  cursor: pointer;
  transition: background .15s, color .15s;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.react-btn:hover { background: #f8fafc; color: var(--blue); }
.react-btn.liked { color: var(--blue); }
.react-btn.liked i { color: var(--blue); }

/* ── Account Card ── */
.account-card {
  background: var(--white);
  border-radius: 18px;
  border: 1px solid var(--line);
  padding: 24px 28px;
  display: flex;
  gap: 22px;
  align-items: flex-start;
  flex-wrap: wrap;
  box-shadow: var(--shadow);
}
.acc-avatar {
  width: 56px; height: 56px; min-width: 56px;
  border-radius: 16px;
  background: linear-gradient(135deg, var(--navy), #1e3a6e);
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 18px;
}
.acc-fields { display: flex; flex-wrap: wrap; gap: 24px; flex: 1; align-items: flex-start; }
.acc-field { display: flex; flex-direction: column; min-width: 130px; }
.acc-label { font-size: 10.5px; color: var(--muted); text-transform: uppercase; letter-spacing: .7px; margin-bottom: 3px; font-weight: 600; }
.acc-val { font-size: 14px; color: var(--navy); font-weight: 500; }
.role-chip {
  display: inline-block;
  background: #eff6ff;
  color: var(--blue);
  padding: 3px 12px;
  border-radius: 100px;
  font-size: 12px;
  font-weight: 600;
  border: 1px solid #bfdbfe;
}

/* ── Divider ── */
.section-divider { height: 1px; background: var(--line); margin: 36px 0; }

/* ── Lightbox ── */
#lb {
  display: none;
  position: fixed; inset: 0;
  background: rgba(0,0,0,.88);
  z-index: 9999;
  align-items: center;
  justify-content: center;
  cursor: zoom-out;
  backdrop-filter: blur(6px);
}
#lb.open { display: flex; }
#lb-img {
  max-width: 90vw;
  max-height: 88vh;
  border-radius: 12px;
  object-fit: contain;
  box-shadow: 0 24px 80px rgba(0,0,0,.5);
}
#lb-close {
  position: absolute; top: 20px; right: 24px;
  background: rgba(255,255,255,.1);
  border: 1px solid rgba(255,255,255,.2);
  color: #fff;
  width: 42px; height: 42px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  cursor: pointer;
  backdrop-filter: blur(6px);
  transition: background .15s;
}
#lb-close:hover { background: rgba(255,255,255,.2); }

@media (max-width: 600px) {
  .acc-fields { gap: 16px; }
  .topbar-actions { width: 100%; }
  .btn-d { flex: 1; justify-content: center; }
  .dash-wrap { padding: 24px 16px 48px; }
}
@media (max-width: 768px) {
  .feed-col {
    grid-template-columns: 1fr; /* jadi 1 kolom di HP */
  }
}
</style>

{{-- Lightbox --}}
<div id="lb" onclick="closeLb()">
  <button id="lb-close" onclick="closeLb()">&times;</button>
  <img id="lb-img" src="" alt="">
</div>

<div class="dash-wrap">

  {{-- ── Top Bar ── --}}
  <div class="page-topbar">
    <div>
      <div class="page-greeting">
        Halo, <span>{{ auth()->user()->name }}</span> 👋
      </div>
      <div class="page-sub">Selamat datang di dashboard pengaduan Anda</div>
    </div>
    <div class="topbar-actions">
      <a href="{{ route('report.index') }}" class="btn-d btn-d-outline">
        <i class="fas fa-list-ul"></i> Semua Laporan
      </a>
      <a href="{{ route('report.create') }}" class="btn-d btn-d-primary">
        <i class="fas fa-plus"></i> Buat Laporan
      </a>
    </div>
  </div>

  {{-- ── Aktivitas Masyarakat ── --}}
  <section style="margin-bottom: 44px;">
    <div class="sec-header">
      <div class="sec-icon teal"><i class="fas fa-users"></i></div>
      <div>
        <p class="sec-title">Aktivitas Masyarakat</p>
        <p class="sec-sub">Laporan terbaru dari warga sekitar</p>
      </div>
    </div>

    <div class="feed-outer">
      <div class="feed-col">
        @forelse($publicReports as $report)
        <div class="post-card">

          <div class="post-head">
            <div class="post-avatar">
              {{ strtoupper(substr($report->user->name ?? 'W', 0, 2)) }}
            </div>
            <div style="flex:1; min-width:0;">
              <div class="post-username">{{ $report->user->name ?? 'Warga' }}</div>
              <div class="post-meta-row">
                <i class="fas fa-tag" style="font-size:9px;"></i>
                {{ $report->category->name ?? 'Umum' }}
                <span class="meta-sep">●</span>
                {{ $report->created_at->diffForHumans() }}
                <span class="meta-sep">●</span>
                <i class="fas fa-globe-asia" style="font-size:9px;" title="Publik"></i>
              </div>
            </div>
            <span class="sbadge status-{{ $report->status }}">{{ ucfirst($report->status) }}</span>
          </div>

          <div class="post-body">
            <p class="post-title">{{ $report->title }}</p>
            <p class="post-desc">{{ $report->description }}</p>
          </div>

          @if($report->photo)
          <div class="post-img-wrap"
               onclick="openLb('{{ asset('storage/' . $report->photo) }}', '{{ addslashes($report->title) }}')">
            <img src="{{ asset('storage/' . $report->photo) }}" alt="{{ $report->title }}" class="post-img">
            <div class="post-img-zoom"><i class="fas fa-search-plus"></i></div>
          </div>
          @endif

          <div class="react-bar">
            <button class="react-btn" onclick="toggleLike(this)">
              <i class="far fa-thumbs-up"></i>
              <span>Dukung</span>
            </button>
            <button class="react-btn">
              <i class="far fa-comment-dots"></i>
              <span>Komentar</span>
            </button>
            <button class="react-btn">
              <i class="far fa-share-square"></i>
              <span>Bagikan</span>
            </button>
          </div>

        </div>
        @empty
        <div class="empty-state">
          <i class="fas fa-users fa-3x" style="color:#cbd5e1;"></i>
          <p>Belum ada aktivitas</p>
          <small>Jadilah yang pertama posting laporan!</small>
        </div>
        @endforelse

        @if($publicReports->count() > 0)
        <div style="text-align:center; padding-top: 8px;">
          <a href="{{ route('report.index') }}" class="btn-d btn-d-outline">
            <i class="fas fa-th-large"></i> Lihat Lebih Banyak
          </a>
        </div>
        @endif
      </div>
    </div>
  </section>

  <div class="section-divider"></div>

  {{-- ── Postingan Saya ── --}}
  <section style="margin-bottom: 44px;">
    <div class="sec-header">
      <div class="sec-icon blue"><i class="fas fa-user-circle"></i></div>
      <div>
        <p class="sec-title">Postingan Saya</p>
        <p class="sec-sub">Laporan yang Anda kirimkan</p>
      </div>
    </div>

    @if($myReports->count() > 0)
      <div class="report-grid">
        @foreach($myReports as $report)
        <div class="rcard">
          <div class="rcard-badge">
            <span class="sbadge status-{{ $report->status }}">{{ ucfirst($report->status) }}</span>
          </div>
          <div class="rcard-img-wrap"
               onclick="openLb('{{ asset('storage/' . $report->photo) }}', '{{ addslashes($report->title) }}')">
            @if($report->photo)
              <img src="{{ asset('storage/' . $report->photo) }}" class="rcard-img" alt="{{ $report->title }}">
              <div class="rcard-zoom"><i class="fas fa-search-plus"></i></div>
            @else
              <div class="rcard-no-img">
                <i class="fas fa-camera fa-2x"></i>
                <span>Tidak ada foto</span>
              </div>
            @endif
          </div>
          <div class="rcard-body">
            <h6 class="rcard-title">{{ $report->title }}</h6>
            <p class="rcard-desc">{{ $report->description }}</p>
            <div class="rcard-meta">
              <span><i class="fas fa-tag"></i>{{ $report->category->name ?? 'Umum' }}</span>
              <span><i class="fas fa-clock"></i>{{ $report->created_at->diffForHumans() }}</span>
            </div>
          </div>
          <div class="rcard-footer">
            <form action="{{ route('report.destroy', $report) }}" method="POST">
              @csrf @method('DELETE')
              <button type="submit" class="btn-del"
                      onclick="return confirm('Hapus laporan ini?')">
                <i class="fas fa-trash-alt"></i> Hapus
              </button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-inbox fa-3x" style="color:#cbd5e1;"></i>
        <p>Belum ada laporan</p>
        <small>Jadilah yang pertama melaporkan masalah!</small>
        <a href="{{ route('report.create') }}" class="btn-d btn-d-primary" style="margin-top:18px;">
          <i class="fas fa-plus"></i> Buat Laporan
        </a>
      </div>
    @endif
  </section>

  <div class="section-divider"></div>

  {{-- ── Info Akun ── --}}
  <section>
    <div class="sec-header">
      <div class="sec-icon blue"><i class="fas fa-id-card"></i></div>
      <div>
        <p class="sec-title">Informasi Akun</p>
        <p class="sec-sub">Data profil Anda</p>
      </div>
    </div>

    <div class="account-card">
      <div class="acc-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
      <div class="acc-fields">
        <div class="acc-field">
          <span class="acc-label">Nama</span>
          <span class="acc-val" style="font-weight:700;">{{ auth()->user()->name }}</span>
        </div>
        <div class="acc-field">
          <span class="acc-label">No. HP</span>
          <span class="acc-val">{{ auth()->user()->no_hp }}</span>
        </div>
        <div class="acc-field">
          <span class="acc-label">Email</span>
          <span class="acc-val">{{ auth()->user()->email }}</span>
        </div>
        <div class="acc-field">
          <span class="acc-label">Role</span>
          <span class="role-chip">{{ ucfirst(auth()->user()->role ?? 'user') }}</span>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
function openLb(src, alt) {
  if (!src || src.includes('undefined')) return;
  document.getElementById('lb-img').src = src;
  document.getElementById('lb-img').alt = alt || '';
  document.getElementById('lb').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeLb() {
  document.getElementById('lb').classList.remove('open');
  document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLb(); });

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