@extends('layouts.main')

@section('content')

    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    </head>

    @if (session('msg'))
        <p>{{ session('msg') }}</p>
    @endif

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>

    <div class="container">

        <div class="container-item map-container">

            <div id="map" style="height:500px; width: 100%" class="my-3"></div>

        </div>
        <div class="container-item">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Departamento</th>
                    <th>Status</th>
                    <th>Data de Criação</th>
                    <th>Ação</th>
                </tr>
                @foreach ($user_manifestations as $manifestation)
                    <tr>
                        <td>{{ $manifestation->id }}</td>
                        <td>{{ $manifestation->type }}</td>
                        <td>{{ $manifestation->description }}</td>
                        <td>{{ $manifestation->department_id }}</td>
                        <td>{{ $manifestation->status }}</td>
                        <td>{{ $manifestation->created_at }}</td>
                        <td>
                            <a id="edit-button" href="/manifestations/edit/{{ $manifestation->id }}">Editar</a>
                            <br>
                            <form action="/manifestations/{{ $manifestation->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input id="delete-button" type="submit" value="Excluir">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script>
        var user_manifestations = @json($user_manifestations);

        const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 14);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        user_manifestations.forEach(function(manifestation) {
            const popupContent = `
            <b>ID:</b> ${manifestation.id}<br>
            <b>Tipo:</b> ${manifestation.type}<br>
            <b>Status:</b> ${manifestation.status}<br>
            <b>Descrição:</b> ${manifestation.description}<br>
            <b>Data de Criação:</b> ${manifestation.created_at}<br>
        `;
            L.marker([manifestation.lat, manifestation.lon]).addTo(map)
                .bindPopup(popupContent);
        });
    </script>
@endsection
