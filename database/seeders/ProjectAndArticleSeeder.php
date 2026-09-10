<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectAndArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $adminId = $admin ? $admin->id : 1;

        // 1. Ensure Project Categories
        $projectCategories = [
            ['name' => 'Commercial & High-Rise', 'slug' => 'commercial-high-rise', 'code' => 'COMMERCIAL'],
            ['name' => 'Food & Beverage', 'slug' => 'food-beverage', 'code' => 'FOOD-BEV'],
            ['name' => 'Cold Storage & Logistics', 'slug' => 'cold-storage-logistics', 'code' => 'COLD-LOGISTICS'],
            ['name' => 'Heavy Industry & Smelter', 'slug' => 'heavy-industry-smelter', 'code' => 'SMELTER'],
            ['name' => 'Critical Infrastructure', 'slug' => 'critical-infrastructure', 'code' => 'CRITICAL-INFRA'],
        ];

        $pCatMap = [];
        foreach ($projectCategories as $pCat) {
            $cat = ProjectCategory::firstOrCreate(
                ['slug' => $pCat['slug']],
                ['name' => $pCat['name'], 'code' => $pCat['code'], 'description' => "Category for {$pCat['name']}", 'is_active' => true]
            );
            $pCatMap[$pCat['slug']] = $cat->id;
        }

        // 2. Seed 8 Flagship Engineering Projects
        $projects = [
            [
                'project_code' => 'PRJ-2024-PKW',
                'title' => 'Pakuwon Mall & Superblock Power Substation',
                'slug' => 'pakuwon-mall-superblock-power-substation',
                'category_id' => $pCatMap['commercial-high-rise'],
                'client_name' => 'Pakuwon Group',
                'location' => 'West Surabaya, Indonesia',
                'completion_year' => '2024',
                'scope_of_work' => 'Schneider MasterPact MTZ 3200A • GAE Capacitor 600kVAR',
                'summary' => 'Complete engineering, fabrication, and supply of Low Voltage Main Distribution Panels (LVMDP) for Surabaya’s largest commercial superblock.',
                'cover_alt' => 'Pakuwon Mall Power Substation LVMDP Switchboard',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'project_code' => 'PRJ-2024-IDF',
                'title' => 'Indofood CBP Motor Control Center (MCC)',
                'slug' => 'indofood-cbp-motor-control-center-mcc',
                'category_id' => $pCatMap['food-beverage'],
                'client_name' => 'PT Indofood CBP Sukses Makmur Tbk',
                'location' => 'Pasuruan, East Java',
                'completion_year' => '2024',
                'scope_of_work' => 'Schneider Altivar ATV930 VFD • TeSys Deca Contactors',
                'summary' => 'Smart motor control center switchboards equipped with harmonic suppression inverters and thermal predictive monitoring for continuous food processing.',
                'cover_alt' => 'Indofood CBP Smart MCC Switchboard Panels',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'project_code' => 'PRJ-2024-BMI',
                'title' => 'PT Bumi Menara Internusa Cold Chain & SCADA',
                'slug' => 'bumi-menara-internusa-cold-chain-scada',
                'category_id' => $pCatMap['cold-storage-logistics'],
                'client_name' => 'PT Bumi Menara Internusa',
                'location' => 'Dampit & Surabaya',
                'completion_year' => '2023 - 2024',
                'scope_of_work' => 'Socomec ATS 1600A • GAE Digital Power Metering',
                'summary' => 'Integrated industrial refrigeration power distribution panels with dual-redundant automatic transfer switching and IoT SCADA telemetries.',
                'cover_alt' => 'Cold Chain Refrigeration Automation Switchboards',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'project_code' => 'PRJ-2023-TTL',
                'title' => 'Teluk Lamong Port Terminal Infrastructure',
                'slug' => 'teluk-lamong-port-terminal-infrastructure',
                'category_id' => $pCatMap['critical-infrastructure'],
                'client_name' => 'PT Terminal Teluk Lamong (Pelindo)',
                'location' => 'Surabaya Port Zone',
                'completion_year' => '2023',
                'scope_of_work' => 'Heavy Duty Marine IP66 Panels • Fluke Power Analyzers',
                'summary' => 'Harsh-marine environment low-voltage distribution panels designed to IP66 standards with anti-corrosive stainless steel enclosures.',
                'cover_alt' => 'Teluk Lamong Marine IP66 Distribution Switchgear',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'project_code' => 'PRJ-2024-DKL',
                'title' => 'PT Dua Kelinci Packaging Automation',
                'slug' => 'dua-kelinci-packaging-automation',
                'category_id' => $pCatMap['food-beverage'],
                'client_name' => 'PT Dua Kelinci',
                'location' => 'Pati & Central Java',
                'completion_year' => '2024',
                'scope_of_work' => 'Autonics Multi-Axis Servo Control • PLC Gateway',
                'summary' => 'Precision automation control panels driving high-speed packaging machinery with synchronized multi-axis servo drives.',
                'cover_alt' => 'Packaging Line PLC & Servo Control Center',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'project_code' => 'PRJ-2024-FPT',
                'title' => 'Freeport Indonesia Smelter Power Distribution',
                'slug' => 'freeport-indonesia-smelter-power-distribution',
                'category_id' => $pCatMap['heavy-industry-smelter'],
                'client_name' => 'PT Freeport Indonesia',
                'location' => 'Manyar, Gresik',
                'completion_year' => '2024',
                'scope_of_work' => 'Schneider MasterPact NW 4000A • IP66 Enclosures',
                'summary' => 'Heavy-duty 4000A copper busbar power centers built for continuous chemical and copper metallurgical smelting operations.',
                'cover_alt' => 'Smelter High-Current 4000A Switchgear Panels',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'project_code' => 'PRJ-2024-DTC',
                'title' => 'Surabaya Tier-3 Data Center Power Busway',
                'slug' => 'surabaya-tier-3-data-center-power-busway',
                'category_id' => $pCatMap['critical-infrastructure'],
                'client_name' => 'Tier-3 Hyperscale Colocation',
                'location' => 'Central Surabaya',
                'completion_year' => '2024',
                'scope_of_work' => 'Dual Redundant Busway Trunking • Legrand Modular PDU',
                'summary' => '2N dual-path electrical busway infrastructure and modular power distribution units guaranteeing 99.982% uptime for mission-critical servers.',
                'cover_alt' => 'Hyperscale Data Center Power Busway & PDU',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'project_code' => 'PRJ-2023-MSP',
                'title' => 'Maspion Industrial Estate 20kV Substation',
                'slug' => 'maspion-industrial-estate-20kv-substation',
                'category_id' => $pCatMap['heavy-industry-smelter'],
                'client_name' => 'Maspion Industrial Estate',
                'location' => 'Manyar, Gresik',
                'completion_year' => '2023 - 2024',
                'scope_of_work' => 'Ring Main Unit (RMU) • GAE Metering • Jembo Cables',
                'summary' => 'Medium voltage 20kV step-down substation and low-voltage secondary switchgear servicing multi-tenant heavy manufacturing plants.',
                'cover_alt' => 'Industrial Park 20kV Step-Down Substation',
                'is_featured' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($projects as $prjData) {
            Project::updateOrCreate(
                ['slug' => $prjData['slug']],
                array_merge($prjData, [
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(5, 60)),
                    'content_html' => '<p>' . $prjData['summary'] . '</p><p>Equipped with ' . $prjData['scope_of_work'] . ' to ensure full industrial compliance under SPLN and IEC 61439 standards.</p>',
                    'meta_title' => $prjData['title'] . ' | PT. Anugerah Tama Sejati',
                    'meta_description' => $prjData['summary'],
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ])
            );
        }

        // 3. Ensure Article Categories
        $artCategories = [
            ['name' => 'Switchboard Engineering', 'slug' => 'switchboard-engineering', 'code' => 'SWBD-ENG'],
            ['name' => 'Power Quality & Efficiency', 'slug' => 'power-quality-efficiency', 'code' => 'PWR-QUAL'],
            ['name' => 'Motor Control & Automation', 'slug' => 'motor-control-automation', 'code' => 'MTR-CTRL'],
            ['name' => 'Industrial Protection', 'slug' => 'industrial-protection', 'code' => 'IND-PROT'],
            ['name' => 'Smart Industry 4.0', 'slug' => 'smart-industry-4-0', 'code' => 'INDUSTRY-4'],
            ['name' => 'Critical Infrastructure', 'slug' => 'critical-infrastructure', 'code' => 'CRIT-INFRA'],
            ['name' => 'Electrical Standards', 'slug' => 'electrical-standards', 'code' => 'ELEC-STD'],
        ];

        $aCatMap = [];
        foreach ($artCategories as $aCat) {
            $cat = ArticleCategory::firstOrCreate(
                ['slug' => $aCat['slug']],
                ['name' => $aCat['name'], 'code' => $aCat['code'], 'description' => "Insights on {$aCat['name']}", 'is_active' => true]
            );
            $aCatMap[$aCat['slug']] = $cat->id;
        }

        // 4. Seed 7 Rich Industrial Technical Articles
        $articles = [
            [
                'title' => 'How to Select Between MCCB and ACB for Industrial Main Switchboards (IEC 60947 Standards)',
                'slug' => 'how-to-select-mccb-vs-acb-for-industrial-panels',
                'category_id' => $aCatMap['switchboard-engineering'],
                'excerpt' => 'A comprehensive engineering guide on short-circuit breaking capacities (Icu vs Ics), electronic trip units, selective coordination, and cost optimization when sizing low-voltage main switchboards.',
                'content_html' => '<h2>Understanding the Fundamental Differences Between ACB and MCCB</h2>
<p>In modern industrial facilities, selecting between an Air Circuit Breaker (ACB) and a Moulded Case Circuit Breaker (MCCB) is a pivotal engineering decision that impacts both upfront capital expenditure and long-term facility reliability. Under IEC 60947-2 standards, both devices provide overload and short-circuit protection, but their internal architecture, breaking dynamics, and maintainability differ fundamentally.</p>

<h3>1. Current Ratings & Frame Capacities</h3>
<p>ACBs, such as the <strong>Schneider Electric MasterPact MTZ</strong> and <strong>NW series</strong>, are primarily deployed at the incomer of Low Voltage Main Distribution Panels (LVMDP) with nominal currents ranging from <strong>630A up to 6300A</strong>. MCCBs, like the ComPacT NSX, are optimal for sub-distribution feeders ranging from <strong>16A up to 1600A</strong>.</p>

<h3>2. Rated Service Short-Circuit Capacity (Ics) vs Ultimate Capacity (Icu)</h3>
<p>For critical manufacturing plants and data centers, specifying <code>Ics = 100% Icu</code> is essential. High-end ACBs deliver Ics ratings of 50kA, 65kA, or 100kA at 415V, ensuring the breaker can interrupt a maximum fault current repeatedly without requiring component replacement.</p>

<h3>3. Digital Electronic Trip Units (Micrologic)</h3>
<p>Modern ACBs feature advanced microprocessor trip units (such as Micrologic 2.0X to 7.0X) that incorporate built-in Class 1 energy metering, harmonic analysis up to the 31st order, and Bluetooth/Ethernet telemetries for predictive asset health monitoring.</p>',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Power Factor Correction: Designing 600kVAR Automatic Capacitor Banks for Manufacturing Plants',
                'slug' => 'designing-600kvar-automatic-capacitor-banks-power-factor',
                'category_id' => $aCatMap['power-quality-efficiency'],
                'excerpt' => 'Eliminating PLN kVARh surcharge penalties, sizing detuned anti-resonance reactors (7% and 14%), and selecting heavy-duty capacitor steps for inductive motor loads.',
                'content_html' => '<h2>Why Industrial Facilities Face High kVARh Penalties</h2>
<p>In heavy industrial operations involving AC induction motors, welding machines, and transformers, inductive reactive power lowers the overall power factor (cos φ) below PLN’s threshold of <strong>0.85</strong>. Maintaining a power factor between <strong>0.95 and 0.98</strong> not only prevents financial penalties but also increases transformer capacity and reduces I²R cable losses.</p>

<h3>Detuned Reactor Sizing: 7% vs 14%</h3>
<p>When nonlinear loads (VFDs, UPS, LED drivers) constitute more than 20% of the total load, connecting standard capacitors creates dangerous parallel harmonic resonance. Introducing <strong>7% detuned reactors</strong> tunes the bank to 189 Hz (below the dominant 5th harmonic of 250 Hz), protecting capacitors from catastrophic overvoltage and current distortion.</p>',
                'is_featured' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Variable Frequency Drive (VFD) Harmonics Mitigation in Industrial Pumping Systems',
                'slug' => 'vfd-harmonics-mitigation-industrial-pumping-systems',
                'category_id' => $aCatMap['motor-control-automation'],
                'excerpt' => 'Mitigating THD-i and THD-v distortion caused by 6-pulse diode rectifiers, incorporating DC chokes and passive harmonic filters to protect industrial motors and instrumentation.',
                'content_html' => '<h2>Addressing Electrical Pollution from 6-Pulse Inverters</h2>
<p>Variable Frequency Drives (VFDs) provide substantial energy savings for centrifugal pumps and blowers. However, conventional 6-pulse rectifier front-ends generate significant 5th, 7th, 11th, and 13th harmonic currents, resulting in total harmonic current distortion (THD-i) frequently exceeding 35%.</p>

<h3>Mitigation Strategies</h3>
<p>Utilizing <strong>Schneider Electric Altivar Process ATV930</strong> drives equipped with built-in DC bus chokes reduces THD-i to below 48%. For stringent IEEE 519 compliance (THD-i < 5% at Point of Common Coupling), passive harmonic filters or Active Front End (AFE) regenerative converters should be engineered into the Motor Control Center (MCC).</p>',
                'is_featured' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Motor Control Center (MCC) Sizing: Type-2 Coordination & Arc Flash Safety in Heavy Industry',
                'slug' => 'mcc-sizing-type-2-coordination-arc-flash-safety',
                'category_id' => $aCatMap['industrial-protection'],
                'excerpt' => 'Understanding IEC 60947-4-1 Type-2 coordination between circuit breakers, contactors, and thermal relays to ensure zero contact welding and maximum personnel protection during short circuits.',
                'content_html' => '<h2>The Criticality of Type-2 Coordination</h2>
<p>In continuous manufacturing environments like chemical, cement, and food processing plants, an electrical fault in a single motor starter feeder must not incapacitate the entire switchboard. Under IEC 60947-4-1, <strong>Type-2 Coordination</strong> mandates that after a short-circuit fault, the contactor and overload relay must remain operational and suffer no contact welding or insulation degradation.</p>

<h3>Component Synergy</h3>
<p>Achieving certified Type-2 coordination requires tested combinations of <strong>TeSys Deca / TeSys Giga contactors</strong> paired with precisely calibrated <strong>ComPacT NSX thermal-magnetic or electronic circuit breakers</strong>.</p>',
                'is_featured' => false,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Smart Electrical Switchboards: Integrating Modbus RS-485 & IoT Energy Gateways into LVMDP',
                'slug' => 'smart-electrical-switchboards-modbus-iot-energy-gateways',
                'category_id' => $aCatMap['smart-industry-4-0'],
                'excerpt' => 'Transforming conventional power distribution panels into connected Industry 4.0 digital assets with real-time branch energy monitoring, thermal busbar sensors, and cloud SCADA telemetry.',
                'content_html' => '<h2>Digitalizing Industrial Power Infrastructure</h2>
<p>The convergence of operational technology (OT) and digital IoT allows electrical engineers to transition from reactive firefighting to predictive condition-based maintenance. Equipping LVMDP switchgear with digital power meters and wireless thermal sensors enables continuous asset tracking.</p>

<h3>Communication Architecture</h3>
<p>Daisy-chained <strong>Modbus RS-485 serial loops</strong> aggregate real-time electrical data from feeder meters into edge gateways like the <strong>Schneider EcoStruxure Panel Server</strong>, transmitting encrypted telemetry to plant supervisory SCADA or cloud dashboards via Ethernet/Wi-Fi.</p>',
                'is_featured' => false,
                'published_at' => now()->subDays(16),
            ],
            [
                'title' => 'Automatic Transfer Switch (ATS) & Generator Synchronizing: Ensuring Zero Downtime for Tier-3 Facilities',
                'slug' => 'ats-generator-synchronizing-zero-downtime-tier-3',
                'category_id' => $aCatMap['critical-infrastructure'],
                'excerpt' => 'Engineering closed-transition transfer mechanisms, Socomec ATyS motorized switches, and automatic mains failure (AMF) logic to protect critical IT and hospital backup power grids.',
                'content_html' => '<h2>Uncompromising Power Reliability for Critical Loads</h2>
<p>When the main utility grid experiences an outage or voltage sag, automatic transfer systems must detect the anomaly and command diesel generators to start, synchronize, and take over critical plant feeders in under 10 seconds.</p>

<h3>Open vs Closed Transition Switching</h3>
<p>Standard open-transition (break-before-make) switches induce a brief momentary disruption during transfer. For sensitive electronics, <strong>closed-transition (make-before-break) systems</strong> achieve seamless bumpless paralleling for 100 milliseconds, ensuring zero interruption to mission-critical infrastructure.</p>',
                'is_featured' => false,
                'published_at' => now()->subDays(21),
            ],
            [
                'title' => 'Industrial Cable Sizing, Derating Factors & Voltage Drop Calculations for 3-Phase Feeders',
                'slug' => 'industrial-cable-sizing-derating-voltage-drop-calculations',
                'category_id' => $aCatMap['electrical-standards'],
                'excerpt' => 'A practical methodology for sizing copper and aluminum XLPE power cables (Jembo, Supreme) in cable trays, incorporating ambient temperature and grouping derating under PUIL 2011.',
                'content_html' => '<h2>Ensuring Voltage Compliance Across Long Factory Runs</h2>
<p>Undersized electrical cables generate excessive resistive heating (I²R loss), lead to premature insulation failure, and cause voltage drops exceeding the statutory <strong>5% limit</strong> under Indonesian General Electrical Installation Regulations (PUIL 2011 / SPLN).</p>

<h3>Step-by-Step Sizing Criteria</h3>
<ol>
  <li><strong>Full Load Current (Ib):</strong> Calculate three-phase running current: <code>Ib = P / (√3 × V × cos φ × η)</code>.</li>
  <li><strong>Environmental Derating:</strong> Multiply nominal cable ampacity by ambient temperature factor (k1) and grouping proximity factor (k2) in perforated cable trays.</li>
  <li><strong>Voltage Drop Check:</strong> Ensure: <code>ΔV = (√3 × I × L × (R cos φ + X sin φ)) / 1000 ≤ 5% of 400V (20V)</code>.</li>
</ol>',
                'is_featured' => false,
                'published_at' => now()->subDays(28),
            ],
        ];

        foreach ($articles as $artData) {
            Article::updateOrCreate(
                ['slug' => $artData['slug']],
                array_merge($artData, [
                    'status' => 'published',
                    'author_id' => $adminId,
                    'author_display_name' => 'PT. ATS Engineering Editorial',
                    'meta_title' => $artData['title'] . ' | PT. Anugerah Tama Sejati',
                    'meta_description' => $artData['excerpt'],
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ])
            );
        }
    }
}
