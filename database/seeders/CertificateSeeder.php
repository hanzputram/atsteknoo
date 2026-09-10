<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $certs = [
            [
                'title'        => 'Authorized Distributor Certificate',
                'partner_name' => 'Schneider Electric',
                'badge_text'   => 'VERIFIED PARTNER',
                'description'  => 'Official certification authorizing PT. Anugerah Tama Sejati as an official distributor for Schneider Electric low-voltage distribution, automation, and industrial control components.',
                'image_path'   => 'certificates/cert-schneider.png',
                'sort_order'   => 1,
                'is_active'    => true,
            ],
            [
                'title'        => 'Legrand Certified Partner Certificate',
                'partner_name' => 'Legrand Indonesia',
                'badge_text'   => 'VERIFIED PARTNER',
                'description'  => 'Official authorization recognizing PT. Anugerah Tama Sejati as an authorized distribution partner for Legrand industrial switchgear, modular enclosures, and cable management.',
                'image_path'   => 'certificates/cert-legrand.jpg',
                'sort_order'   => 2,
                'is_active'    => true,
            ],
            [
                'title'        => 'GAE Official Distribution Certificate',
                'partner_name' => 'GAE Group',
                'badge_text'   => 'VERIFIED PARTNER',
                'description'  => 'Certified appointment by GAE Group for electrical metering, industrial protection devices, power capacitors, and switchboard components nationwide.',
                'image_path'   => 'certificates/cert-gae.png',
                'sort_order'   => 3,
                'is_active'    => true,
            ],
        ];

        foreach ($certs as $data) {
            Certificate::updateOrCreate(
                ['partner_name' => $data['partner_name'], 'title' => $data['title']],
                $data
            );
        }

        // Populate default Compro, Panel Project, Visi, Misi, and Story settings
        $defaults = [
            'company_profile_title'       => 'Official Corporate Profile PT. Anugerah Tama Sejati',
            'company_profile_version'     => 'Edisi 2026',
            'company_profile_pdf'         => asset('uploads/compro/ats-company-profile-2026.pdf'),
            'company_profile_size'        => '1.8 MB',
            'company_profile_thumbnail'   => asset('images/documents/compro-cover.jpg'),
            'company_profile_drive_url'   => 'https://drive.google.com/file/d/1ats_corporate_profile_2026_demo/view',
            'company_profile_description' => 'Dokumen profil resmi mencakup legalitas lengkap, otorisasi distributor resmi global (Schneider Electric, Legrand, GAE, Socomec), rekam jejak suplai proyek industri, dan kesiapan persediaan gudang Surabaya.',
            
            // ATS Panel Project Reference Document
            'panel_project_doc_title'       => 'ATS Panel Maker & Engineering Project Reference',
            'panel_project_doc_version'     => 'Edisi 2026',
            'panel_project_doc_pdf'         => asset('documents/ATS_Panel_Project_Reference.pdf'),
            'panel_project_doc_size'        => '2.4 MB',
            'panel_project_doc_thumbnail'   => asset('images/documents/panel-project-cover.jpg'),
            'panel_project_doc_drive_url'   => 'https://drive.google.com/file/d/1ats_panel_project_reference_2026_demo/view',
            'panel_project_doc_description' => 'Dokumen portofolio fabrikasi Low Voltage Main Distribution Panel (LVMDP), Motor Control Center (MCC), Capacitor Bank, Synchronizing Panel, serta instalasi proteksi elektrikal industri terkemuka.',

            'company_vision'              => 'PT. Anugerah Tama Sejati is a creative, innovative, trusted and to be a mainstay for our customer. And to become a healthy and growing company for our employees.',
            'company_mission'             => 'PT Anugerah Tama Sejati is committed in providing the best service with professionalism in giving solutions to fulfill our customer’s needs.',
            'company_story_p1'            => 'PT. Anugerah Tama Sejati or shortened as PT ATS was formed in 1st august 2019, located in Surabaya, East Java, Indonesia. Our Company engaged in electrical equipment for industries.',
            'company_story_p2'            => 'Besides selling electrical equipment for industry, PT Anugerah Tama Sejati provide solutions and give the best service for all of our customers.',
            'company_story_p3'            => 'Over the years, we have established ourselves as a vital supply chain partner for prominent manufacturing plants, EPC contractors, certified panel builders, and infrastructure developers across Indonesia. As an authorized distributor for leading global brands—including Schneider Electric, Legrand, GAE Group, and Socomec—we deliver genuine low-voltage power distribution switchgear, motor controls, VFD inverters, and digital metering systems backed by full manufacturer warranties and verified Certificates of Origin (COO).',
            'company_story_p4'            => 'We understand that operational uptime and personnel safety require absolute precision. Beyond component distribution, our certified sales engineers provide dedicated technical consultation, Bill of Quantities (BoQ) optimization, and protection coordination support. Supported by extensive ready-stock warehousing in Surabaya and reliable nationwide freight logistics, PT ATS is committed to preventing project downtime, safeguarding critical assets, and driving sustainable industrial growth for all stakeholders.',
            'stat_experience_years'       => '7+',
            'stat_clients_count'          => '1,000+',
            'stat_guarantee_percent'      => '100%',
        ];

        foreach ($defaults as $k => $v) {
            \App\Models\SiteSetting::set($k, $v, 'about_us');
        }
    }
}
