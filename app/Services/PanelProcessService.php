<?php

namespace App\Services;

class PanelProcessService
{
    public const DATA_VERSION = 3;

    protected static string $storageFile = 'panel-process-data.json';

    public static function getFilePath(): string
    {
        return storage_path('app/' . self::$storageFile);
    }

    public static function getData(): array
    {
        $file = self::getFilePath();
        $default = self::getDefaultData();

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true);
            if (is_array($data) && isset($data['phases']) && isset($data['steps'])) {
                $needsSave = false;
                $defaultMachines = $default['facilities']['machines'] ?? [];
                $currentMachines = $data['facilities']['machines'] ?? [];

                // Auto-upgrade machines if production has an older dataset (e.g. 4 instead of 8 machines)
                if (count($currentMachines) < count($defaultMachines)) {
                    $data['facilities']['machines'] = $defaultMachines;
                    $needsSave = true;
                }

                // Auto-upgrade schema/version
                if (($data['version'] ?? 0) < self::DATA_VERSION) {
                    $data['version'] = self::DATA_VERSION;
                    if (count($currentMachines) < count($defaultMachines)) {
                        $data['facilities']['machines'] = $defaultMachines;
                    }
                    $needsSave = true;
                }

                if ($needsSave) {
                    self::saveData($data);
                }

                return $data;
            }
        }

        $default['version'] = self::DATA_VERSION;
        self::saveData($default);
        return $default;
    }

    public static function saveData(array $data): bool
    {
        $file = self::getFilePath();
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return (bool) file_put_contents($file, $json);
    }

    public static function resetToDefault(): array
    {
        $default = self::getDefaultData();
        self::saveData($default);
        return $default;
    }

    public static function getDefaultData(): array
    {
        return [
            'version' => self::DATA_VERSION,
            'intro' => [
                'eyebrow' => 'Behind Every Switchboard',
                'title' => 'Precision.',
                'title_em' => 'In every process.',
                'description' => 'From initial technical specifications to fully commissioned switchboards. Discover how each enclosure is engineered, laser-cut, formed, powder-coated, assembled, and verified.',
                'stat_steps_num' => '33',
                'stat_steps_label' => 'Production<br>Steps',
                'stat_phases_num' => '06',
                'stat_phases_label' => 'Integrated<br>Phases',
            ],
            'section_line' => [
                'title' => 'The Making of a Switchboard',
                'hint' => 'Hover over cards to preview · Click to explore detailed steps',
            ],
            'explorer' => [
                'eyebrow' => 'Process Explorer',
                'title' => 'Explore Every Step.',
                'tour_button_play' => 'Play Process Tour',
                'tour_button_pause' => 'Pause Tour',
            ],
            'directory' => [
                'title' => 'Full Production Workflow. Zero Compromise.',
                'subtitle' => '01 — 33<br>Click to expand step details',
                'button_label' => 'View step details',
            ],
            'facilities' => [
                'eyebrow' => 'Production Facilities',
                'title' => 'Machinery Engineered for Precision.',
                'description' => 'Sheet metal fabrication and enclosure assembly supported by high-precision CNC laser cutting, punching, and multi-axis hydraulic bending.',
                'hide_animation' => false,
                'machines' => [
                    [
                        'image' => 'machine-laser.jpg',
                        'count' => '03',
                        'unit' => 'units',
                        'title' => 'CNC Fiber Laser Cutting System',
                        'desc' => "Equipped with 1,500 W and 1,000 W fiber laser resonators, automated dual-shuttle exchange tables, and high-precision optical collimation. Delivers sub-millimeter precision cuts with minimal heat-affected zones across mild steel, galvanized plate, and stainless steel enclosures.",
                        'tags' => ['1,500 W & 1,000 W Resonators', '±0.05 mm Cutting Tolerance', 'Dual Exchange Shuttle Bed', 'Automatic CAD Nesting'],
                        'powers_step' => 'Step 07: CNC Laser Cutting',
                        'powers_step_index' => 6,
                    ],
                    [
                        'image' => 'machine-bending.jpg',
                        'count' => '03',
                        'unit' => 'units',
                        'title' => 'CNC Multi-Axis Hydraulic Press Brake',
                        'desc' => "Heavy-duty 10-ton multi-axis CNC hydraulic bending machines with precision segmented hardened tooling and automatic crowning compensation. Ensures exact angular accuracy and repeatable flange geometry across long enclosure door panels and internal structural uprights.",
                        'tags' => ['10-Ton Hydraulic Force', 'Multi-Axis CNC Backgauge', 'Auto Crowning Compensation', 'Segmented Hardened Tooling'],
                        'powers_step' => 'Step 08: CNC Bending',
                        'powers_step_index' => 7,
                    ],
                    [
                        'image' => 'machine-punching.jpg',
                        'count' => '02',
                        'unit' => 'units',
                        'title' => 'CNC Turret Punch Press',
                        'desc' => "High-speed 40-ton automated CNC turret punch press equipped with multi-station rotary tool carousels. Rapidly forms instrument cut-outs, ventilation louvers, push-button holes, and standardized mounting grid perforations with zero sheet distortion.",
                        'tags' => ['40-Ton Punching Capacity', 'Multi-Station Rotary Turret', 'Automated Louver Tooling', 'High-Speed Sheet Repositioning'],
                        'powers_step' => 'Step 07: CNC Punching',
                        'powers_step_index' => 6,
                    ],
                    [
                        'image' => 'machine-shearing.webp',
                        'count' => '03',
                        'unit' => 'meters',
                        'title' => 'Heavy Hydraulic Guillotine Shearing',
                        'desc' => "Features a 3.0-meter cutting bed and powerful hydraulic hold-down clamping cylinders. Performs rapid, square sizing of full raw steel sheets into fabrication blanks prior to laser cutting and CNC punch processing.",
                        'tags' => ['3.0 Meter Cutting Bed', 'Hydraulic Sheet Clamping', 'Digital Readout Backgauge', 'Clean Burr-Free Shearing'],
                        'powers_step' => 'Step 06: Material Preparation',
                        'powers_step_index' => 5,
                    ],
                    [
                        'image' => 'surface.webp',
                        'count' => '05',
                        'unit' => 'tanks',
                        'model' => 'pickling',
                        'title' => 'HCl Chemical Pickling & Residue Removal',
                        'desc' => "Multi-stage chemical immersion line using inhibited hydrochloric acid (HCl) to strip fabrication oils, red rust, and mill scale residue. Equipped with automated overhead gantry hoists and chemical vapor scrubbing.",
                        'tags' => ['Inhibited HCl Acid Bath', 'Automated Gantry Hoist', '100% Rust & Scale Stripping', 'Vapor Scrubbing & Fume Extraction'],
                        'powers_step' => 'Step 13: Pickling / Rust & Scale Removal',
                        'powers_step_index' => 12,
                    ],
                    [
                        'image' => 'coating.webp',
                        'count' => '07',
                        'unit' => 'stages',
                        'model' => 'phosphate',
                        'title' => 'Lime & Phosphating Chemical Dip Coating',
                        'desc' => "Chemical conversion immersion line featuring heated zinc-phosphate and lime passivation baths (55°C). Forms a micro-crystalline protective layer across all steel folds, maximizing powder adhesion and corrosion resistance.",
                        'tags' => ['Zinc Phosphate Conversion', 'Lime Passivation Dip', 'Heated Bath (55°C)', 'Multi-Stage Demineralized Rinse'],
                        'powers_step' => 'Step 15: Neutralizing & Conversion Coating',
                        'powers_step_index' => 14,
                    ],
                    [
                        'image' => 'curing.webp',
                        'count' => '02',
                        'unit' => 'lines',
                        'model' => 'powder',
                        'title' => 'Electrostatic Powder Coating & Curing Oven',
                        'desc' => "Clean-room electrostatic spray booth with reciprocating corona powder guns and continuous convection curing ovens operating at 180°C–200°C for hardened, cross-linked industrial finish.",
                        'tags' => ['Automated Corona Spray Guns', 'Continuous Convection Oven 180–200°C', 'RAL 7032 / 7035 Standard', 'DFT Controlled 60–80 µm'],
                        'powers_step' => 'Step 20: Powder Coating & Curing',
                        'powers_step_index' => 19,
                    ],
                    [
                        'image' => 'assembly.webp',
                        'count' => '08',
                        'unit' => 'stations',
                        'model' => 'wiring',
                        'title' => 'Electrical Switchgear Outfitting & Panel Wiring',
                        'desc' => "Dedicated panel assembly workstations for switchgear outfitting (ACB, MCCB, contactors, protection relays), ETP electrolytic copper busbars torque-fitting, and color-coded secondary control wiring.",
                        'tags' => ['Switchgear & DIN Rail Mounting', 'ETP Copper Busbar & Torque Seal', 'R-S-T-N Color Coded Wiring', 'Insulation & Continuity Verification'],
                        'powers_step' => 'Step 25: Wiring & Termination',
                        'powers_step_index' => 24,
                    ],
                ],
            ],
            'quality' => [
                'title' => "Quality Verified<br>at Every Milestone.",
                'description' => "Engineering drawing audits, dimensional tolerance checks, surface degreasing, coating thickness, and electrical continuity serve as mandatory inspection gates before proceeding to subsequent stages. Execution procedures, pretreatment chemistry, oven curing profiles, and testing scopes strictly adhere to project specifications and client-approved shop drawings.",
            ],
            'phases' => [
                [
                    'title' => 'Engineering',
                    'from' => 0,
                    'to' => 5,
                    'image' => 'engineering',
                    'caption' => 'Technical specifications translated into production-ready drawings.',
                    'desc' => 'Requirements gathering, CAD schematics, client approval, and production planning.',
                ],
                [
                    'title' => 'Fabrication',
                    'from' => 6,
                    'to' => 11,
                    'image' => 'fabrication',
                    'caption' => 'Sheet metal precision-cut and formed into structural enclosures.',
                    'desc' => 'Laser cutting, CNC punching, hydraulic bending, welding, and seam dressing.',
                ],
                [
                    'title' => 'Surface Treatment',
                    'from' => 12,
                    'to' => 18,
                    'image' => 'surface',
                    'caption' => 'Substrate chemically prepared for optimal coating adhesion and durability.',
                    'desc' => 'Degreasing, pickling, neutralization, cascade rinsing, and drying.',
                ],
                [
                    'title' => 'Coating',
                    'from' => 19,
                    'to' => 21,
                    'image' => 'coating',
                    'caption' => 'Resilient industrial protective finish for high environmental resistance.',
                    'desc' => 'Electrostatic powder application, high-temperature curing, and DFT inspection.',
                ],
                [
                    'title' => 'Assembly',
                    'from' => 22,
                    'to' => 26,
                    'image' => 'assembly',
                    'caption' => 'Enclosure, switchgear, busbars, and wiring integrated into one unified system.',
                    'desc' => 'Mechanical assembly, component installation, busbar fabrication, and wiring.',
                ],
                [
                    'title' => 'Quality & Delivery',
                    'from' => 27,
                    'to' => 32,
                    'image' => 'quality',
                    'caption' => 'Comprehensive FAT testing, certification, crating, and site dispatch.',
                    'desc' => 'Electrical testing, FAT simulation, documentation, packing, and dispatch.',
                ],
            ],
            'steps' => [
                // Phase 1: Engineering (0 - 5)
                [
                    'title' => 'Customer Requirement / Technical Specification',
                    'subtitle' => 'Understanding Your Technical Requirements',
                    'description' => 'Operating needs and technical specifications are gathered as the baseline for switchboard design. The project scope is clearly established before engineering commencement.',
                    'activities' => [
                        'Identify switchboard operational functions and electrical load requirements',
                        'Collect Single Line Diagrams (SLD), technical specifications, and site constraints',
                        'Determine scope of supply, structural materials, and required documentation',
                    ],
                    'checkpoint' => 'Data completeness and signed technical scope alignment.',
                    'output' => 'Approved technical requirements document as the engineering baseline.',
                    'image' => 'engineering',
                ],
                [
                    'title' => 'Engineering & AutoCAD Design',
                    'subtitle' => 'Translating Specifications into Schematics',
                    'description' => 'The electrical and mechanical engineering team prepares detailed drawings ensuring the switchboard configuration strictly matches project criteria.',
                    'activities' => [
                        'Develop Single Line Diagrams (SLD) and control logic schematics',
                        'Design component layout arrangements and enclosure dimensions',
                        'Prepare fabrication drawings and complete Bill of Quantities (BoQ)',
                    ],
                    'checkpoint' => 'Compliance with technical specifications, clearance tolerances, and maintenance accessibility.',
                    'output' => 'Complete drawing package and material BoQ for review.',
                    'image' => 'engineering',
                ],
                [
                    'title' => 'Internal Engineering Review',
                    'subtitle' => 'In-House Multi-Disciplinary Review',
                    'description' => 'Drawings undergo rigorous peer review by senior engineers prior to client submission. Any design discrepancies are flagged and resolved.',
                    'activities' => [
                        'Verify consistency between electrical schematics and physical layout',
                        'Review installation clearances, busbar routing paths, and working spaces',
                        'Cross-check fabrication drawings against component BOM',
                    ],
                    'checkpoint' => 'Drawing revision control and complete clearance of internal review findings.',
                    'output' => 'Verified shop drawings ready for client approval.',
                    'image' => 'engineering',
                ],
                [
                    'title' => 'Customer Review & Approval Drawing',
                    'subtitle' => 'Final Drawing Sign-Off with Client',
                    'description' => 'The client reviews the drawing package to confirm alignment with project site needs. Feedback, adjustments, and formal sign-offs are documented.',
                    'activities' => [
                        'Submit approval drawing package to client and engineering consultant',
                        'Coordinate design clarifications, revisions, and technical notes',
                        'Issue officially stamped Approved for Construction (AFC) drawing revision',
                    ],
                    'checkpoint' => 'Production fabrication strictly references client-approved AFC drawings.',
                    'output' => 'Approved For Construction (AFC) drawings governing fabrication.',
                    'image' => 'engineering',
                ],
                [
                    'title' => 'Material Planning & Preparation',
                    'subtitle' => 'Raw Material & Component Staging',
                    'description' => 'Structural materials, enclosures, and switchgear components are allocated based on approved drawings. Material grade, gauge thickness, and certificates are verified upon receipt.',
                    'activities' => [
                        'Stage steel plates, structural profiles, and hardware for fabrication',
                        'Match electrical switchgear components against approved BoQ',
                        'Schedule material releases aligned with workshop production sequencing',
                    ],
                    'checkpoint' => 'Steel grade, plate thickness, component ratings, and physical condition verified.',
                    'output' => 'Inspected, barcoded raw materials and components ready for processing.',
                    'image' => 'engineering',
                ],
                [
                    'title' => 'CNC Programming / Nesting',
                    'subtitle' => 'CNC Machine Code & Sheet Metal Nesting',
                    'description' => 'Fabrication CAD drawings are programmed into CNC machine instructions. Sheet nesting layouts are optimized for minimal scrap and tight dimensional tolerances.',
                    'activities' => [
                        'Convert CAD geometry into CNC toolpaths and G-code',
                        'Optimize plate nesting layouts and laser cutting sequences',
                        'Simulate cut paths prior to releasing programs to the machine floor',
                    ],
                    'checkpoint' => 'Program geometry, material grade, and drawing revision synchronization.',
                    'output' => 'Verified CNC machine code and production nesting layouts.',
                    'image' => 'engineering',
                ],

                // Phase 2: Fabrication (6 - 11)
                [
                    'title' => 'CNC Laser Cutting / CNC Punching',
                    'subtitle' => 'High-Precision Plate Cutting & Piercing',
                    'description' => 'Steel sheets are precision-cut and punched using fiber laser cutting or CNC punching machines according to drawing geometries.',
                    'activities' => [
                        'Cut enclosure bodies, doors, mounting plates, and structural members',
                        'Punch ventilation louvers, meter cut-outs, and cable gland holes',
                        'Label each cut part with unique piece-mark tags for traceability',
                    ],
                    'checkpoint' => 'Cut dimensions, hole diameters, and aperture locations match CAD drawings within ±0.2 mm.',
                    'output' => 'Precision-cut sheet metal parts tagged with piece marks.',
                    'image' => 'fabrication',
                ],
                [
                    'title' => 'Deburring & Edge Finishing',
                    'subtitle' => 'Edge Smoothing & Burr Removal',
                    'description' => 'Slag, burrs, and sharp edges resulting from laser cutting or punching are thoroughly ground and deburred for safe handling and clean fit-up.',
                    'activities' => [
                        'Remove micro-burrs along plate perimeters and aperture edges',
                        'Smooth punch and laser cut surfaces with pneumatic deburring tools',
                        'Inspect edge bevels and corner radii before bending operations',
                    ],
                    'checkpoint' => 'Complete absence of burrs or sharp dross that could compromise fit-up or coating adhesion.',
                    'output' => 'Cleaned, deburred steel parts ready for bending.',
                    'image' => 'fabrication',
                ],
                [
                    'title' => 'Bending / Forming',
                    'subtitle' => 'Precision Angular Forming',
                    'description' => 'Deburred sheet metal parts are formed into panels, door flanges, and rigid profiles using multi-axis hydraulic press brakes.',
                    'activities' => [
                        'Sequence bending strokes based on part geometry and tooling profiles',
                        'Form stiffening flanges, door returns, and channel profiles',
                        'Verify flange depths and angular tolerances after each stroke',
                    ],
                    'checkpoint' => 'Bend angles (90° ± 0.5°) and formed dimensions comply with engineering tolerances.',
                    'output' => 'Formed switchboard structural parts with designed geometric profiles.',
                    'image' => 'bending',
                ],
                [
                    'title' => 'Fit-Up & Dimensional Checking',
                    'subtitle' => 'Structural Pre-Assembly & Alignment Check',
                    'description' => 'Formed panels and frame members are dry-assembled on precision fixture tables to verify fit, squareness, and tolerances before welding.',
                    'activities' => [
                        'Assemble framework, corner brackets, and enclosure panels with temporary clamps',
                        'Check diagonal squareness, gap clearances, and seam alignments',
                        'Correct any minor deviations before permanent weld joints',
                    ],
                    'checkpoint' => 'Squareness, planar alignment, and seam tolerances within ±1.0 mm.',
                    'output' => 'Aligned, clamped switchboard structure verified for welding.',
                    'image' => 'fabrication',
                ],
                [
                    'title' => 'Welding',
                    'subtitle' => 'Structural Welding & Joint Fusion',
                    'description' => 'Enclosure frames, mounting pillars, and body joints are welded using MIG/TIG processes by certified welders following approved Welding Procedure Specifications (WPS).',
                    'activities' => [
                        'Weld corner joints, lifting lugs, base channels, and structural stiffeners',
                        'Control heat input and stitch weld sequences to prevent thermal warpage',
                        'Inspect weld bead uniformity, penetration, and weld seam integrity',
                    ],
                    'checkpoint' => 'Full weld penetration, absence of spatter, burn-through, or structural distortion.',
                    'output' => 'Robust, fully welded switchboard structural frame and enclosure.',
                    'image' => 'welding',
                ],
                [
                    'title' => 'Grinding & Surface Finishing',
                    'subtitle' => 'Weld Dressing & Seam Planarization',
                    'description' => 'Weld beads on exterior visible faces are dressed flush and smoothed to deliver seamless aesthetic surfaces ready for chemical surface treatment.',
                    'activities' => [
                        'Grind flush external corner welds and visible enclosure seams',
                        'Remove welding spatter, oxides, and minor surface imperfections',
                        'Check surface smoothness and final diagonal squareness of the enclosure',
                    ],
                    'checkpoint' => 'Planar, flush weld transitions without gouging base metal or compromising weld strength.',
                    'output' => 'Smooth, dressed enclosure ready for chemical surface treatment.',
                    'image' => 'fabrication',
                ],

                // Phase 3: Surface Treatment (12 - 18)
                [
                    'title' => 'Cleaning / Degreasing',
                    'subtitle' => 'Alkaline Degreasing & Oil Removal',
                    'description' => 'Fabrication oils, grease, and shop grime are chemically removed through multi-stage alkaline immersion or high-pressure spray degreasing.',
                    'activities' => [
                        'Strip oils, cutting fluids, and grease deposits from all steel surfaces',
                        'Monitor chemical concentration, bath temperature, and immersion time',
                        'Inspect complex pockets, folds, and internal corners for grease removal',
                    ],
                    'checkpoint' => 'Water-break-free test confirms 100% grease-free surface.',
                    'output' => 'Chemically degreased steel substrate ready for oxide removal.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Pickling / Rust & Scale Removal',
                    'subtitle' => 'Acid Pickling & Descaling',
                    'description' => 'Surface rust, mill scale, and laser oxides are removed using controlled acid pickling formulations tailored to the steel substrate.',
                    'activities' => [
                        'Immerse steel parts in inhibited acid pickling bath',
                        'Dissolve surface oxidation, heat tint, and scale deposits',
                        'Monitor immersion duration to prevent hydrogen embrittlement',
                    ],
                    'checkpoint' => 'Substrate completely free of red rust, laser oxide, and mill scale.',
                    'output' => 'Descaled, bare metallic steel substrate ready for rinsing.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Rinsing',
                    'subtitle' => 'Primary Intermediate Rinsing',
                    'description' => 'Parts are rinsed with flowing industrial water to remove chemical carry-over and prevent drag-in contamination into downstream tanks.',
                    'activities' => [
                        'Rinse all inner folds, crevices, and outer surfaces with clean running water',
                        'Ensure complete evacuation of trapped liquid from structural cavities',
                        'Monitor rinse water overflow and pH to maintain rinsing efficiency',
                    ],
                    'checkpoint' => 'Rinse water pH near neutral, no acidic carry-over.',
                    'output' => 'Rinsed steel components free of surface chemical film.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Neutralizing',
                    'subtitle' => 'Chemical Neutralization & Passivation',
                    'description' => 'Chemical neutralization bath balances residual acid traces and provides temporary flash rust passivation prior to conversion coating.',
                    'activities' => [
                        'Submerge parts in mild alkaline neutralizing solution',
                        'Neutralize lingering acid traces in folded seams and structural joints',
                        'Verify chemical equilibrium across batch processing',
                    ],
                    'checkpoint' => 'Surface pH balanced within specified chemical parameters.',
                    'output' => 'Neutralized steel substrate prepared for conversion coating.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Final Rinsing',
                    'subtitle' => 'Deionized / Demineralized Water Rinsing',
                    'description' => 'Final rinse with high-purity demineralized water eliminates dissolved salt residues, preventing osmotic blistering beneath the powder coat.',
                    'activities' => [
                        'Cascade rinse with low-conductivity demineralized (RO) water',
                        'Thoroughly flush drainage weep holes and blind corners',
                        'Measure rinse bath electrical conductivity (micro-Siemens/cm)',
                    ],
                    'checkpoint' => 'Rinse conductivity below 50 µS/cm; zero mineral salt residue.',
                    'output' => 'Ultra-clean, mineral-free steel substrate ready for drying.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Drying',
                    'subtitle' => 'Hot Air Moisture Evaporation',
                    'description' => 'Rinsed components enter a forced-air dry-off oven to evaporate all moisture, paying particular attention to seam joints and crevices.',
                    'activities' => [
                        'Drain excess rinse water through designated weep holes',
                        'Dry components in hot-air convection oven at 120°C–140°C',
                        'Inspect structural seams, spot-welded folds, and threaded studs for moisture',
                    ],
                    'checkpoint' => '100% moisture-free surface; zero flash rusting observed.',
                    'output' => 'Bone-dry, pretreated steel enclosure ready for powder coating.',
                    'image' => 'surface',
                ],
                [
                    'title' => 'Surface Inspection',
                    'subtitle' => 'Pre-Coating Substrate Quality Audit',
                    'description' => 'Comprehensive quality check of the pretreated substrate ensuring clean conversion coating, dry crevices, and absence of contamination prior to coating booth entry.',
                    'activities' => [
                        'Inspect substrate color uniformity, cleanliness, and water-mark absence',
                        'Confirm thread protection masking and ground-stud silicone plugs',
                        'Issue formal QC release ticket for powder booth entry',
                    ],
                    'checkpoint' => 'Substrate complies with ISO 12944 surface cleanliness standards.',
                    'output' => 'Certified pretreated steel structure approved for coating.',
                    'image' => 'surface',
                ],

                // Phase 4: Coating (19 - 21)
                [
                    'title' => 'Powder Coating / Painting',
                    'subtitle' => 'Electrostatic Thermoset Powder Application',
                    'description' => 'Pure polyester or epoxy-polyester powder coating (RAL 7032 / RAL 7035 / custom) is electrostatically applied in clean spray booths with precise thickness control.',
                    'activities' => [
                        'Apply thermoset powder using corona electrostatic spray guns',
                        'Mask earthing studs, door hinge pins, and copper busbar contact surfaces',
                        'Maintain uniform wrap-around coating across internal corners and edges',
                    ],
                    'checkpoint' => 'Uniform powder film without sags, pinholes, or thin Faraday cage spots.',
                    'output' => 'Electrostatically coated enclosure with masked grounding terminals.',
                    'image' => 'coating',
                ],
                [
                    'title' => 'Oven Curing',
                    'subtitle' => 'High-Temperature Polymer Curing',
                    'description' => 'Coated components pass through a continuous convection bake oven, curing the powder into a resilient, cross-linked protective barrier.',
                    'activities' => [
                        'Ramp oven temperature to specified resin cure profile (180°C–200°C)',
                        'Maintain soak time (15–20 minutes) based on steel gauge thickness',
                        'Allow controlled cool-down in clean air to prevent thermal shock',
                    ],
                    'checkpoint' => 'Oven temperature logger confirms complete resin cross-linking.',
                    'output' => 'Fully cross-linked, hardened industrial polymer coating finish.',
                    'image' => 'curing',
                ],
                [
                    'title' => 'Coating Inspection',
                    'subtitle' => 'Coating Quality & Adhesion Verification',
                    'description' => 'Cured finish undergoes stringent testing including dry film thickness (DFT), cross-hatch adhesion, gloss level, and visual color spectrophotometry.',
                    'activities' => [
                        'Measure Dry Film Thickness (DFT) with calibrated magnetic gauges (60–80 µm)',
                        'Perform cross-hatch tape adhesion test (ASTM D3359 / ISO 2409 Class 0)',
                        'Verify color match (RAL 7032/7035), gloss percentage, and impact resistance',
                    ],
                    'checkpoint' => 'DFT 60–80 µm, 100% adhesion pass, zero orange peel or blistering.',
                    'output' => 'Certified powder-coated enclosure ready for mechanical assembly.',
                    'image' => 'coating',
                ],

                // Phase 5: Assembly (22 - 26)
                [
                    'title' => 'Mechanical Assembly',
                    'subtitle' => 'Enclosure, Door & Mounting Plate Fitting',
                    'description' => 'Coated framework, outer covers, gland plates, mounting pans, 3-point locks, and polyurethane foam gaskets are assembled to achieve rated IP protection.',
                    'activities' => [
                        'Fit framework uprights, sub-panels, lifting eyebolts, and plinths',
                        'Install continuous polyurethane foam seal gaskets along door rebates',
                        'Mount 3-point locking handles, heavy-duty concealed hinges, and door stays',
                    ],
                    'checkpoint' => 'Door alignment, smooth lock latching, gasket compression, and IP rating verification.',
                    'output' => 'Assembled IP41–IP65 enclosure ready for component outfitting.',
                    'image' => 'assembly',
                ],
                [
                    'title' => 'Electrical Component Installation',
                    'subtitle' => 'Switchgear & Control Component Outfitting',
                    'description' => 'Genuine switchgear—Air Circuit Breakers (ACB), Molded Case Circuit Breakers (MCCB), contactors, relays, and power meters—are installed according to approved layout drawings.',
                    'activities' => [
                        'Mount DIN rails, heavy-duty mounting brackets, and cable trunking ducts',
                        'Bolt ACBs, MCCBs, VFD inverters, capacitor banks, and protection relays',
                        'Verify electrical clearances, heat dissipation spacing, and servicing access',
                    ],
                    'checkpoint' => 'Component part numbers, current ratings, and mounting positions match approved AFC drawings.',
                    'output' => 'Switchgear securely installed in designed layout positions.',
                    'image' => 'assembly',
                ],
                [
                    'title' => 'Busbar Fabrication & Installation',
                    'subtitle' => 'Copper Busbar Sizing, Bending & Torque Fitting',
                    'description' => '99.9% pure electrolytic copper busbars (ETP grade) are precision-sheared, punched, hydraulic-bent, tin/silver plated, insulated with heat-shrink sleeves, and torque-bolted.',
                    'activities' => [
                        'Shear and bend high-conductivity copper busbars per thermal calculations',
                        'Fit phase-colored heat-shrink insulation sleeves (Red, Yellow, Blue, Black, Green/Yellow)',
                        'Mount on high-strength fiberglass-reinforced DMC/SMC busbar supports',
                        'Fasten joints with high-tensile 8.8 grade bolts using calibrated torque wrenches and mark with torque seal',
                    ],
                    'checkpoint' => 'Busbar cross-section matches rated ampacity; all bolts torqued to spec with torque seal lacquer.',
                    'output' => 'Fully installed, color-coded, torque-verified power busbar system.',
                    'image' => 'assembly',
                ],
                [
                    'title' => 'Wiring & Termination',
                    'subtitle' => 'Control & Secondary Power Wiring',
                    'description' => 'Control, metering, protection, and communication cabling are neatly routed through slotted PVC ducts, terminated with calibrated crimp ferrules, and labeled.',
                    'activities' => [
                        'Route flame-retardant flexible copper wiring through enclosed trunking',
                        'Crimp insulated ferrules, ring lugs, and spade terminals with calibrated ratcheting crimpers',
                        'Terminate wiring neatly to terminal blocks, relays, meters, and pushbuttons',
                        'Separate control wiring from power circuits to eliminate electromagnetic interference (EMI)',
                    ],
                    'checkpoint' => 'Ferrule crimp pull-test verified; wire numbers match schematic diagrams exactly.',
                    'output' => 'Cleanly wired, noise-isolated control and metering circuit system.',
                    'image' => 'assembly',
                ],
                [
                    'title' => 'Labeling & Identification',
                    'subtitle' => 'Circuit Identification & Mimic Schematics',
                    'description' => 'Clear engraved phenolic legend plates, wire ferrule sleeves, component labels, danger warning decals, and the main switchboard nameplate are affixed.',
                    'activities' => [
                        'Install heat-shrink printed ferrule markers at both ends of every wire',
                        'Affix laser-engraved phenolic labels for feeders, switches, and pilot lights',
                        'Mount high-voltage danger warning symbols, earthing symbols, and rating plate',
                        'Fasten the official stainless steel switchboard rating nameplate with project BoQ data',
                    ],
                    'checkpoint' => 'All labels legibly printed, mechanically secure, and 100% matched to schematics.',
                    'output' => 'Fully labeled switchboard with complete circuit traceability.',
                    'image' => 'assembly',
                ],

                // Phase 6: Quality & Delivery (27 - 32)
                [
                    'title' => 'Mechanical & Electrical Inspection',
                    'subtitle' => 'Comprehensive Pre-Testing Audit',
                    'description' => 'Rigorous pre-commissioning audit checking mechanical torque, wiring point-to-point continuity, phase color sequence, and electrical clearances before live power is introduced.',
                    'activities' => [
                        'Perform 100% point-to-point wiring continuity verification against schematics',
                        'Audit bolt torque markings on busbars, circuit breakers, and terminals',
                        'Check mechanical interlocking levers, door microswitches, and breaker racking',
                    ],
                    'checkpoint' => 'Zero wiring discrepancies; all mechanical and electrical clearances verified.',
                    'output' => 'Inspection sign-off clearing switchboard for Factory Acceptance Testing.',
                    'image' => 'quality',
                ],
                [
                    'title' => 'Functional Testing',
                    'subtitle' => 'Factory Acceptance Testing (FAT) & Simulation',
                    'description' => 'Live secondary injection, automatic transfer logic (ATS), tripping simulations, and dielectric insulation resistance tests (Megger 1,000V DC) witnessed and recorded.',
                    'activities' => [
                        'Conduct high-voltage insulation resistance tests (phase-to-phase & phase-to-ground)',
                        'Test dielectric withstand voltage (2.5 kV for 1 minute per IEC 61439)',
                        'Simulate ATS mains failure, generator auto-start, transfer, and re-transfer',
                        'Verify shunt trip operations, overcurrent relay timing, and digital meter telemetry',
                    ],
                    'checkpoint' => 'Insulation resistance > 100 MΩ; 100% pass on all control logic simulations.',
                    'output' => 'Stamped Factory Acceptance Test (FAT) report certified by lead QA engineer.',
                    'image' => 'quality',
                ],
                [
                    'title' => 'Final QC',
                    'subtitle' => 'Final Quality Assurance Sign-Off',
                    'description' => 'Consolidated review of all inspection checklists, FAT certificates, customer punch list items, and photographic archives before authorizing packing release.',
                    'activities' => [
                        'Audit test certificates, calibration records, and inspection punch lists',
                        'Confirm resolution and close-out of all client inspection comments',
                        'Issue official Quality Assurance Certificate of Compliance',
                    ],
                    'checkpoint' => 'All customer punch list items 100% closed and QA signed off.',
                    'output' => 'Authorized Quality Certificate and Packing Release Authorization.',
                    'image' => 'quality',
                ],
                [
                    'title' => 'Cleaning & Documentation',
                    'subtitle' => 'Workshop Cleaning & As-Built Documentation Package',
                    'description' => 'Switchboards are vacuumed, cleaned of dust and fingerprints, and paired with comprehensive as-built drawing binders, test certificates, and warranty documentation.',
                    'activities' => [
                        'Vacuum interior enclosures and wipe down exterior powder-coated surfaces',
                        'Touch up any minor transport mounting blemishes with original paint',
                        'Bind laminated Single Line Diagrams, as-built schematics, and test reports',
                        'Place component manufacturer warranty cards and manuals in door document pockets',
                    ],
                    'checkpoint' => 'Pristine interior and exterior cleanliness; documentation package complete.',
                    'output' => 'Cleaned switchboard equipped with complete project documentation package.',
                    'image' => 'quality',
                ],
                [
                    'title' => 'Packing',
                    'subtitle' => 'Heavy-Duty Industrial Protective Packaging',
                    'description' => 'Enclosures are bubble-wrapped, moisture-sealed with silica gel desiccant bags, stretch-wrapped, edge-protected, and crated on reinforced treated wooden pallets for transport.',
                    'activities' => [
                        'Apply heavy-gauge anti-scratch bubble wrap and moisture barrier films',
                        'Insert industrial silica gel desiccant packs inside switchboard compartments',
                        'Mount enclosure securely onto heavy-duty treated wooden transport pallets',
                        'Fit corner shock protectors and wrap with opaque heavy-duty stretch film',
                    ],
                    'checkpoint' => 'Packaging meets international freight handling and weatherproofing standards.',
                    'output' => 'Weatherproof, crated switchboard secured for domestic or export freight.',
                    'image' => 'factory',
                ],
                [
                    'title' => 'Ready for Delivery',
                    'subtitle' => 'Site Logistics & Dispatch Coordination',
                    'description' => 'Final dispatch verification matching delivery orders, site contact details, crane offloading arrangements, and freight insurance before release to site.',
                    'activities' => [
                        'Cross-check shipping manifest, serial numbers, and delivery destination',
                        'Coordinate crane / tail-lift transport truck equipped with air-suspension',
                        'Issue delivery note and dispatch notification to project site engineer',
                    ],
                    'checkpoint' => 'Shipping manifest, insurance coverage, and transport readiness confirmed.',
                    'output' => 'Dispatched switchboard en route to client facility for site installation.',
                    'image' => 'factory',
                ],
            ],
        ];
    }
}
