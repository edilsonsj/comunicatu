@extends('layouts.main')

@section('title', 'Fazer Manifestação')

@section('content')

<h1>fazer manifestacao</h1>

<form action="/manifestations" method="post" enctype="multipart/form-data">
    @csrf
    <label for="type">Selecione o tipo de manifestação</label>
    <select name="type" id="">
        <option value="null">escolha aqui</option>
        @foreach ($assignments as $assignment)
            <option value="{{$assignment}}">{{$assignment}}</option>
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

<div id="map" style="height:400px; width: 800px;" class="my-3"></div>

<script>
    let map;
    let latInput = document.getElementById("lat");
    let lngInput = document.getElementById("lng");

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -12.3643595, lng: -38.3829963 },
            zoom: 13,
            scrollwheel: true,
        });

        const uluru = { lat: -12.3643595, lng: -38.3829963 };
        let marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'position_changed',
            function () {
                let lat = marker.getPosition().lat();
                let lng = marker.getPosition().lng();
                latInput.value = lat;
                lngInput.value = lng;
            });

        google.maps.event.addListener(map, 'click',
            function (event) {
                marker.setPosition(event.latLng);
            });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"
        type="text/javascript"></script>
</div>
    <input type="submit" value="Fazer manifestacao">
</form>
    
@endsection
