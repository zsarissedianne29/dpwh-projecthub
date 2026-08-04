<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::truncate();

        Project::insert([

            [
                'project_id' => '26R00001',
                'project_title' => 'ORGANIZATIONAL OUTCOME 1: ENSURE SAFE AND RELIABLE NATIONAL ROAD SYSTEM - NETWORK DEVELOPMENT PROGRAM - CONSTRUCTION OF MISSING LINKS/NEW ROADS: HIMAMAYLAN CITY - NEGROS ORIENTAL BOUNDARY - TAYASAN ROAD, STA. 15+553 - STA. 19+178, NEGROS OCCIDENTAL',
                'contract_amount' => 46810000.00,
                'contractor' => 'HLJ CONSTRUCTION & ENTERPRISES',
                'project_engineer' => 'JAYVEE O. MANSIBANG',
                'location' => 'Himamaylan City, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 2.47,
                'start_date' => '2026-06-23',
                'expiry_date' => '2027-02-26',
                'target_completion' => '2027-02-26',
                'actual_completion' => 0,
                'physical_accomplishment' => 3.69,
                'financial_accomplishment' => 2.47,
                'latitude' => 10.1005,
                'longitude' => 122.8705,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00002',
                'project_title' => 'ORGANIZATIONAL OUTCOME 1: ENSURE SAFE AND RELIABLE NATIONAL ROAD SYSTEM - NETWORK DEVELOPMENT PROGRAM - CONSTRUCTION OF MISSING LINKS/NEW ROADS: CANDONI-GATUSLAO-BASAY BOUNDARY ROAD, STA. 20+280 - STA. 21+530, NEGROS OCCIDENTAL',
                'contract_amount' => 93620000.00,
                'contractor' => 'HLJ CONSTRUCTION & ENTERPRISES',
                'project_engineer' => 'REYNALDO C. FERNANDEZ',
                'location' => 'Candoni, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 2.50,
                'start_date' => '2026-06-23',
                'expiry_date' => '2027-04-18',
                'target_completion' => '2027-04-18',
                'actual_completion' => 0,
                'physical_accomplishment' => 4.50,
                'financial_accomplishment' => 2.50,
                'latitude' => 9.8200,
                'longitude' => 122.6400,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00003',
                'project_title' => 'BACOLOD-MURCIA-DS BENEDICTO-SAN CARLOS CITY ROAD - K0064+289 - K0065+052, K0068+293 - K0069+571',
                'contract_amount' => 65221550.00,
                'contractor' => 'SILVER DRAGON CONSTRUCTION AND LUMBER AND GLASS SUPPLY, INC.',
                'project_engineer' => 'CETILLA VERNA A. TINAYA',
                'location' => 'Bacolod-Murcia-DS Benedicto Road, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 0.00,
                'start_date' => '2026-06-25',
                'expiry_date' => '2027-02-18',
                'target_completion' => '2027-02-18',
                'actual_completion' => 0,
                'physical_accomplishment' => 1.78,
                'financial_accomplishment' => 0.00,
                'latitude' => 10.6000,
                'longitude' => 123.0500,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00004',
                'project_title' => 'CONSTRUCTION OF ROAD LEADING TO THE NEW DEVELOPMENT AREA, STA. 0+480 - STA. 0+980, BARANGAY IGMAYAAN, DON SALVADOR BENEDICTO, NEGROS OCCIDENTAL',
                'contract_amount' => 18140618.35,
                'contractor' => 'R.A.G. CORONA CONSTRUCTION AND AGGREGATES SUPPLY',
                'project_engineer' => 'CETILLA VERNA A. TINAYA',
                'location' => 'Don Salvador Benedicto, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => -5.27,
                'start_date' => '2026-06-10',
                'expiry_date' => '2026-11-20',
                'target_completion' => '2026-11-20',
                'actual_completion' => 0,
                'physical_accomplishment' => 3.13,
                'financial_accomplishment' => 0.00,
                'latitude' => 10.5400,
                'longitude' => 123.1800,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00005',
                'project_title' => 'CONSTRUCTION OF ROAD BARANGAY II TO BARANGAY V, STA. 0+000 - STA. 0+780, SAN CARLOS CITY, NEGROS OCCIDENTAL',
                'contract_amount' => 27211346.80,
                'contractor' => 'R.A.G. CORONA CONSTRUCTION AND AGGREGATES SUPPLY',
                'project_engineer' => 'CETILLA VERNA A. TINAYA',
                'location' => 'San Carlos City, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 0.22,
                'start_date' => '2026-06-10',
                'expiry_date' => '2026-10-10',
                'target_completion' => '2026-10-10',
                'actual_completion' => 0,
                'physical_accomplishment' => 10.82,
                'financial_accomplishment' => 0.22,
                'latitude' => 10.4800,
                'longitude' => 123.4100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00006',
                'project_title' => 'CONSTRUCTION OF BACOLOD NEGROS OCCIDENTAL ECONOMIC HIGHWAY (BANOCEH), SECTION 2, SEGMENT 2, BACOLOD CITY, NEGROS OCCIDENTAL',
                'contract_amount' => 135750000.00,
                'contractor' => 'M.K.U. CONSTRUCTION AND SUPPLY',
                'project_engineer' => 'BRYAN BILLY R. GLORI',
                'location' => 'Bacolod City, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 0.00,
                'start_date' => null,
                'expiry_date' => null,
                'target_completion' => null,
                'actual_completion' => 0,
                'physical_accomplishment' => 0.00,
                'financial_accomplishment' => 0.00,
                'latitude' => 10.6765,
                'longitude' => 122.9509,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00007',
                'project_title' => 'BACOLOD NEGROS OCCIDENTAL ECONOMIC HIGHWAY (BANOCEH), STA. 01+586 - STA. 02+585, SILAY CITY, NEGROS OCCIDENTAL',
                'contract_amount' => 90570000.00,
                'contractor' => 'WILKINSON CONSTRUCTION',
                'project_engineer' => 'BRYAN BILLY R. GLORI',
                'location' => 'Silay City, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => 0.00,
                'start_date' => '2026-07-13',
                'expiry_date' => '2027-04-20',
                'target_completion' => '2027-04-20',
                'actual_completion' => 0,
                'physical_accomplishment' => 0.00,
                'financial_accomplishment' => 0.00,
                'latitude' => 10.8000,
                'longitude' => 122.9800,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_id' => '26R00008',
                'project_title' => 'BACOLOD NEGROS OCCIDENTAL ECONOMIC HIGHWAY (BANOCEH), STA. 04+340 - STA. 04+599, EB MAGALONA, NEGROS OCCIDENTAL',
                'contract_amount' => 45353523.38,
                'contractor' => 'CANLAON BUILDERS AND DEVELOPMENT CORPORATION',
                'project_engineer' => 'BRYAN BILLY R. GLORI',
                'location' => 'EB Magalona, Negros Occidental',
                'status' => 'ongoing',
                'slippage' => -3.18,
                'start_date' => '2026-06-10',
                'expiry_date' => '2026-11-18',
                'target_completion' => '2026-11-18',
                'actual_completion' => 0,
                'physical_accomplishment' => 0.70,
                'financial_accomplishment' => 0.00,
                'latitude' => 10.8300,
                'longitude' => 123.0200,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PROJECTS 9-21

            ['project_id' => '26R00009', 'project_title' => 'HIMOGA-AN BR (B00173NR) ALONG BACOLOD NORTH RD (OLD ROUTE)', 'contract_amount' => 119754801.00, 'contractor' => null, 'project_engineer' => 'JASON O. GALOY', 'location' => 'Himoga-an, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.8700, 'longitude' => 123.0300, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00010', 'project_title' => 'CONSTRUCTION OF MULTI-PURPOSE FACILITY, 303 BDE HQS, MURCIA, NEGROS OCCIDENTAL', 'contract_amount' => 26850000.00, 'contractor' => null, 'project_engineer' => 'JAYVEE O. MANSIBANG', 'location' => 'Murcia, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.6060, 'longitude' => 123.0300, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00011', 'project_title' => 'ALICANTE BR (B00374NR) ALONG JCT BAGONAWA-LA CASTELLANA-ISABELA RD', 'contract_amount' => 61509658.00, 'contractor' => null, 'project_engineer' => 'JAYVEE O. MANSIBANG', 'location' => 'La Castellana, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.3200, 'longitude' => 123.0200, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00012', 'project_title' => 'BINALBAGAN (BAGACAY) BR. (B00379NR) ALONG HINIGARAN-ISABELA RD', 'contract_amount' => 61509658.00, 'contractor' => null, 'project_engineer' => 'JAYVEE O. MANSIBANG', 'location' => 'Binalbagan, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.1900, 'longitude' => 122.8600, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00013', 'project_title' => 'BINALBAGAN PARALLEL BR. (B00546NR) ALONG BACOLOD SOUTH RD', 'contract_amount' => 19379297.00, 'contractor' => null, 'project_engineer' => 'REYNALDO C. FERNANDEZ', 'location' => 'Binalbagan, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.1900, 'longitude' => 122.8500, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00014', 'project_title' => 'ORGANIZATIONAL OUTCOME 1: ENSURE SAFE AND RELIABLE NATIONAL ROAD SYSTEM - ASSET PRESERVATION PROGRAM - PREVENTIVE MAINTENANCE - TERTIARY ROADS: DANCALAN - CANDONI - DAMUTAN VALLEY RD - K0113+408 - K0122+000', 'contract_amount' => 164860788.20, 'contractor' => 'HOMEWORLD CONSTRUCTION CORPORATION', 'project_engineer' => 'REYNALDO C. FERNANDEZ', 'location' => 'Dancalan-Candoni-Damutan Valley Road, Negros Occidental', 'status' => 'ongoing', 'slippage' => 3.47, 'start_date' => '2026-06-11', 'expiry_date' => '2026-11-24', 'target_completion' => '2026-11-24', 'actual_completion' => 0, 'physical_accomplishment' => 28.10, 'financial_accomplishment' => 3.47, 'latitude' => 9.8500, 'longitude' => 122.6400, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00015', 'project_title' => 'ORGANIZATIONAL OUTCOME 1: ENSURE SAFE AND RELIABLE NATIONAL ROAD SYSTEM - ASSET PRESERVATION PROGRAM - PREVENTIVE MAINTENANCE - TERTIARY ROADS: DANCALAN - CANDONI - DAMUTAN VALLEY RD - K0122+000 - K0129+721', 'contract_amount' => 143595737.10, 'contractor' => 'HOMEWORLD CONSTRUCTION CORPORATION', 'project_engineer' => 'REYNALDO C. FERNANDEZ', 'location' => 'Candoni, Negros Occidental', 'status' => 'ongoing', 'slippage' => 4.12, 'start_date' => '2026-06-11', 'expiry_date' => '2026-11-24', 'target_completion' => '2026-11-24', 'actual_completion' => 0, 'physical_accomplishment' => 28.20, 'financial_accomplishment' => 4.12, 'latitude' => 9.8500, 'longitude' => 122.6000, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00016', 'project_title' => 'CONVERGENCE AND SPECIAL SUPPORT PROGRAM: SPECIAL ROAD FUND - MOTOR VEHICLE USER CHARGE (MVUC) AS PER R.A. 11239: INSTALLATION/APPLICATION OF ROAD SAFETY FACILITIES (ROADWAY LIGHTING) ALONG BACOLOD SOUTH RD (KABANKALAN-HINOBA-AN SECTION) - K0105+684 - K0111+100', 'contract_amount' => 87028480.06, 'contractor' => 'KAEL CONSTRUCTION AND SUPPLY', 'project_engineer' => 'RAYMUND R. ASTILLA', 'location' => 'Kabankalan-Hinoba-an Road, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.42, 'start_date' => '2026-06-23', 'expiry_date' => '2026-11-06', 'target_completion' => '2026-11-06', 'actual_completion' => 0, 'physical_accomplishment' => 3.28, 'financial_accomplishment' => 0.42, 'latitude' => 9.9800, 'longitude' => 122.8200, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00017', 'project_title' => 'INSTALLATION/APPLICATION OF ROAD SAFETY FACILITIES (ROADWAY LIGHTING) ALONG BACOLOD SOUTH RD (KABANKALAN-HINOBA-AN SECTION) - K0111+489 - K0111+1870', 'contract_amount' => 22079350.00, 'contractor' => 'ABELARDE BUILDERS AND SUPPLY', 'project_engineer' => 'RAYMUND R. ASTILLA', 'location' => 'Kabankalan-Hinoba-an Road, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => '2026-07-01', 'expiry_date' => '2026-09-22', 'target_completion' => '2026-09-22', 'actual_completion' => 0, 'physical_accomplishment' => 5.34, 'financial_accomplishment' => 0.00, 'latitude' => 9.9000, 'longitude' => 122.7600, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00018', 'project_title' => 'INSTALLATION/APPLICATION OF ROAD SAFETY FACILITIES (ROADWAY LIGHTING) ALONG BACOLOD SOUTH RD (KABANKALAN-HINOBA-AN SECTION) - K0122+999 - K0125+010', 'contract_amount' => 32073495.00, 'contractor' => null, 'project_engineer' => 'RAYMUND R. ASTILLA', 'location' => 'Hinoba-an, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 9.6000, 'longitude' => 122.4500, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00019', 'project_title' => 'CONSTRUCTION OF CIRCUMFERENTIAL ROAD, STA. 6+840 - STA. 8+555, BARANGAY CUBAY, BARANGAY BATUAN AND BARANGAY III, LA CARLOTA CITY, NEGROS OCCIDENTAL', 'contract_amount' => 177380000.00, 'contractor' => 'M.K.U. CONSTRUCTION AND SUPPLY', 'project_engineer' => 'BRYAN BILLY R. GLORI', 'location' => 'La Carlota City, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.4230, 'longitude' => 122.9200, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00020', 'project_title' => 'JCT DS BENEDICTO-SPUR 16-CALATRAVA RD - K0054+131 - K0056+015, K0056+024 - K0057+172, K0057+184 - K0059+111', 'contract_amount' => 103589514.00, 'contractor' => 'HOMEWORLD CONSTRUCTION CORPORATION', 'project_engineer' => 'JASON O. GALOY', 'location' => 'Don Salvador Benedicto-Calatrava Road, Negros Occidental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => '2026-06-08', 'expiry_date' => '2026-11-08', 'target_completion' => '2026-11-08', 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 10.5800, 'longitude' => 123.2200, 'created_at' => now(), 'updated_at' => now()],

            ['project_id' => '26R00021', 'project_title' => 'CONSTRUCTION OF DPWH NEGROS ISLAND REGION (NIR) REGIONAL OFFICE BUILDING (PHASE 2), AMLAN, NEGROS ORIENTAL', 'contract_amount' => 134250000.00, 'contractor' => null, 'project_engineer' => 'JASON O. GALOY', 'location' => 'Amlan, Negros Oriental', 'status' => 'ongoing', 'slippage' => 0.00, 'start_date' => null, 'expiry_date' => null, 'target_completion' => null, 'actual_completion' => 0, 'physical_accomplishment' => 0.00, 'financial_accomplishment' => 0.00, 'latitude' => 9.4600, 'longitude' => 123.2200, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}