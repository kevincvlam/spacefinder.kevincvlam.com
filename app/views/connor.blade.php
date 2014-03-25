@extends('layout') 

@section('content')

<?php
	include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

	echo "Robarts Library: " . busynessIndex('Robarts Library') . "<br>";
	echo "1st floor: " . busynessIndex('Robarts Library', 1);
	

?>


@stop
