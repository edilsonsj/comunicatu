@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

    <div class="container">

        <h1>Cadastre sua manifestação</h1>

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
            <br>
            <!-- Removendo os campos de input lat e lng -->
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <br>
            <h3>Selecione no mapa o local: </h3>
            <div id="map" style="height:400px; max-width: 800px;" class="my-3"></div>

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

                    // Centrando o mapa na posição do marcador
                    map.setView(e.latlng);
                }

                map.on('click', onMapClick);

                // Função para obter a localização do usuário
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        document.getElementById("demo").innerHTML =
                            "Geolocalização não é suportada pelo seu navegador.";
                    }
                }

                // Função para mostrar a posição do usuário
                function showPosition(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Atualiza os campos de lat e lng no formulário
                    document.getElementById("lat").value = latitude;
                    document.getElementById("lng").value = longitude;

                    // Adiciona um marcador no mapa com a localização do usuário
                    if (tempMarker) {
                        map.removeLayer(tempMarker);
                    }
                    tempMarker = L.marker([latitude, longitude]).addTo(map);

                    // Centra o mapa na posição do marcador
                    map.setView([latitude, longitude]);
                }
            </script>

            <!-- Botão para obter a localização -->
            <button type="button" onclick="getLocation()">Usar meu local</button>

            <!-- Elemento para exibir a mensagem de erro -->
            <p id="demo"></p>

            <br>

            <input id="submit-button" type="submit" value="Fazer manifestacao">
        </form>

    </div>
@endsection
