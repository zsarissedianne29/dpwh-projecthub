@extends('layouts.admin')

@section('title', 'Project Map')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Project Map</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-2">
            <div id="map" style="height: 650px; width: 100%; border-radius: 10px;"></div>
        </div>
    </div>

</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Center Negros Occidental
    const map = L.map('map').setView([10.45, 122.95], 9);

    // OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Red marker icon
    const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Add all projects from database
    @foreach($projects as $project)

        L.marker([{{ $project->latitude }}, {{ $project->longitude }}], { icon: redIcon })
            .addTo(map)
            .bindPopup(`
                <div style="min-width:250px;">
                    <strong>{{ $project->project_id }}</strong><br><br>

                    <strong>Project:</strong><br>
                    {{ $project->project_title }}<br><br>

                    <strong>Engineer:</strong>
                    {{ $project->project_engineer }}<br>

                    <strong>Location:</strong>
                    {{ $project->location }}<br>

                    <strong>Status:</strong>
                    {{ ucfirst($project->status) }}<br>

                    <strong>Physical:</strong>
                    {{ number_format($project->physical_accomplishment, 2) }}%<br>

                    <strong>Financial:</strong>
                    {{ number_format($project->financial_accomplishment, 2) }}%
                </div>
            `);

    @endforeach
</script>
@endsection