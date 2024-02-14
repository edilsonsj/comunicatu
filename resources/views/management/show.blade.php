@extends('layouts.main')

@section('content')
    @if (session('msg'))
        <p>{{ session('msg') }}</p>
    @endif

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>

    <div class="container">
        <div id="map" class="map-container">
            <script>
                var manifestations = @json($manifestations);

                const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 15);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                manifestations.forEach(function(coord) {
                    L.marker([coord.lat, coord.lon]).addTo(map)
                        .bindPopup(coord.type, coord.status).openPopup();
                });
            </script>
        </div>

        <div class="manifestation-types-container">
            @foreach ($manifestations_types as $type)
                <span class="manifestation-type-button">
                    <button>
                        <a id="type-button" href="{{ route('management.type', ['type' => $type]) }}">
                            {{ $type }}
                        </a>
                    </button>
                </span>
            @endforeach
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
            @foreach ($manifestations as $manifestation)
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
@endsection
