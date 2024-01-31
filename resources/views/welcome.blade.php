@extends('layouts.main')

@section('title', 'Comunicatu')
    

@section('content')

<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>


<h1>Visao geralsssssssssss</h1>

<div id="map" style="height: 500px;" class="my-3">

    <script>
        const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 15);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const marker = L.marker([-12.354791203644778, -38.389331635747624]).addTo(map)
            .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

/*                 const circle = L.circle([51.508, -0.11], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup('I am a circle.');

        const polygon = L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(map).bindPopup('I am a polygon.');

*/
        const popup = L.popup()
            .setLatLng([-12.353, -38.39])
            .setContent('I am a standalone popup.')
            .openOn(map);

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(`You clicked the map at ${e.latlng.toString()}`)
                .openOn(map);
        }


        map.on('click', onMapClick);

        map.on('click', function(e) {
            const latInput = document.getElementById('lat');
            const lngInput = document.getElementById('lng');
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;
            latInput.value = lat;
            lngInput.value = lng;
            console.log(lat, lng);
        })
    </script>

</div>



{{-- <script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -12.3643595, lng: -38.3829963 },
            zoom: 13,
            scrollwheel: true,
        });

        @foreach ($manifestations as $manifestation)
            var marker = new google.maps.Marker({
                position: { lat: {{ $manifestation->lat }}, lng: {{ $manifestation->lon }} },
                map: map,
                draggable: false
            });
        @endforeach
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap" type="text/javascript"></script> --}}

@endsection
