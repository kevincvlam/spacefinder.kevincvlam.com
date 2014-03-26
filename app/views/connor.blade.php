@extends('layout') 

@section('content')

<?php
	include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

	echo "Robarts Library: " . busynessIndex('Robarts Library') . "<br>";
	echo "1st floor: " . busynessIndex('Robarts Library', 1) . "<br>";
	echo "1st floor 0th area: " . busynessIndex('Robarts Library', 1, 0) . "<br>";
	echo "2nd floor: " . busynessIndex('Robarts Library', 2) . "<br>";
	echo "2nd floor 0th area: " . busynessIndex('Robarts Library', 2, 0) . "<br>";
	

?>


@stop
