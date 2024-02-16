@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

    <h1>Editar Manifestação</h1>

    <form action="/management/update/{{ $manifestation->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br>
        <br>
        <h2>Descrição</h2>
        <p>{{ $manifestation->description }}</p>
        <br>
        <img style="height: 100px;" src="/img/manifestations/{{ $manifestation->image }}" alt="">
        
        <br>
        
        <label for="type">Selecione o tipo de manifestação</label>
        <select name="type" id="">
            <option value="{{ $manifestation->type }}">{{ $manifestation->type }}</option>
            @foreach ($assignments as $assignment)
                <option value="{{ $assignment }}">{{ $assignment }}</option>
            @endforeach
        </select>
        
        <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
        <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>
        
        
        
        <div id="map" style="height:400px; width: 800px;" class="my-3">
            <script>
                const map = L.map('map').setView([{{ $manifestation->lat }}, {{ $manifestation->lon }}], 16);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                const marker = L.marker([{{ $manifestation->lat }}, {{ $manifestation->lon }}]).addTo(map);
            </script>


        </div>

        </div>
        <input id="submit-button" type="submit" value="Salvar Alterações">
    </form>

@endsection
