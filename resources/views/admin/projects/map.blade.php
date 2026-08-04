@extends('layouts.admin')

@section('title', 'Project Map')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">
            <i class="bi bi-geo-alt-fill me-2"></i>
            DPWH Project Map
        </h3>
    </div>

    <div class="card-body p-0">
        <div id="map" style="height: 700px; width: 100%;"></div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([10.35, 123.05], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Red dot icon
    const redIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `
            <div style="
                background-color:#dc3545;
                width:16px;
                height:16px;
                border-radius:50%;
                border:3px solid white;
                box-shadow:0 0 6px rgba(0,0,0,0.4);
            "></div>
        `,
        iconSize: [16, 16],
        iconAnchor: [8, 8]
    });

    const projects = [
        {id:'26R00001', title:'Himamaylan City - Negros Oriental Boundary - Tayasan Road', lat:9.95, lng:122.78, contractor:'HLJ CONSTRUCTION & ENTERPRISES', pe:'J. MANSIBANG', amount:'₱46,810,000.00', accomplishment:'3.69%', slippage:'2.47%'},
        {id:'26R00002', title:'Candoni-Gatuslao-Basay Boundary Road', lat:9.82, lng:122.61, contractor:'HLJ CONSTRUCTION & ENTERPRISES', pe:'R. FERNANDEZ', amount:'₱93,620,000.00', accomplishment:'4.50%', slippage:'2.50%'},
        {id:'26R00003', title:'Bacolod-Murcia-DS Benedicto-San Carlos City Road', lat:10.55, lng:123.02, contractor:'SILVER DRAGON CONSTRUCTION', pe:'C. TINAYA', amount:'₱65,221,550.00', accomplishment:'1.78%', slippage:'1.78%'},
        {id:'26R00004', title:'Road leading to New Development Area, Don Salvador Benedicto', lat:10.53, lng:123.01, contractor:'R.A.G. CORONA CONSTRUCTION', pe:'C. TINAYA', amount:'₱18,140,618.35', accomplishment:'3.13%', slippage:'-5.27%'},
        {id:'26R00005', title:'Barangay II to Barangay V Road, San Carlos City', lat:10.48, lng:123.42, contractor:'R.A.G. CORONA CONSTRUCTION', pe:'C. TINAYA', amount:'₱27,211,346.80', accomplishment:'10.82%', slippage:'0.22%'},
        {id:'26R00006', title:'BANOCEH Section 2 Segment 2, Bacolod City', lat:10.67, lng:122.95, contractor:'M.K.U. CONSTRUCTION AND SUPPLY', pe:'B. GLORI', amount:'₱135,750,000.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00007', title:'BANOCEH, Silay City', lat:10.80, lng:122.97, contractor:'WILKINSON CONSTRUCTION', pe:'B. GLORI', amount:'₱90,570,000.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00008', title:'BANOCEH, EB Magalona', lat:10.88, lng:122.97, contractor:'CANLAON BUILDERS AND DEVELOPMENT CORPORATION', pe:'B. GLORI', amount:'₱45,353,523.38', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00009', title:'Himoga-an Bridge along Bacolod North Rd', lat:10.72, lng:122.99, contractor:'N/A', pe:'J. GALOY', amount:'₱119,754,801.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00010', title:'Multi-Purpose Facility, 303 BDE HQS, Murcia', lat:10.61, lng:123.04, contractor:'N/A', pe:'J. MANSIBANG', amount:'₱26,850,000.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00011', title:'Alicante Bridge along Jct Bagonawa-La Castellana-Isabela Rd', lat:10.33, lng:122.92, contractor:'N/A', pe:'J. MANSIBANG', amount:'₱61,509,658.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00012', title:'Binalbagan (Bagacay) Bridge along Hinigaran-Isabela Rd', lat:10.19, lng:122.86, contractor:'N/A', pe:'J. MANSIBANG', amount:'₱61,509,658.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00013', title:'Binalbagan Parallel Bridge along Bacolod South Rd', lat:10.19, lng:122.86, contractor:'N/A', pe:'R. FERNANDEZ', amount:'₱19,379,297.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00014', title:'Dancalan - Candoni - Damutan Valley Rd (K0113+408 - K0122+000)', lat:9.83, lng:122.63, contractor:'HOMEWORLD CONSTRUCTION CORPORATION', pe:'R. FERNANDEZ', amount:'₱164,860,788.20', accomplishment:'28.10%', slippage:'3.47%'},
        {id:'26R00015', title:'Dancalan - Candoni - Damutan Valley Rd (K0122+000 - K0129+721)', lat:9.80, lng:122.60, contractor:'HOMEWORLD CONSTRUCTION CORPORATION', pe:'R. FERNANDEZ', amount:'₱143,595,737.10', accomplishment:'28.20%', slippage:'4.12%'},
        {id:'26R00016', title:'Roadway Lighting along Bacolod South Rd (Kabankalan-Hinobaan)', lat:9.98, lng:122.82, contractor:'KAEL CONSTRUCTION AND SUPPLY', pe:'R. ASTILLA', amount:'₱87,028,480.06', accomplishment:'3.28%', slippage:'0.42%'},
        {id:'26R00017', title:'Roadway Lighting along Bacolod South Rd (Kabankalan-Hinobaan)', lat:9.93, lng:122.74, contractor:'ABELARDE BUILDERS AND SUPPLY', pe:'R. ASTILLA', amount:'₱22,079,350.00', accomplishment:'5.34%', slippage:'0.00%'},
        {id:'26R00018', title:'Roadway Lighting along Bacolod South Rd (Kabankalan-Hinobaan)', lat:9.90, lng:122.70, contractor:'N/A', pe:'R. ASTILLA', amount:'₱32,073,495.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00019', title:'Circumferential Road, La Carlota City', lat:10.42, lng:122.92, contractor:'M.K.U. CONSTRUCTION AND SUPPLY', pe:'B. GLORI', amount:'₱177,380,000.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00020', title:'Jct DS Benedicto-Spur 16-Calatrava Road', lat:10.60, lng:123.48, contractor:'HOMEWORLD CONSTRUCTION CORPORATION', pe:'J. GALOY', amount:'₱103,589,514.00', accomplishment:'N/A', slippage:'N/A'},
        {id:'26R00021', title:'DPWH NIR Regional Office Building (Phase 2), Amlan, Negros Oriental', lat:9.43, lng:123.22, contractor:'N/A', pe:'J. GALOY', amount:'₱134,250,000.00', accomplishment:'N/A', slippage:'N/A'}
    ];

    // Add markers
    projects.forEach(project => {
        L.marker([project.lat, project.lng], { icon: redIcon })
            .addTo(map)
            .bindPopup(`
                <div style="min-width:260px;">
                    <h6 style="margin-bottom:8px;color:#0d6efd;font-weight:bold;">
                        ${project.id}
                    </h6>

                    <strong>Project:</strong><br>
                    ${project.title}<br><br>

                    <strong>Contractor:</strong><br>
                    ${project.contractor}<br><br>

                    <strong>Project Engineer:</strong> ${project.pe}<br>
                    <strong>Contract Amount:</strong> ${project.amount}<br>
                    <strong>Physical Accomplishment:</strong> ${project.accomplishment}<br>
                    <strong>Slippage:</strong> ${project.slippage}
                </div>
            `);
    });

    // Fit all markers on screen
    const bounds = L.latLngBounds(projects.map(p => [p.lat, p.lng]));
    map.fitBounds(bounds, { padding: [40, 40] });
</script>

@endsection