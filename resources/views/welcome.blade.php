@extends('layouts.main')

@section('title', 'ComuniCatu')

@section('content')

<h1>index comunicatu</h1>

@foreach ($manifestations as $manifestation)
    <p>{{$manifestation -> lat}}, {{$manifestation -> lat}}</p>
@endforeach
    
@endsection
    