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
        <p>{{session('msg')}}</p>
    @endif

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>



    <div id="map" style="height:400px; width: 800px;" class="my-3">
        <script>
            var user_manifestations = @json($user_manifestations);

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


            user_manifestations.forEach(function(coord) {
                L.marker([coord.lat, coord.lon]).addTo(map)
                .bindPopup(coord.type, coord.status).openPopup();
            });
        </script>


    </div>



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
                    <a href="/manifestations/edit/{{ $manifestation->id }}">Editar</a>
                    <br>
                    <form action="/manifestations/{{$manifestation->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    <p>{{ $user_manifestations }}</p>
@endsection
