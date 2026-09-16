@extends('backoffice.layouts.app')

@section('title', 'Uji Coba Respon & Simulator Memori AI')
@section('breadcrumb', 'Simulator Respon AI')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Uji Coba &amp; Simulator Memori AI</h1>
    <p class="page-subtitle">Uji respon ATS Support secara langsung berdasarkan seluruh memori dan pengetahuan yang aktif di database.</p>
  </div>
  <div>
    <a href="{{ route('backoffice.ai-knowledge.index') }}" class="btn btn-secondary">
      &larr; Kembali ke Daftar Pengetahuan
    </a>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Interactive Simulator Column -->
  <div class="md:grid-cols-2" style="grid-column: span 2;">
    <div class="panel-card" style="padding: 24px;">
      <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
        <span>💬 Simulator Percakapan Cepat</span>
        <span class="badge badge-success" style="font-size: 11px;">{{ $activeCount }} Memori Terpasang</span>
      </h3>
      <p style="font-size: 13px; color: #64748B; margin-bottom: 18px;">
        Ketik pertanyaan uji coba seolah Anda adalah pengunjung website untuk memeriksa apakah AI sudah memahami materi yang baru saja Anda ajarkan.
      </p>

      <form id="simulatorForm" onsubmit="submitSimulatorTest(event)">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" style="margin-bottom: 14px;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="simVisitorName">Simulasi Nama Pengunjung</label>
            <input
              type="text"
              id="simVisitorName"
              value="Pak Hendra / PT Maju Perkasa"
              class="form-control"
              placeholder="Contoh: Pak Hendra"
            >
          </div>
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Contoh Cepat Pertanyaan</label>
            <select class="form-control" onchange="if(this.value){ document.getElementById('simQuestion').value = this.value; }">
              <option value="">-- Pilih Contoh Pertanyaan --</option>
              <option value="Halo apakah ATS authorized distributor Schneider dan ready stock kontaktor TeSys D?">Tanya Authorized Schneider &amp; TeSys D</option>
              <option value="Berapa diskon harga untuk pembelian 50 unit MCCB Schneider NSX?">Tanya Diskon / Nego Harga (Uji SOP BoQ)</option>
              <option value="Apakah bisa rakit panel LVMDP dan ATS-AMF genset lengkap sertifikasi FAT?">Tanya Pembuatan Panel Listrik</option>
              <option value="Di mana alamat kantor dan gudang resmi ATS di Surabaya?">Tanya Alamat &amp; Gudang</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="simQuestion">Pertanyaan Uji Coba <span style="color:#EF4444;">*</span></label>
          <textarea
            id="simQuestion"
            rows="3"
            class="form-control"
            placeholder="Ketik pertanyaan untuk menguji AI di sini..."
            required
            style="font-family: inherit; font-size: 13.5px;"
          >Halo, apakah ATS resmi menjual kontaktor Schneider TeSys dan apakah ada diskon untuk proyek?</textarea>
        </div>

        <button type="submit" id="btnRunTest" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          <span id="btnRunTestText">Uji Respon Gemini Sekarang</span>
        </button>
      </form>

      <!-- Simulation Result Box -->
      <div id="simResultWrap" style="display: none; margin-top: 24px; border-top: 1px solid var(--color-border); padding-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
          <h4 style="font-size: 13px; font-weight: 700; color: #0F172A; text-transform: uppercase; letter-spacing: 0.05em;">
            Respon ATS Support:
          </h4>
          <span id="simTakeoverBadge" class="badge badge-warning" style="display: none;">
            ⚠️ Memicu Eskalasi Admin ([NEEDS_ADMIN])
          </span>
        </div>

        <!-- Chat Bubble Preview -->
        <div style="background: #F8FAFC; border: 1.5px solid #CBD5E1; border-radius: 14px; padding: 18px; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; border-bottom: 1px solid #E2E8F0; padding-bottom: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #FC0001; color: #FFFFFF; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center;">
              ATS
            </div>
            <div>
              <div style="font-weight: 700; font-size: 13px; color: #0F172A;">ATS Support</div>
              <div style="font-size: 11px; color: #64748B;">PT Anugerah Tama Sejati • Live Output Simulator</div>
            </div>
          </div>

          <div id="simOutputContent" style="font-size: 13.5px; line-height: 1.6; color: #1E293B; white-space: pre-line; word-break: break-word;">
            <!-- Rendered response -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Compiled System Instruction Preview Column -->
  <div>
    <div class="panel-card" style="padding: 20px; background: #FFFFFF;">
      <h3 style="font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
        🧠 Basis Memori Terkompilasi
      </h3>
      <p style="font-size: 12px; color: #64748B; margin-bottom: 12px; line-height: 1.5;">
        Berikut adalah seluruh instruksi dan pengetahuan gabungan dari database yang dibaca oleh AI:
      </p>

      <textarea
        readonly
        rows="20"
        class="form-control"
        style="background: #0F172A; color: #38BDF8; font-family: monospace; font-size: 11px; line-height: 1.5; resize: vertical;"
      >{{ $compiledInstruction }}</textarea>
      
      <div style="margin-top: 10px; font-size: 11px; color: #94A3B8; text-align: right;">
        Diperbarui otomatis secara real-time dari database.
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
async function submitSimulatorTest(e) {
  e.preventDefault();

  const question = document.getElementById('simQuestion').value.trim();
  const visitorName = document.getElementById('simVisitorName').value.trim();
  const btn = document.getElementById('btnRunTest');
  const btnText = document.getElementById('btnRunTestText');
  const resultWrap = document.getElementById('simResultWrap');
  const outputContent = document.getElementById('simOutputContent');
  const takeoverBadge = document.getElementById('simTakeoverBadge');

  if (!question) return;

  btn.disabled = true;
  btnText.textContent = 'Gemini sedang berpikir...';
  resultWrap.style.display = 'none';

  try {
    const res = await fetch("{{ route('backoffice.ai-knowledge.test-ask') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        question: question,
        visitor_name: visitorName
      })
    });

    const data = await res.json();
    btn.disabled = false;
    btnText.textContent = 'Uji Respon Gemini Sekarang';

    if (data.success) {
      resultWrap.style.display = 'block';
      outputContent.innerHTML = formatSimulatorText(data.cleaned_reply || data.raw_reply);

      if (data.needs_human_takeover) {
        takeoverBadge.style.display = 'inline-block';
      } else {
        takeoverBadge.style.display = 'none';
      }

      resultWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
      alert(data.error || 'Gagal memperoleh jawaban dari Gemini.');
    }
  } catch(err) {
    btn.disabled = false;
    btnText.textContent = 'Uji Respon Gemini Sekarang';
    alert('Terjadi kesalahan jaringan.');
  }
}

function escapeHtml(text) {
  if (!text) return '';
  return text
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

function formatSimulatorText(text) {
  if (!text) return '';
  let formatted = escapeHtml(text.trim());

  // 1. Bullets -> •
  formatted = formatted.replace(/(^|[\r\n]+|&lt;br\s*\/?&gt;|<br\s*\/?>)[ \t]*[\*\-][ \t]+/gi, '$1• ');

  // 2. Triple asterisks
  formatted = formatted.replace(/\*\*\*(.+?)\*\*\*/gs, '<strong><em>$1</em></strong>');

  // 3. Double asterisks bold
  formatted = formatted.replace(/\*\*\s*([^\*]+?)\s*\*\*/gs, '<strong>$1</strong>');

  // 4. Single asterisk bold
  formatted = formatted.replace(/(^|[^\*])\*\s*([^\s\*](?:.*?[^\s\*])?)\s*\*(?!\*)/gs, '$1<strong>$2</strong>');

  // 5. Convert Markdown links: [label](url) -> <a href="cleanUrl">label</a>
  formatted = formatted.replace(/\[([^\]]+)\]\((https?:\/\/[^\s\)\<\>]+)\)/g, function(match, label, url) {
    let cleanUrl = url.trim();
    return `<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: #2563EB; text-decoration: underline; font-weight: 700;">${label}</a>`;
  });

  // 6. Linkify remaining bare URLs (without swallowing trailing punctuation like . , ! ? ) ] )
  const bareUrlRegex = /(^|[^"'>])(https?:\/\/[^\s<"'>]+)/g;
  formatted = formatted.replace(bareUrlRegex, function(match, prefix, rawUrl) {
    let cleanUrl = rawUrl;
    let trailingPunct = '';
    const punctMatch = cleanUrl.match(/[.,;:!?\)\]]+$/);
    if (punctMatch) {
      trailingPunct = punctMatch[0];
      cleanUrl = cleanUrl.slice(0, -trailingPunct.length);
    }
    return `${prefix}<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: #2563EB; text-decoration: underline; font-weight: 700;">${cleanUrl}</a>${trailingPunct}`;
  });

  return formatted;
}
</script>
@endpush
