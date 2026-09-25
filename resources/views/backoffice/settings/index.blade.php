@extends('backoffice.layouts.app')

@section('title', 'Pengaturan Website')
@section('breadcrumb', 'Pengaturan Website')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Pengaturan Website &amp; Profil</h1>
        <p class="page-subtitle">Kelola konfigurasi kontak, dokumen resmi (Compro &amp; Proyek Panel), visi-misi, dan SEO.</p>
    </div>

    <div>
        <button type="submit" form="settings-form" class="btn btn-primary" style="padding: 11px 24px; font-size: 14px; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);">
            💾 Simpan Semua Perubahan
        </button>
    </div>
</div>

<form id="settings-form" action="{{ route('backoffice.settings.update') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 24px; max-width: 1040px;">
    @csrf
    @method('PUT')

    <!-- Card 1: Identitas & Kontak Perusahaan -->
    <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>🏢</span> Identitas &amp; Kontak Perusahaan
            </h2>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Nama Perusahaan / Website *</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? 'PT. Anugerah Tama Sejati') }}" required class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Slogan / Tagline Perusahaan</label>
                    <input type="text" name="company_tagline" value="{{ old('company_tagline', $settings['company_tagline'] ?? 'Best Electrical Supplier & Panel Maker') }}" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Nomor Telepon Kantor</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '(031) 59178887') }}" class="form-control" style="font-family: monospace;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">WhatsApp Konsultasi Cepat</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '082223332830') }}" class="form-control" style="font-family: monospace;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Email Resmi Perusahaan</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'sales@atstekno.com') }}" class="form-control">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Alamat Kantor / Showroom Fisik</label>
                <textarea name="address" rows="2" class="form-control">{{ old('address', $settings['address'] ?? 'Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, East Java, Indonesia') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Kota &amp; Wilayah</label>
                    <input type="text" name="city" value="{{ old('city', $settings['city'] ?? 'Surabaya, Jawa Timur') }}" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $settings['postal_code'] ?? '60134') }}" class="form-control" style="font-family: monospace;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Link Google Maps Embed / Lokasi</label>
                <input type="text" name="google_maps_embed" value="{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}" placeholder="https://maps.google.com/?q=..." class="form-control" style="font-family: monospace; font-size: 12.5px;">
            </div>
        </div>
    </div>

    <!-- Card 2: Company Profile (Compro) Resmi ATS -->
    <div class="panel-card" style="border-left: 4px solid #059669;">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>📕</span> ATS Official Company Profile (Compro)
            </h2>
            <span class="badge badge-success">Showcase About Us</span>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 18px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Judul Company Profile</label>
                    <input type="text" name="company_profile_title" value="{{ old('company_profile_title', $settings['company_profile_title'] ?? 'Official Corporate Profile PT. Anugerah Tama Sejati') }}" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Versi / Edisi Publikasi</label>
                    <input type="text" name="company_profile_version" value="{{ old('company_profile_version', $settings['company_profile_version'] ?? 'Edisi 2026') }}" class="form-control">
                </div>
            </div>

            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 1: Link Google Drive Dokumen Compro</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Tinjau / Unduh via Cloud)</span>
                    </label>
                    <input type="url" name="company_profile_drive_url" value="{{ old('company_profile_drive_url', $settings['company_profile_drive_url'] ?? '') }}" placeholder="https://drive.google.com/file/d/.../view" class="form-control" style="font-family: monospace; font-size: 13px;">
                    @if(!empty($settings['company_profile_drive_url']))
                        <div style="font-size: 12px; color: #059669; margin-top: 4px; font-weight: 500;">
                            ✓ Google Drive terhubung: <a href="{{ $settings['company_profile_drive_url'] }}" target="_blank" style="color: inherit; text-decoration: underline;">Uji Link Google Drive &rarr;</a>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 2: Upload Manual File PDF Compro</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Maksimal 100 MB)</span>
                    </label>
                    <input type="file" name="company_profile_file" id="company_profile_file" accept=".pdf" class="form-control">
                    <input type="hidden" name="company_profile_auto_thumb" id="company_profile_auto_thumb">

                    <!-- Realtime Auto-extracted Thumbnail from Page 1 -->
                    <div id="compro_auto_thumb_loading" style="display: none; margin-top: 10px; font-size: 12.5px; color: #059669; align-items: center; gap: 8px;">
                        <span style="display: inline-block; width: 14px; height: 14px; border: 2px solid #059669; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite;"></span>
                        <span>Mengekstrak Halaman 1 PDF untuk cover otomatis...</span>
                    </div>
                    <div id="compro_auto_thumb_container" style="display: none; margin-top: 10px; padding: 12px 14px; background: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 8px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <img id="compro_auto_thumb_img" src="" alt="Auto Thumbnail Compro" style="width: 48px; height: 64px; object-fit: cover; border-radius: 6px; border: 1px solid #10B981; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.2);">
                            <div>
                                <div style="font-weight: 700; color: #065F46; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                    <span>✨</span> Cover Halaman 1 PDF Berhasil Dibuat Otomatis!
                                </div>
                                <div style="font-size: 12px; color: #047857; margin-top: 2px;">
                                    Thumbnail ini akan otomatis disimpan jika Anda tidak mengunggah cover foto manual di bawah.
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($settings['company_profile_pdf']))
                        <div style="margin-top: 8px; padding: 8px 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; font-size: 12px;">
                            <span style="color: #334155; font-weight: 500;">
                                📄 File Aktif: <strong>{{ basename($settings['company_profile_pdf']) }}</strong>
                                @if(!empty($settings['company_profile_size']))
                                    ({{ $settings['company_profile_size'] }})
                                @endif
                            </span>
                            <a href="{{ $settings['company_profile_pdf'] }}" target="_blank" style="color: #059669; font-weight: 700; text-decoration: underline;">Download / Buka PDF &rarr;</a>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Thumbnail / Cover Mockup PDF Compro (Opsional)</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Foto Cover Manual Rasio 3:4)</span>
                    </label>
                    <input type="file" name="company_profile_thumb_file" accept="image/*" class="form-control">
                    <span class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 4px; display: block;">💡 Kosongkan jika ingin cover otomatis dibuat dari Halaman 1 file PDF yang diunggah.</span>
                    @if(!empty($settings['company_profile_thumbnail']))
                        <div style="margin-top: 8px; display: flex; align-items: center; gap: 12px; padding: 8px 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px;">
                            <img src="{{ $settings['company_profile_thumbnail'] }}" alt="Thumbnail Compro" style="width: 44px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #CBD5E1;">
                            <div style="font-size: 12px; color: #334155;">
                                <div style="font-weight: 700;">Cover Booklet 3D Terpasang</div>
                                <a href="{{ $settings['company_profile_thumbnail'] }}" target="_blank" style="color: #059669; text-decoration: underline;">Pratinjau Cover Penuh &rarr;</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Ringkasan / Uraian Singkat Company Profile</label>
                <textarea name="company_profile_description" rows="2" class="form-control">{{ old('company_profile_description', $settings['company_profile_description'] ?? 'Dokumen profil resmi mencakup legalitas lengkap, otorisasi distributor resmi global (Schneider Electric, Vinsa, GAE, Legrand), rekam jejak suplai proyek industri, dan kesiapan persediaan gudang Surabaya.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Card 3: Dokumen Portofolio ATS Panel Project -->
    <div class="panel-card" style="border-left: 4px solid #EA580C;">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>⚡</span> Dokumen ATS Panel Project (Katalog Fabrikasi &amp; Engineering)
            </h2>
            <span class="badge badge-warning">Showcase About Us</span>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 18px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Judul Dokumen Proyek Panel</label>
                    <input type="text" name="panel_project_doc_title" value="{{ old('panel_project_doc_title', $settings['panel_project_doc_title'] ?? 'ATS Panel Maker & Engineering Project Reference') }}" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Versi / Edisi Publikasi</label>
                    <input type="text" name="panel_project_doc_version" value="{{ old('panel_project_doc_version', $settings['panel_project_doc_version'] ?? 'Edisi 2026') }}" class="form-control">
                </div>
            </div>

            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 1: Link Google Drive Dokumen Panel Project</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Tinjau / Unduh via Cloud)</span>
                    </label>
                    <input type="url" name="panel_project_doc_drive_url" value="{{ old('panel_project_doc_drive_url', $settings['panel_project_doc_drive_url'] ?? '') }}" placeholder="https://drive.google.com/file/d/.../view" class="form-control" style="font-family: monospace; font-size: 13px;">
                    @if(!empty($settings['panel_project_doc_drive_url']))
                        <div style="font-size: 12px; color: #EA580C; margin-top: 4px; font-weight: 500;">
                            ✓ Google Drive terhubung: <a href="{{ $settings['panel_project_doc_drive_url'] }}" target="_blank" style="color: inherit; text-decoration: underline;">Uji Link Google Drive &rarr;</a>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 2: Upload Manual File PDF Dokumen Panel</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Maksimal 100 MB)</span>
                    </label>
                    <input type="file" name="panel_project_doc_file" id="panel_project_doc_file" accept=".pdf" class="form-control">
                    <input type="hidden" name="panel_project_doc_auto_thumb" id="panel_project_doc_auto_thumb">

                    <!-- Realtime Auto-extracted Thumbnail from Page 1 -->
                    <div id="panel_auto_thumb_loading" style="display: none; margin-top: 10px; font-size: 12.5px; color: #EA580C; align-items: center; gap: 8px;">
                        <span style="display: inline-block; width: 14px; height: 14px; border: 2px solid #EA580C; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite;"></span>
                        <span>Mengekstrak Halaman 1 PDF untuk cover otomatis...</span>
                    </div>
                    <div id="panel_auto_thumb_container" style="display: none; margin-top: 10px; padding: 12px 14px; background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 8px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <img id="panel_auto_thumb_img" src="" alt="Auto Thumbnail Panel Project" style="width: 48px; height: 64px; object-fit: cover; border-radius: 6px; border: 1px solid #F97316; box-shadow: 0 2px 6px rgba(249, 115, 22, 0.2);">
                            <div>
                                <div style="font-weight: 700; color: #9A3412; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                    <span>✨</span> Cover Halaman 1 PDF Berhasil Dibuat Otomatis!
                                </div>
                                <div style="font-size: 12px; color: #C2410C; margin-top: 2px;">
                                    Thumbnail ini akan otomatis disimpan jika Anda tidak mengunggah cover foto manual di bawah.
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($settings['panel_project_doc_pdf']))
                        <div style="margin-top: 8px; padding: 8px 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; font-size: 12px;">
                            <span style="color: #334155; font-weight: 500;">
                                📄 File Aktif: <strong>{{ basename($settings['panel_project_doc_pdf']) }}</strong>
                                @if(!empty($settings['panel_project_doc_size']))
                                    ({{ $settings['panel_project_doc_size'] }})
                                @endif
                            </span>
                            <a href="{{ $settings['panel_project_doc_pdf'] }}" target="_blank" style="color: #EA580C; font-weight: 700; text-decoration: underline;">Download / Buka PDF &rarr;</a>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Thumbnail / Cover Mockup PDF Panel Project (Opsional)</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Foto Cover Manual Rasio 3:4)</span>
                    </label>
                    <input type="file" name="panel_project_doc_thumb_file" accept="image/*" class="form-control">
                    <span class="form-hint" style="font-size: 11.5px; color: #64748B; margin-top: 4px; display: block;">💡 Kosongkan jika ingin cover otomatis dibuat dari Halaman 1 file PDF yang diunggah.</span>
                    @if(!empty($settings['panel_project_doc_thumbnail']))
                        <div style="margin-top: 8px; display: flex; align-items: center; gap: 12px; padding: 8px 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px;">
                            <img src="{{ $settings['panel_project_doc_thumbnail'] }}" alt="Thumbnail Panel Project" style="width: 44px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #CBD5E1;">
                            <div style="font-size: 12px; color: #334155;">
                                <div style="font-weight: 700;">Cover Portfolio 3D Terpasang</div>
                                <a href="{{ $settings['panel_project_doc_thumbnail'] }}" target="_blank" style="color: #EA580C; text-decoration: underline;">Pratinjau Cover Penuh &rarr;</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Ringkasan / Uraian Portofolio Proyek Panel</label>
                <textarea name="panel_project_doc_description" rows="2" class="form-control">{{ old('panel_project_doc_description', $settings['panel_project_doc_description'] ?? 'Dokumen portofolio fabrikasi Low Voltage Main Distribution Panel (LVMDP), Motor Control Center (MCC), Capacitor Bank, Synchronizing Panel, serta instalasi proteksi elektrikal industri terkemuka.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Card 4: Visi & Misi dan Narasi Perusahaan (About Us) -->
    <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>🎯</span> Visi, Misi &amp; Kisah Perusahaan (About Us)
            </h2>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 16px;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">VISI Perusahaan (Bahasa Inggris Utama)</label>
                <textarea name="company_vision" rows="2" class="form-control">{{ old('company_vision', $settings['company_vision'] ?? 'PT. Anugerah Tama Sejati is a creative, innovative, trusted and to be a mainstay for our customer. And to become a healthy and growing company for our employees.') }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">MISI Perusahaan (Bahasa Inggris Utama)</label>
                <textarea name="company_mission" rows="2" class="form-control">{{ old('company_mission', $settings['company_mission'] ?? 'PT Anugerah Tama Sejati is committed in providing the best service with professionalism in giving solutions to fulfill our customer’s needs.') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Metrik Pengalaman</label>
                    <input type="text" name="stat_experience_years" value="{{ old('stat_experience_years', $settings['stat_experience_years'] ?? '7+') }}" class="form-control" style="font-weight: 700;">
                    <span class="form-hint">Label: Years of Experience</span>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Metrik Klien &amp; Proyek</label>
                    <input type="text" name="stat_clients_count" value="{{ old('stat_clients_count', $settings['stat_clients_count'] ?? '1,000+') }}" class="form-control" style="font-weight: 700;">
                    <span class="form-hint">Label: Clients &amp; Projects</span>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Metrik Jaminan Keaslian</label>
                    <input type="text" name="stat_guarantee_percent" value="{{ old('stat_guarantee_percent', $settings['stat_guarantee_percent'] ?? '100%') }}" class="form-control" style="font-weight: 700;">
                    <span class="form-hint">Label: Genuine Guarantee</span>
                </div>
            </div>

            <div style="border-top: 1px solid var(--color-border); padding-top: 16px; display: flex; flex-direction: column; gap: 12px;">
                <label class="form-label" style="font-size: 14px; color: #0F172A;">Narasi Profil &amp; Sejarah Perusahaan (4 Paragraf Lengkap)</label>

                <div class="form-group" style="margin-bottom: 0;">
                    <span style="font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px; display: block;">Paragraf 1 (Pendirian &amp; Lokasi):</span>
                    <textarea name="company_story_p1" rows="2" class="form-control">{{ old('company_story_p1', $settings['company_story_p1'] ?? 'PT. Anugerah Tama Sejati or shortened as PT ATS was formed in 1st august 2019, located in Surabaya, East Java, Indonesia. Our Company engaged in electrical equipment for industries.') }}</textarea>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <span style="font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px; display: block;">Paragraf 2 (Layanan &amp; Solusi Pelanggan):</span>
                    <textarea name="company_story_p2" rows="2" class="form-control">{{ old('company_story_p2', $settings['company_story_p2'] ?? 'Besides selling electrical equipment for industry, PT Anugerah Tama Sejati provide solutions and give the best service for all of our customers.') }}</textarea>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <span style="font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px; display: block;">Paragraf 3 (Kemitraan Prinsipal &amp; Lisensi Resmi):</span>
                    <textarea name="company_story_p3" rows="3" class="form-control">{{ old('company_story_p3', $settings['company_story_p3'] ?? 'Over the years, we have established ourselves as a trusted supply chain partner for leading manufacturing plants, EPC contractors, certified panel builders, and infrastructure developers across Indonesia. As an authorized distributor for leading global brands including Schneider Electric, Vinsa, Legrand, and GAE, we deliver genuine low-voltage electrical distribution components such as MCBs, MCCBs, Contactors, Overloads, VSD / Inverters, Push Buttons, Digital Metering, and more, backed by official factory warranties and Certificates of Origin (COO).') }}</textarea>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <span style="font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px; display: block;">Paragraf 4 (Dukungan Rekayasa &amp; Kesiapan Gudang Surabaya):</span>
                    <textarea name="company_story_p4" rows="3" class="form-control">{{ old('company_story_p4', $settings['company_story_p4'] ?? 'We understand that operational uptime and personnel safety require absolute precision. Beyond component distribution, our certified sales engineers provide dedicated technical consultation, Bill of Quantities (BoQ) optimization, and protection coordination support. Supported by extensive ready-stock warehousing in Surabaya and reliable nationwide freight logistics, PT ATS is committed to preventing project downtime, safeguarding critical assets, and driving sustainable industrial growth for all stakeholders.') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 5: Master Price List & Katalog PDF -->
    <div class="panel-card" style="border-left: 4px solid var(--color-primary);">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>📊</span> Master Price List &amp; Brand Catalogs
            </h2>
            <span class="badge badge-info">Halaman Price List</span>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Judul Master Price List</label>
                    <input type="text" name="master_price_list_title" value="{{ old('master_price_list_title', $settings['master_price_list_title'] ?? 'Master Price List Resmi PT. Anugerah Tama Sejati') }}" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Versi / Edisi Tanggal</label>
                    <input type="text" name="master_price_list_version" value="{{ old('master_price_list_version', $settings['master_price_list_version'] ?? 'Edisi 2026 - Terkini') }}" class="form-control">
                </div>
            </div>

            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 1: Link Google Drive Master Price List</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Tinjau / Unduh via Cloud)</span>
                    </label>
                    <input type="url" name="master_price_list_drive_url" value="{{ old('master_price_list_drive_url', $settings['master_price_list_drive_url'] ?? '') }}" placeholder="https://drive.google.com/file/d/.../view" class="form-control" style="font-family: monospace; font-size: 13px;">
                    @if(!empty($settings['master_price_list_drive_url']))
                        <div style="font-size: 12px; color: #059669; margin-top: 4px; font-weight: 500;">
                            ✓ Google Drive terhubung: <a href="{{ $settings['master_price_list_drive_url'] }}" target="_blank" style="color: inherit; text-decoration: underline;">Uji Link Google Drive &rarr;</a>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>Opsi 2: Upload Manual File PDF Master Price List</span>
                        <span style="font-size: 11px; color: #64748B; font-weight: normal;">(Maksimal 100 MB)</span>
                    </label>
                    <input type="file" name="master_price_list_file" accept=".pdf" class="form-control">
                    @if(!empty($settings['master_price_list_pdf']))
                        <div style="margin-top: 8px; padding: 8px 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; font-size: 12px;">
                            <span style="color: #334155; font-weight: 500;">
                                📄 File Aktif: <strong>{{ basename($settings['master_price_list_pdf']) }}</strong>
                            </span>
                            <a href="{{ $settings['master_price_list_pdf'] }}" target="_blank" style="color: var(--color-primary); font-weight: 700; text-decoration: underline;">Download / Buka PDF &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Keterangan Singkat / Catatan Price List</label>
                <textarea name="master_price_list_description" rows="2" class="form-control">{{ old('master_price_list_description', $settings['master_price_list_description'] ?? 'Katalog harga dan spesifikasi resmi seluruh lini produk distribusi daya, proteksi industri, otomasi dan kabel.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Card 6: Media Sosial & Pengaturan SEO Default -->
    <div class="panel-card">
        <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-border); background: #FAFBFD;">
            <h2 style="font-size: 15px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                <span>🌐</span> Media Sosial &amp; SEO Default
            </h2>
        </div>
        <div class="panel-body" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Instagram (@ats_tekno)</label>
                    <input type="text" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? 'https://www.instagram.com/ats_tekno/') }}" class="form-control" style="font-family: monospace;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">LinkedIn Profil / Halaman</label>
                    <input type="text" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? 'https://linkedin.com/company/anugerah-tama-sejati') }}" class="form-control" style="font-family: monospace;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Default Meta Title SEO</label>
                <input type="text" name="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? 'PT. Anugerah Tama Sejati - Supplier Elektrikal & Panel Maker') }}" class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Default Meta Description SEO</label>
                <textarea name="default_meta_description" rows="2" class="form-control">{{ old('default_meta_description', $settings['default_meta_description'] ?? 'Distributor resmi komponen elektrikal terkemuka: Schneider Electric, Legrand, GAE Group, Socomec, Autonics.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Bottom Save Action Bar -->
    <div style="display: flex; justify-content: flex-end; padding: 16px 0;">
        <button type="submit" class="btn btn-primary" style="padding: 12px 32px; font-size: 15px; border-radius: 10px; cursor: pointer; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.3);">
            💾 Simpan Semua Perubahan Pengaturan
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script src="{{ asset('js/pdf.min.js') }}"></script>
<script>
    if (typeof pdfjsLib !== 'undefined') {
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('js/pdf.worker.min.js') }}";
    }

    /**
     * Renders Page 1 of a PDF File into a high-quality JPEG Data URL.
     */
    async function extractPdfFirstPage(file) {
        if (!file || typeof pdfjsLib === 'undefined') return null;
        try {
            const arrayBuffer = await file.arrayBuffer();
            const loadingTask = pdfjsLib.getDocument({ data: arrayBuffer });
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(1);
            
            // Scale 1.5 gives great crispness (~900x1200px for A4) while staying compact
            const viewport = page.getViewport({ scale: 1.5 });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            await page.render({ canvasContext: context, viewport: viewport }).promise;
            return canvas.toDataURL('image/jpeg', 0.88);
        } catch (err) {
            console.error('Gagal mengekstrak halaman 1 PDF:', err);
            return null;
        }
    }

    // Company Profile PDF handler
    const comproPdfInput = document.getElementById('company_profile_file');
    const comproAutoThumb = document.getElementById('company_profile_auto_thumb');
    const comproThumbImg = document.getElementById('compro_auto_thumb_img');
    const comproThumbBox = document.getElementById('compro_auto_thumb_container');
    const comproThumbLoading = document.getElementById('compro_auto_thumb_loading');

    if (comproPdfInput) {
        comproPdfInput.addEventListener('change', async function() {
            const file = this.files[0];
            if (!file) {
                if (comproThumbBox) comproThumbBox.style.display = 'none';
                if (comproAutoThumb) comproAutoThumb.value = '';
                return;
            }
            if (comproThumbLoading) comproThumbLoading.style.display = 'flex';
            if (comproThumbBox) comproThumbBox.style.display = 'none';

            const dataUrl = await extractPdfFirstPage(file);
            if (comproThumbLoading) comproThumbLoading.style.display = 'none';

            if (dataUrl) {
                if (comproAutoThumb) comproAutoThumb.value = dataUrl;
                if (comproThumbImg) comproThumbImg.src = dataUrl;
                if (comproThumbBox) comproThumbBox.style.display = 'block';
            }
        });
    }

    // Panel Project Document PDF handler
    const panelPdfInput = document.getElementById('panel_project_doc_file');
    const panelAutoThumb = document.getElementById('panel_project_doc_auto_thumb');
    const panelThumbImg = document.getElementById('panel_auto_thumb_img');
    const panelThumbBox = document.getElementById('panel_auto_thumb_container');
    const panelThumbLoading = document.getElementById('panel_auto_thumb_loading');

    if (panelPdfInput) {
        panelPdfInput.addEventListener('change', async function() {
            const file = this.files[0];
            if (!file) {
                if (panelThumbBox) panelThumbBox.style.display = 'none';
                if (panelAutoThumb) panelAutoThumb.value = '';
                return;
            }
            if (panelThumbLoading) panelThumbLoading.style.display = 'flex';
            if (panelThumbBox) panelThumbBox.style.display = 'none';

            const dataUrl = await extractPdfFirstPage(file);
            if (panelThumbLoading) panelThumbLoading.style.display = 'none';

            if (dataUrl) {
                if (panelAutoThumb) panelAutoThumb.value = dataUrl;
                if (panelThumbImg) panelThumbImg.src = dataUrl;
                if (panelThumbBox) panelThumbBox.style.display = 'block';
            }
        });
    }

    // Form submit loading protection
    const settingsForm = document.getElementById('settings-form');
    if (settingsForm) {
        settingsForm.addEventListener('submit', async function(e) {
            // If user selected a PDF and auto-thumbnail is still being generated or not yet set, try to extract before submitting
            if (comproPdfInput && comproPdfInput.files[0] && !comproAutoThumb.value) {
                const manualThumb = document.querySelector('input[name="company_profile_thumb_file"]');
                if (!manualThumb || !manualThumb.files.length) {
                    const dataUrl = await extractPdfFirstPage(comproPdfInput.files[0]);
                    if (dataUrl) comproAutoThumb.value = dataUrl;
                }
            }
            if (panelPdfInput && panelPdfInput.files[0] && !panelAutoThumb.value) {
                const manualThumb = document.querySelector('input[name="panel_project_doc_thumb_file"]');
                if (!manualThumb || !manualThumb.files.length) {
                    const dataUrl = await extractPdfFirstPage(panelPdfInput.files[0]);
                    if (dataUrl) panelAutoThumb.value = dataUrl;
                }
            }

            const submitBtns = document.querySelectorAll('button[type="submit"][form="settings-form"], #settings-form button[type="submit"]');
            submitBtns.forEach(btn => {
                btn.disabled = true;
                btn.style.opacity = '0.75';
                btn.style.cursor = 'not-allowed';
                btn.innerHTML = '<span style="display:inline-block; animation: spin 0.8s linear infinite; margin-right: 6px;">⏳</span> Sedang Mengunggah &amp; Menyimpan...';
            });
        });
    }
</script>
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush
