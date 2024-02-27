@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

    <h1>Editar Manifestação</h1>

    <form action="/manifestations/update/{{$manifestation->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="type">Selecione o tipo de manifestação</label>
        <select name="type" id="">
            <option value="{{ $manifestation->type }}">{{ $manifestation->type }}</option>
            @foreach ($assignments as $assignment)
                <option value="{{ $assignment }}">{{ $assignment }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <label for="description">Descrição</label>
        <br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Escreva aqui sua descricao">{{ $manifestation->description }}</textarea>
        <br>
        <br>
        <img style="height: 100px;" src="/img/manifestations/{{ $manifestation->image }}" alt="">
        <label for="image">Selecione a imagem</label>
        <input type="file" name="image" id="">

        <br>
        <div class="col-5">
            <input type="text" class="form-control" placeholder="lat: {{$manifestation->lat}}" name="lat" id="lat" value="{{$manifestation->lat}}">
        </div>
        <div class="col-5">
            <input type="text" class="form-control" placeholder="lng: {{$manifestation->lon}}" name="lon" id="lng" value="{{$manifestation->lon}}">
        </div>
        </div>

        <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
        <script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>



        <div id="map" style="height:400px; width: 800px;" class="my-3">
            <script>
                const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 15);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);


                const popup = L.popup()
                    .setLatLng([{{ $manifestation->lat }}, {{ $manifestation->lon }}]);

                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent(`You clicked the map at ${e.latlng.toString()}`)
                        .openOn(map);
                }

                const marker = L.marker([{{$manifestation->lat}}, {{$manifestation->lon}}]).addTo(map);


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



        </div>
        <input type="submit" value="Salvar Alterações">
    </form>

@endsection
