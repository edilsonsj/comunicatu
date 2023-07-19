{{-- <!DOCTYPE html>
<html>
<head>
    <title>Delimitando Catu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <style>
        #map {
            height: 800px;
        }
    </style>
</head>
<body>
    <h1>Delimitando Catu</h1>
    <div id="map"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-12.3519, -38.3792], 12);

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
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <!-- Inclua os arquivos CSS e JS do Leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
</head>
<body>
    <div id="map" style="height: 800px;"></div>

    <script>
        // Crie um mapa Leaflet e defina a visualização inicial
        var map = L.map('map').setView([0, 0], 2);

        // Adicione um layer de mapa (opcional)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Acesse o objeto GeoJSON passado pelo controlador
        var geojson = {!! $geojson !!};

        // Adicione os marcadores ao mapa
        L.geoJSON(geojson, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng);
            },
            onEachFeature: function (feature, layer) {
                if (feature.properties && feature.properties.name && feature.properties.description) {
                    layer.bindPopup('<b>' + feature.properties.name + '</b><br>' + feature.properties.description);
                }
            }
        }).addTo(map);
    </script>
</body>
</html>


