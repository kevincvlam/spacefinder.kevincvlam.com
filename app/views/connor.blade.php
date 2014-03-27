@extends('layout') 

@section('content')

<?php
	include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

	echo "Robarts Library: " . busynessIndex('Robarts Library') . "<br>";
	echo "1st floor: " . busynessIndex('Robarts Library', 1) . "<br>";
	echo "1st floor 1st area: " . busynessIndex('Robarts Library', 1, 1) . "<br>";
	echo "2nd floor: " . busynessIndex('Robarts Library', 2) . "<br>";
	echo "2nd floor 1st area: " . busynessIndex('Robarts Library', 2, 1) . "<br>";
	$q = busynessIndex('Robarts Library', 2, 1)
	echoColour($q);
	

?>


@stop
