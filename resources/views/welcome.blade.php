@extends('layouts.app')
@section('title','Beranda — Lapor Warga')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;1,9..144,400&display=swap');

/* ── Reset & Base ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --navy:    #0f172a;
  --blue:    #1d4ed8;
  --blue-lt: #3b82f6;
  --teal:    #0d9488;
  --teal-lt: #14b8a6;
  --slate:   #475569;
  --muted:   #94a3b8;
  --line:    #e2e8f0;
  --bg:      #f8fafc;
  --white:   #ffffff;
  --radius:  14px;
  --shadow:  0 4px 24px rgba(15,23,42,.08);
  --shadow-lg: 0 12px 48px rgba(15,23,42,.13);
}

body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--navy); }

/* ── Hero ── */
.hero {
  position: relative;
  padding: 96px 24px 80px;
  text-align: center;
  overflow: hidden;
}

/* layered mesh background */
.hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 70% 60% at 20% 30%, rgba(29,78,216,.10) 0%, transparent 70%),
    radial-gradient(ellipse 60% 50% at 80% 70%, rgba(13,148,136,.09) 0%, transparent 65%),
    radial-gradient(ellipse 40% 40% at 55% 10%, rgba(59,130,246,.06) 0%, transparent 60%);
  z-index: 0;
}

/* subtle dot grid */
.hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(rgba(15,23,42,.06) 1px, transparent 1px);
  background-size: 28px 28px;
  z-index: 0;
}

.hero-inner {
  position: relative;
  z-index: 1;
  max-width: 720px;
  margin: auto;
}

.hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #eff6ff;
  color: var(--blue);
  font-size: 12px;
  font-weight: 600;
  letter-spacing: .6px;
  text-transform: uppercase;
  padding: 6px 16px;
  border-radius: 100px;
  border: 1px solid #bfdbfe;
  margin-bottom: 28px;
}

.hero-pill .dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--blue-lt);
  animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
  0%,100% { opacity:1; transform:scale(1); }
  50%      { opacity:.5; transform:scale(1.3); }
}

.hero h1 {
  font-family: 'Fraunces', Georgia, serif;
  font-size: clamp(2.4rem, 6vw, 3.8rem);
  font-weight: 700;
  line-height: 1.13;
  color: var(--navy);
  margin-bottom: 24px;
}

.hero h1 em {
  font-style: italic;
  color: var(--blue);
}

.hero p {
  font-size: 1.05rem;
  color: var(--slate);
  line-height: 1.75;
  max-width: 520px;
  margin: 0 auto 40px;
}

.hero-cta {
  display: flex;
  justify-content: center;
  gap: 14px;
  flex-wrap: wrap;
}

.btn-primary-hero {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  background: var(--blue);
  color: #fff;
  padding: 14px 30px;
  border-radius: var(--radius);
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: background .18s, box-shadow .18s, transform .15s;
  box-shadow: 0 4px 18px rgba(29,78,216,.28);
}
.btn-primary-hero:hover { background: #1e40af; color:#fff; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(29,78,216,.35); }

.btn-ghost-hero {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  background: var(--white);
  color: var(--navy);
  padding: 14px 30px;
  border-radius: var(--radius);
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  border: 1.5px solid var(--line);
  transition: border-color .18s, box-shadow .18s, transform .15s;
  box-shadow: var(--shadow);
}
.btn-ghost-hero:hover { border-color: #93c5fd; color: var(--blue); transform: translateY(-2px); box-shadow: var(--shadow-lg); }

/* ── Stats Bar ── */
.stats-bar {
  display: flex;
  justify-content: center;
  gap: 0;
  max-width: 680px;
  margin: 64px auto 0;
  background: var(--white);
  border: 1px solid var(--line);
  border-radius: 18px;
  box-shadow: var(--shadow);
  overflow: hidden;
}

.stat-item {
  flex: 1;
  padding: 22px 20px;
  text-align: center;
  border-right: 1px solid var(--line);
}
.stat-item:last-child { border-right: none; }

.stat-num {
  font-family: 'Fraunces', serif;
  font-size: 1.9rem;
  font-weight: 700;
  color: var(--navy);
  line-height: 1;
  margin-bottom: 4px;
}
.stat-label {
  font-size: 11.5px;
  color: var(--muted);
  font-weight: 500;
  letter-spacing: .3px;
}

/* ── Section wrapper ── */
.lp-section { padding: 72px 24px; }
.lp-section-inner { max-width: 1100px; margin: auto; }

.section-eyebrow {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  color: var(--teal);
  margin-bottom: 12px;
}

.section-heading {
  font-family: 'Fraunces', serif;
  font-size: clamp(1.7rem, 3.5vw, 2.5rem);
  font-weight: 700;
  color: var(--navy);
  line-height: 1.2;
  margin-bottom: 16px;
}

.section-body {
  font-size: 1rem;
  color: var(--slate);
  line-height: 1.75;
  max-width: 520px;
}

/* ── Feature Cards ── */
.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
  gap: 20px;
  margin-top: 48px;
}

.feat-card {
  background: var(--white);
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 30px 28px;
  transition: box-shadow .2s, transform .2s, border-color .2s;
  position: relative;
  overflow: hidden;
}
.feat-card::before {
  content: '';
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: opacity .3s;
  border-radius: 18px;
}
.feat-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); border-color: transparent; }

.feat-card.blue-card:hover::before { background: linear-gradient(135deg, rgba(29,78,216,.04), rgba(59,130,246,.03)); opacity:1; }
.feat-card.teal-card:hover::before { background: linear-gradient(135deg, rgba(13,148,136,.04), rgba(20,184,166,.03)); opacity:1; }
.feat-card.indigo-card:hover::before { background: linear-gradient(135deg, rgba(99,102,241,.04), rgba(129,140,248,.03)); opacity:1; }

.feat-icon {
  width: 50px; height: 50px;
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  margin-bottom: 20px;
}
.feat-icon.blue-ic  { background: #eff6ff; color: var(--blue); }
.feat-icon.teal-ic  { background: #f0fdfa; color: var(--teal); }
.feat-icon.indigo-ic{ background: #eef2ff; color: #6366f1; }

.feat-title { font-size: 16px; font-weight: 700; color: var(--navy); margin-bottom: 10px; }
.feat-desc  { font-size: 14px; color: var(--slate); line-height: 1.65; }

/* ── Steps ── */
.steps-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 64px;
  align-items: center;
  margin-top: 0;
}

@media (max-width: 760px) {
  .steps-layout { grid-template-columns: 1fr; gap: 40px; }
}

.steps-list { display: flex; flex-direction: column; gap: 0; }

.step-row {
  display: flex;
  gap: 20px;
  position: relative;
  padding-bottom: 32px;
}
.step-row:last-child { padding-bottom: 0; }

/* vertical connector */
.step-row:not(:last-child) .step-num::after {
  content: '';
  position: absolute;
  left: 50%;
  top: 100%;
  transform: translateX(-50%);
  width: 2px;
  height: calc(100% + 10px);
  background: linear-gradient(to bottom, var(--line), transparent);
}

.step-num {
  position: relative;
  width: 42px; height: 42px; min-width: 42px;
  border-radius: 12px;
  background: var(--navy);
  color: #fff;
  font-family: 'Fraunces', serif;
  font-size: 17px;
  font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  margin-top: 2px;
}

.step-content { padding-top: 4px; }
.step-title { font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 5px; }
.step-desc  { font-size: 13.5px; color: var(--slate); line-height: 1.6; }

.steps-visual {
  position: relative;
  background: linear-gradient(145deg, #1e293b, #0f172a);
  border-radius: 24px;
  overflow: hidden;
  padding: 32px 28px;
  box-shadow: var(--shadow-lg);
}

.steps-visual::before {
  content:'';
  position:absolute; inset:0;
  background: radial-gradient(ellipse 70% 60% at 30% 40%, rgba(29,78,216,.2), transparent 60%),
              radial-gradient(ellipse 50% 50% at 75% 70%, rgba(13,148,136,.15), transparent 55%);
}

.mock-screen {
  position: relative;
  z-index: 1;
}

.mock-bar {
  display: flex; gap: 7px; margin-bottom: 18px;
}
.mock-dot { width:10px; height:10px; border-radius:50%; }
.mock-dot:nth-child(1){ background:#ef4444; }
.mock-dot:nth-child(2){ background:#f59e0b; }
.mock-dot:nth-child(3){ background:#22c55e; }

.mock-card {
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 12px;
}
.mock-card:last-child { margin-bottom: 0; }

.mock-line { height: 8px; border-radius: 4px; background: rgba(255,255,255,.15); margin-bottom: 8px; }
.mock-line.short { width: 60%; }
.mock-line.xshort { width: 40%; }
.mock-badge-row { display:flex; gap:8px; margin-top:10px; }
.mock-badge {
  height: 22px; width: 70px; border-radius: 20px;
  background: rgba(29,78,216,.35);
  border: 1px solid rgba(59,130,246,.3);
}
.mock-badge.green { background: rgba(13,148,136,.35); border-color: rgba(20,184,166,.3); }

/* ── CTA Banner ── */
.cta-banner {
  background: linear-gradient(135deg, var(--navy) 0%, #1e3a6e 100%);
  border-radius: 24px;
  padding: 60px 48px;
  text-align: center;
  position: relative;
  overflow: hidden;
  margin: 0 24px 72px;
}
.cta-banner::before {
  content:'';
  position:absolute; inset:0;
  background: radial-gradient(ellipse 60% 70% at 80% 50%, rgba(29,78,216,.3), transparent),
              radial-gradient(ellipse 40% 50% at 20% 60%, rgba(13,148,136,.2), transparent);
}
.cta-banner > * { position:relative; z-index:1; }
.cta-banner h2 {
  font-family: 'Fraunces', serif;
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  color: #fff;
  font-weight: 700;
  margin-bottom: 14px;
}
.cta-banner p { color: #94a3b8; font-size: 1.02rem; margin-bottom: 36px; }

.btn-cta-white {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  background: #fff;
  color: var(--navy);
  padding: 15px 34px;
  border-radius: var(--radius);
  font-size: 15px;
  font-weight: 700;
  text-decoration: none;
  transition: transform .18s, box-shadow .18s;
  box-shadow: 0 4px 20px rgba(0,0,0,.2);
}
.btn-cta-white:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(0,0,0,.25); color: var(--navy); }

/* ── Responsive ── */
@media (max-width: 640px) {
  .stats-bar { flex-direction: column; }
  .stat-item { border-right: none; border-bottom: 1px solid var(--line); }
  .stat-item:last-child { border-bottom: none; }
  .cta-banner { margin: 0 16px 56px; padding: 44px 24px; }
  .hero { padding: 72px 20px 56px; }
  .lp-section { padding: 56px 20px; }
  .features-grid { grid-template-columns: 1fr; }
}
</style>

{{-- ══ HERO ══ --}}
<section class="hero">
  <div class="hero-inner">

    <div class="hero-pill">
      <span class="dot"></span>
      Platform Pengaduan Resmi Warga
    </div>

    <h1>Suara Anda <em>Nyata,</em><br>Perubahan Pasti Terjadi</h1>

    <p>
      Laporkan masalah lingkungan, infrastruktur, atau pelayanan publik secara langsung.
      Transparan, cepat, dan bisa dipantau kapan saja.
    </p>

    <div class="hero-cta">
      <a href="{{ route('register') }}" class="btn-primary-hero">
        <i class="fas fa-user-plus"></i> Daftar Sekarang
      </a>
      <a href="{{ route('login') }}" class="btn-ghost-hero">
        <i class="fas fa-sign-in-alt"></i> Masuk
      </a>
    </div>

    {{-- Stats --}}
    <div class="stats-bar">
      <div class="stat-item">
        <div class="stat-num">1.2K+</div>
        <div class="stat-label">Laporan Masuk</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">94%</div>
        <div class="stat-label">Ditangani</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">&lt; 48j</div>
        <div class="stat-label">Rata-rata Respons</div>
      </div>
    </div>

  </div>
</section>

{{-- ══ FITUR ══ --}}
<section class="lp-section" style="background: var(--white); border-top: 1px solid var(--line); border-bottom: 1px solid var(--line);">
  <div class="lp-section-inner">
    <div class="section-eyebrow">Mengapa Lapor Warga?</div>
    <h2 class="section-heading">Dirancang untuk kemudahan<br>dan kepercayaan</h2>
    <p class="section-body">Sistem yang kami bangun menempatkan warga sebagai prioritas — prosesnya sederhana, progresnya jelas.</p>

    <div class="features-grid">
      <div class="feat-card blue-card">
        <div class="feat-icon blue-ic"><i class="fas fa-bolt"></i></div>
        <div class="feat-title">Mudah Digunakan</div>
        <div class="feat-desc">Laporkan masalah hanya dalam beberapa langkah tanpa perlu keahlian teknis apapun.</div>
      </div>
      <div class="feat-card teal-card">
        <div class="feat-icon teal-ic"><i class="fas fa-clock"></i></div>
        <div class="feat-title">Respons Cepat</div>
        <div class="feat-desc">Setiap pengaduan langsung masuk ke sistem dan segera diproses oleh petugas terkait.</div>
      </div>
      <div class="feat-card indigo-card">
        <div class="feat-icon indigo-ic"><i class="fas fa-eye"></i></div>
        <div class="feat-title">Transparan & Terbuka</div>
        <div class="feat-desc">Pantau status laporan Anda secara real-time dan lihat aktivitas laporan warga lainnya.</div>
      </div>
    </div>
  </div>
</section>

{{-- ══ CARA KERJA ══ --}}
<section class="lp-section">
  <div class="lp-section-inner">
    <div class="steps-layout">

      <div>
        <div class="section-eyebrow">Cara Kerja</div>
        <h2 class="section-heading" style="margin-bottom:36px;">Empat langkah,<br>masalah tertangani</h2>

        <div class="steps-list">
          <div class="step-row">
            <div class="step-num">1</div>
            <div class="step-content">
              <div class="step-title">Daftar Akun</div>
              <div class="step-desc">Buat akun gratis menggunakan email atau nomor HP Anda.</div>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">2</div>
            <div class="step-content">
              <div class="step-title">Kirim Laporan</div>
              <div class="step-desc">Isi judul, deskripsi, kategori, dan foto pendukung laporan Anda.</div>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">3</div>
            <div class="step-content">
              <div class="step-title">Ditinjau & Diproses</div>
              <div class="step-desc">Tim petugas akan meninjau laporan dan segera mengambil tindakan.</div>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">4</div>
            <div class="step-content">
              <div class="step-title">Masalah Terselesaikan</div>
              <div class="step-desc">Anda mendapat notifikasi ketika laporan sudah ditangani dan selesai.</div>
            </div>
          </div>
        </div>
      </div>

      {{-- Mockup visual --}}
      <div class="steps-visual">
        <div class="mock-screen">
          <div class="mock-bar">
            <div class="mock-dot"></div>
            <div class="mock-dot"></div>
            <div class="mock-dot"></div>
          </div>
          <div class="mock-card">
            <div class="mock-line" style="width:75%;"></div>
            <div class="mock-line short"></div>
            <div class="mock-badge-row">
              <div class="mock-badge"></div>
              <div class="mock-badge" style="width:50px;"></div>
            </div>
          </div>
          <div class="mock-card">
            <div class="mock-line" style="width:85%;"></div>
            <div class="mock-line xshort"></div>
            <div class="mock-badge-row">
              <div class="mock-badge green"></div>
            </div>
          </div>
          <div class="mock-card" style="opacity:.6;">
            <div class="mock-line" style="width:65%;"></div>
            <div class="mock-line" style="width:45%;"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ══ CTA ══ --}}
<div class="cta-banner">
  <h2>Jangan biarkan masalah<br>berlalu tanpa tindakan</h2>
  <p>Bergabung bersama ribuan warga yang telah menyuarakan aspirasinya.</p>
  <a href="{{ route('register') }}" class="btn-cta-white">
    <i class="fas fa-arrow-right"></i> Mulai Sekarang — Gratis
  </a>
</div>

@endsection