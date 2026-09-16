@extends('backoffice.layouts.app')

@section('title', 'Pengetahuan & Memori AI')
@section('breadcrumb', 'Pengetahuan & Memori AI')

@section('content')
<div class="page-header">
  <div>
    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
      <h1 class="page-title">Pengetahuan &amp; Memori AI (ATS Support)</h1>
      <span class="badge badge-primary" style="font-size: 11px; padding: 4px 10px;">
        {{ $activeCount }} Memori Aktif
      </span>
    </div>
    <p class="page-subtitle">Ajari dan kelola basis pengetahuan ATS Support. Semua informasi produk, aturan diskon, atau FAQ di sini akan langsung diingat dan diterapkan oleh AI saat menjawab pertanyaan live chat.</p>
  </div>

  <div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <a href="{{ route('backoffice.ai-knowledge.test') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 6px;">
      <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <span>Uji Coba Respon AI</span>
    </a>
    <a href="{{ route('backoffice.ai-knowledge.create') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 6px;">
      <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M12 4v16m8-8H4"/></svg>
      <span>+ Tambah Pengetahuan Baru</span>
    </a>
  </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4" style="margin-bottom: 24px;">
  <div class="panel-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 14px;">
    <div style="width: 44px; height: 44px; border-radius: 12px; background: #EEF2FF; color: #4F46E5; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
      🧠
    </div>
    <div>
      <div style="font-size: 11.5px; color: #64748B; font-weight: 700; text-transform: uppercase;">Total Memori</div>
      <div style="font-size: 22px; font-weight: 800; color: #0F172A; line-height: 1.2;">{{ $totalCount }}</div>
    </div>
  </div>

  <div class="panel-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 14px;">
    <div style="width: 44px; height: 44px; border-radius: 12px; background: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
      ⚡
    </div>
    <div>
      <div style="font-size: 11.5px; color: #64748B; font-weight: 700; text-transform: uppercase;">Produk &amp; Merek</div>
      <div style="font-size: 22px; font-weight: 800; color: #059669; line-height: 1.2;">{{ $productCount }}</div>
    </div>
  </div>

  <div class="panel-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 14px;">
    <div style="width: 44px; height: 44px; border-radius: 12px; background: #FFFBEB; color: #D97706; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
      🏷️
    </div>
    <div>
      <div style="font-size: 11.5px; color: #64748B; font-weight: 700; text-transform: uppercase;">Harga &amp; Diskon</div>
      <div style="font-size: 22px; font-weight: 800; color: #D97706; line-height: 1.2;">{{ $pricingCount }}</div>
    </div>
  </div>

  <div class="panel-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 14px;">
    <div style="width: 44px; height: 44px; border-radius: 12px; background: #F0F9FF; color: #0284C7; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
      ❓
    </div>
    <div>
      <div style="font-size: 11.5px; color: #64748B; font-weight: 700; text-transform: uppercase;">Tanya Jawab (FAQ)</div>
      <div style="font-size: 22px; font-weight: 800; color: #0284C7; line-height: 1.2;">{{ $faqCount }}</div>
    </div>
  </div>
</div>

<!-- Filters & Search Bar -->
<div class="panel-card" style="padding: 16px 20px; margin-bottom: 20px;">
  <form action="{{ route('backoffice.ai-knowledge.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center; justify-content: space-between;">
    <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1; min-width: 280px;">
      <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Cari kata kunci, judul, atau isi instruksi memori..."
        class="form-control"
        style="max-width: 380px;"
      >
      <select name="category" class="form-control" style="width: auto; min-width: 170px;" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        @foreach($categories as $catKey => $catLabel)
          <option value="{{ $catKey }}" {{ request('category') === $catKey ? 'selected' : '' }}>
            {{ $catLabel }}
          </option>
        @endforeach
      </select>
      <select name="status" class="form-control" style="width: auto; min-width: 140px;" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Hanya Aktif</option>
        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Hanya Nonaktif</option>
      </select>
      <button type="submit" class="btn btn-secondary btn-sm" style="padding: 0 14px;">
        Filter
      </button>
      @if(request()->hasAny(['q', 'category', 'status']))
        <a href="{{ route('backoffice.ai-knowledge.index') }}" class="btn btn-secondary btn-sm" style="color: #EF4444;">
          Reset Filter
        </a>
      @endif
    </div>
  </form>
</div>

<!-- Knowledge Table -->
<div class="panel-card">
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 60px; text-align: center;">Prioritas</th>
          <th>Topik Pengetahuan</th>
          <th style="width: 150px;">Kategori</th>
          <th>Materi Pengetahuan / Instruksi AI</th>
          <th style="width: 110px; text-align: center;">Status</th>
          <th style="width: 150px; text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($knowledges as $item)
          <tr style="{{ !$item->is_active ? 'opacity: 0.65; background-color: #F8FAFC;' : '' }}">
            <td style="text-align: center; font-weight: 700; color: #64748B; font-family: monospace;">
              {{ $item->priority }}
            </td>
            <td>
              <div style="font-weight: 700; color: #0F172A; font-size: 14px;">
                {{ $item->title }}
              </div>
              @if($item->trigger_keywords)
                <div style="margin-top: 4px; display: flex; align-items: center; gap: 4px; flex-wrap: wrap;">
                  <span style="font-size: 10px; color: #94A3B8; font-weight: 700;">KEYWORDS:</span>
                  @foreach(explode(',', $item->trigger_keywords) as $kw)
                    @if(trim($kw))
                      <span style="font-size: 10.5px; background: #F1F5F9; color: #475569; padding: 1px 6px; border-radius: 4px; font-family: monospace;">{{ trim($kw) }}</span>
                    @endif
                  @endforeach
                </div>
              @endif
              <div style="font-size: 11px; color: #94A3B8; margin-top: 4px;">
                Diperbarui {{ $item->updated_at->timezone('Asia/Jakarta')->diffForHumans() }}
              </div>
            </td>
            <td>
              <span class="badge {{ $item->category_badge_class }}">
                {{ $item->category_label }}
              </span>
            </td>
            <td>
              <div style="max-width: 480px; font-size: 12.5px; color: #334155; line-height: 1.5; white-space: pre-line; word-break: break-word;">
                {{ Str::limit($item->content, 180) }}
              </div>
            </td>
            <td style="text-align: center;">
              <form action="{{ route('backoffice.ai-knowledge.toggle-active', $item->id) }}" method="POST" style="margin: 0; display: inline-block;">
                @csrf
                <button
                  type="submit"
                  class="badge {{ $item->is_active ? 'badge-success' : 'badge-neutral' }}"
                  style="cursor: pointer; border: none; font-weight: 700; padding: 4px 10px;"
                  title="Klik untuk mengubah status aktif/nonaktif"
                >
                  {{ $item->is_active ? '✓ Aktif' : '✗ Nonaktif' }}
                </button>
              </form>
            </td>
            <td style="text-align: right;">
              <div style="display: inline-flex; align-items: center; gap: 6px;">
                <a href="{{ route('backoffice.ai-knowledge.edit', $item->id) }}" class="btn btn-secondary btn-sm" title="Edit Pengetahuan">
                  Edit
                </a>
                <form action="{{ route('backoffice.ai-knowledge.destroy', $item->id) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus memori &quot;{{ $item->title }}&quot;?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-secondary btn-sm" style="color: #EF4444;" title="Hapus Pengetahuan">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 48px; color: #94A3B8;">
              <div style="font-size: 32px; margin-bottom: 8px;">🧠</div>
              <div style="font-weight: 600; font-size: 14px; color: #475569;">Belum ada memori pengetahuan yang tersimpan.</div>
              <p style="font-size: 12.5px; margin-top: 4px;">Klik tombol <strong>+ Tambah Pengetahuan Baru</strong> di atas untuk mulai mengajari ATS Support.</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($knowledges->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
      {{ $knowledges->links() }}
    </div>
  @endif
</div>
@endsection
