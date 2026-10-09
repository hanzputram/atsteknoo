@php
    $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
    
    // Exactly matches Image 2 from About Us
    $comproThumb = !empty($settings['company_profile_thumbnail']) 
        ? $settings['company_profile_thumbnail'] 
        : (file_exists(public_path('uploads/compro/compro-thumb-1789368942.jpg')) 
            ? asset('uploads/compro/compro-thumb-1789368942.jpg') 
            : asset('images/documents/compro-cover.jpg'));

    $comproPdf = !empty($settings['company_profile_pdf']) 
        ? $settings['company_profile_pdf'] 
        : (file_exists(public_path('uploads/compro/company-profile-ats-1789368942.pdf')) 
            ? asset('uploads/compro/company-profile-ats-1789368942.pdf') 
            : asset('documents/ATS_Company_Profile.pdf'));

    $panelThumb = !empty($settings['panel_project_doc_thumbnail']) 
        ? $settings['panel_project_doc_thumbnail'] 
        : (file_exists(public_path('uploads/panel-projects/panel-project-thumb-1789368942.jpg')) 
            ? asset('uploads/panel-projects/panel-project-thumb-1789368942.jpg') 
            : asset('images/documents/panel-project-cover.jpg'));

    $panelPdf = !empty($settings['panel_project_doc_pdf']) 
        ? $settings['panel_project_doc_pdf'] 
        : (file_exists(public_path('uploads/panel-projects/panel-project-ats-1789368942.pdf')) 
            ? asset('uploads/panel-projects/panel-project-ats-1789368942.pdf') 
            : asset('documents/ATS_Panel_Project_Reference.pdf'));
@endphp

<!-- ========================================================
     OFFICIAL PUBLICATIONS & DOWNLOADS (CLEAN INDUSTRIAL MINIMALIST)
     Matched to ATS Tekno Brand Identity & About Us Document Cards
     Strictly Bilingual: English (EN) & Français (FR)
     ======================================================== -->
<section class="ats-documents-section py-16 sm:py-20 bg-white border-y border-slate-200/80" id="panel-documents">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- ================= DOCUMENT 1: OUR COMPANY PROFILE ================= -->
        <div class="mb-14 sm:mb-16" id="company-profile-doc">
            <div class="text-center sm:text-left mb-6">
                <div class="text-xs sm:text-sm font-medium tracking-wide text-slate-500 mb-1">
                    <span class="ats-lang-en">Indonesia</span>
                    <span class="ats-lang-fr">Indonésie</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    <span class="ats-lang-en">OUR COMPANY PROFILE</span>
                    <span class="ats-lang-fr">NOTRE PROFIL D'ENTREPRISE</span>
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 lg:gap-12">
                <!-- Left: Clean Cover Image Mockup -->
                <div class="w-48 sm:w-56 md:w-60 shrink-0">
                    <a href="{{ $comproPdf }}" target="_blank" rel="noopener noreferrer"
                       class="ats-doc-cover-link block rounded-lg overflow-hidden border border-slate-200 shadow-md bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 cursor-pointer"
                       title="View / Download Company Profile PDF">
                        <img src="{{ $comproThumb }}"
                             alt="Official Company Profile Cover - PT. Anugerah Tama Sejati"
                             class="w-full h-auto object-contain block">
                    </a>
                </div>

                <!-- Right: Content & Download Button -->
                <div class="flex-1 space-y-5 text-center sm:text-left">
                    <p class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        PT. Anugerah Tama Sejati is headquartered in Surabaya, East Java, Indonesia. Our company specializes in the procurement of electrical equipment specifically for industrial applications. We also provide the best solutions and services for all our clients across Industry, Building, OEM, ME Contractors, and Panel Makers. Established on August 1, 2019, our core concept is fulfilling all electrical needs across Indonesia.
                    </p>
                    <p class="ats-lang-block-fr text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        PT. Anugerah Tama Sejati a son siège à Surabaya, Java Oriental, Indonésie. Notre entreprise est spécialisée dans la fourniture et l'ingénierie d'équipements électriques pour applications industrielles. Nous offrons les meilleures solutions et services à l'ensemble de nos clients dans l'Industrie, le Bâtiment, les OEM, les contractants ME et les Tableautiers. Fondée le 1er août 2019, notre mission fondamentale est de répondre à l'ensemble des besoins électrotechniques en Indonésie et à l'international.
                    </p>

                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                        <a href="{{ $comproPdf }}"
                           target="_blank"
                           download="ATS_Company_Profile.pdf"
                           class="ats-doc-download-btn inline-flex items-center gap-2 px-6 py-2.5 rounded bg-[#E11D48] hover:bg-[#BE123C] text-white font-medium text-sm shadow-xs transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span class="ats-lang-en">Download</span>
                            <span class="ats-lang-fr">Télécharger</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subtle Horizontal Divider -->
        <div class="border-t border-slate-200/80 my-12 sm:my-16"></div>

        <!-- ================= DOCUMENT 2: ATS PANEL MAKER & PROJECT REFERENCE ================= -->
        <div id="panel-project-doc">
            <div class="text-center sm:text-left mb-6">
                <div class="text-xs sm:text-sm font-medium tracking-wide text-slate-500 mb-1">
                    <span class="ats-lang-en">Engineering</span>
                    <span class="ats-lang-fr">Ingénierie</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    <span class="ats-lang-en">ATS PANEL MAKER &amp; PROJECT REFERENCE</span>
                    <span class="ats-lang-fr">FABRICATION DE TABLEAUX ATS &amp; RÉFÉRENCES PROJETS</span>
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 lg:gap-12">
                <!-- Left: Clean Cover Image Mockup -->
                <div class="w-48 sm:w-56 md:w-60 shrink-0">
                    <a href="{{ $panelPdf }}" target="_blank" rel="noopener noreferrer"
                       class="ats-doc-cover-link block rounded-lg overflow-hidden border border-slate-200 shadow-md bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 cursor-pointer"
                       title="View / Download Panel Project Reference PDF">
                        <img src="{{ $panelThumb }}"
                             alt="ATS Panel Maker &amp; Engineering Project Reference Booklet"
                             class="w-full h-auto object-contain block">
                    </a>
                </div>

                <!-- Right: Content & Download Button -->
                <div class="flex-1 space-y-5 text-center sm:text-left">
                    <p class="ats-lang-block-en text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        The ATS Panel Maker division manufactures and custom-assembles high-quality low-voltage switchboards (LVMDP, MCC, Capacitor Banks, Synchronizing Panels, and ATS-AMF) compliant with IEC 61439 and SNI standards. We provide comprehensive engineering documentation, detailed wiring schematics, and factory acceptance test (FAT) reports to guarantee operational reliability, safety, and energy efficiency for your facility.
                    </p>
                    <p class="ats-lang-block-fr text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        La division ATS Panel Maker conçoit et assemble sur mesure des tableaux électriques basse et moyenne tension de haute performance (TGBT, MCC, Batteries de Condensateurs, Tableaux de Synchronisation, Inverseurs ATS-AMF) conformes aux normes internationales CEI 61439. Nous fournissons des dossiers d'ingénierie complets, schémas de câblage unifilaires détaillés et rapports d'essais en usine (FAT) pour garantir sécurité, fiabilité et continuité de service pour votre installation.
                    </p>

                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                        <a href="{{ $panelPdf }}"
                           target="_blank"
                           download="ATS_Panel_Project_Reference.pdf"
                           class="ats-doc-download-btn inline-flex items-center gap-2 px-6 py-2.5 rounded bg-[#E11D48] hover:bg-[#BE123C] text-white font-medium text-sm shadow-xs transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span class="ats-lang-en">Download</span>
                            <span class="ats-lang-fr">Télécharger</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
  /* Scoped Fallback Styles for ATS Documents Section */
  .ats-documents-section {
    font-family: var(--font-sans, 'Plus Jakarta Sans', sans-serif);
    scroll-margin-top: 90px;
  }
  #company-profile-doc,
  #panel-project-doc {
    scroll-margin-top: 90px;
  }
  .ats-documents-section h2 {
    font-family: var(--font-outfit, 'Outfit', sans-serif);
  }
  .ats-doc-cover-link {
    text-decoration: none;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .ats-doc-cover-link:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.16);
  }
  .ats-doc-download-btn {
    text-decoration: none !important;
    background-color: #E11D48 !important;
    color: #FFFFFF !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    padding: 10px 24px !important;
    border-radius: 6px !important;
    transition: background-color 0.2s ease, box-shadow 0.2s ease !important;
  }
  .ats-doc-download-btn:hover {
    background-color: #BE123C !important;
    box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35) !important;
  }
</style>
