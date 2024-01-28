@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

    <h1>fazer manifestacao</h1>

    <form action="/manifestations" method="post" enctype="multipart/form-data">
        @csrf
        <label for="type">Selecione o tipo de manifestação</label>
        <select name="type" id="">
            <option value="xpto">escolha aqui</option>
            @foreach ($assignments as $assignment)
                <option value="{{ $assignment }}">{{ $assignment }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <label for="description">Descrição</label>
        <br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Escreva aqui sua descricao"></textarea>
        <br>
        <br>
        <label for="image">Selecione a imagem</label>
        <input type="file" name="image" id="">

        <br>
        <div class="col-5">
            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
        </div>
        <div class="col-5">
            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
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



        </div>
        <input type="submit" value="Fazer manifestacao">
    </form>

@endsection
