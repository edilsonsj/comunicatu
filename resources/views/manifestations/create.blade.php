@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

    <div class="container">

        <h1>fazer manifestacao</h1>

        <form action="/manifestations" method="post" enctype="multipart/form-data">
            @csrf
            <label for="type">Selecione o tipo de manifestação</label>
            <select name="type" id="" required>
                <option value="">escolha aqui</option>
                @foreach ($assignments as $assignment)
                    <option value="{{ $assignment }}">{{ $assignment }}</option>
                @endforeach
            </select>
            <br>
            <br>
            <label for="description">Descrição</label>
            <br>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Escreva aqui sua descricao"
                required></textarea>
            <br>
            <br>
            <label for="image">Selecione a imagem</label>
            <input type="file" name="image" id="">

            <!-- Removendo os campos de input lat e lng -->
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">

            <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

            <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>

            <script>
                const map = L.map('map').setView([-12.354791203644778, -38.389331635747624], 15);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                let tempMarker = null;

                function onMapClick(e) {
                    // Removendo o marcador temporário anterior, se existir
                    if (tempMarker) {
                        map.removeLayer(tempMarker);
                    }

                    // Adicionando um novo marcador na localização clicada pelo usuário
                    tempMarker = L.marker(e.latlng).addTo(map);

                    // Atualizando os valores dos campos de lat e lng
                    document.getElementById('lat').value = e.latlng.lat;
                    document.getElementById('lng').value = e.latlng.lng;
                }

                map.on('click', onMapClick);
            </script>

            <input id="submit-button" type="submit" value="Fazer manifestacao">
        </form>

    </div>
@endsection
