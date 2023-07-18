<!DOCTYPE html>
<html>
<head>
    <title>Delimitando Catu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
    <h1>Delimitando Catu</h1>
    <div id="map"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-12.3519, -38.3792], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        fetch('/catu.json')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data).addTo(map);
            });
    </script>
</body>
</html>
