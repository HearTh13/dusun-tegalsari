<!DOCTYPE html>
<html>
<head>
    <title>Rute ke Balai Dusun Tegalsari</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <style>
        body {
            margin: 0;
        }
        #map {
            height: 100vh;
            width: 100%;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background-color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>

<!-- Tombol Back -->
<button class="back-button ms-5" onclick="history.back()">← Kembali</button>

<!-- Map -->
<div id="map"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

<script>
    // Titik lokasi Balai Dusun Tegalsari
    var tujuan = L.latLng(-7.8882644, 110.6854162);

    // Inisialisasi peta dengan fokus ke balai dusun
    var map = L.map('map').setView(tujuan, 17);

    // Tambahkan tile peta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ikon pin lokasi untuk balai dusun
    var pinIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    // Tambahkan marker balai dusun
    L.marker(tujuan, { icon: pinIcon }).addTo(map).bindPopup("Balai Dusun Tegalsari");
</script>

</body>
</html>
