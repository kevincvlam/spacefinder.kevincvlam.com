@extends('layout')


@section('content')
    <h2>Buildings Table</h2>
    @foreach($buildings as $building)
        <p>{{ $building->apn }}</p>
        @foreach($populations as $population)
            @if( strcmp($building->apn, $population->apn) == 0 )
                --- {{ $population->activeconn }}
                --- {{ $population->timestamp }}<br>
		@break
	    @endif
        @endforeach

    @endforeach
@stop
