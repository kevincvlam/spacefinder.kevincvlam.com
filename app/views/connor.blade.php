@extends('layout') 

@section('content')

<?php
	include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

	echo "Robarts Library: " . businessIndex('Robarts Library') . "<br>";
	echo "1st floor: " . businessIndex('Robarts Library', 1);
	

?>


@stop
