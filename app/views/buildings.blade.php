@extends('layout')


@section('content')
    <h2>Buildings Table</h2>
    @foreach($buildings as $building)
        <p>{{ $building->apn }}</p>
        @foreach($population in $populations)
            @if( $building->apn == $population->apn )
                --- <i>{{ $population-->activeconn }}</i>
                --- {{ $popluation-->timestamp }}<br>
        @endforeach

    @endforeach
@stop
