@extends('layouts.main')


@section('content')
    <p>{{ $manifestation }}</p>
    <div class="container">
        <div class="container-item">
            <h1>Tipo: {{ $manifestation->type }}</h1>
            <p>Feito em: {{ $manifestation->created_at }}</p>
            <p>Status: {{ $manifestation->status }}</p>
            <p>Descrição: {{ $manifestation->description }}</p>
            <img style="max-width: 40vw" src="/img/manifestations/{{ $manifestation->image }}" alt="">
        </div>

        <div id="map" style="height:400px; width: 800px;" class="my-3">
            <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
            <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>
            <script>
                const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 15);
                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                L.marker([{{$manifestation->lat}}, {{$manifestation->lon}}]).addTo(map).bindPopup('aaaaaaaaaaaaa').openPopup();
            </script>
        </div>

    </div>
@endsection
