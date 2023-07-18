@extends('layouts.main')

@section('title', 'Comunicatu')
    

@section('content')

<h1>Visao geral</h1>

<div id="map" style="height: 900px; width: 100%;" class="my-3"></div>

<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -12.3643595, lng: -38.3829963 },
            zoom: 13,
            scrollwheel: true,
        });

        @foreach ($manifestations as $manifestation)
            var marker = new google.maps.Marker({
                position: { lat: {{ $manifestation->lat }}, lng: {{ $manifestation->lon }} },
                map: map,
                draggable: false
            });
        @endforeach
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap" type="text/javascript"></script>

@endsection
