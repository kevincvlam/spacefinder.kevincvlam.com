@extends('layout')

@section('content')

<h1> Active Connections in Robarts on given floor </h1>

<?php
/*
$spaceFunction = asset('static/spaceFunctions.php');
echo $spaceFunction;
*/

include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

$con = connectToDB();

echo "<table border='1'>
<tr>
<th>Floor Number</th>
<th> Current Population</th>
<th> Max Population</th>
<th> Min Population</th>
<th> Busyness Index </th>
</tr>";

for ($i = 1; $i < 15; $i++){
$number = getPopulation('Robarts Library', $i, 0, $con);
$min = getMinPop('Robarts Library', $i,0,$con);
$max = getMaxPop('Robarts Library', $i,0,$con);
echo "<tr>
		<td> $i </td>
		<td> " . (string) $number . "</td>
		<td> " . (string) $max . "</td>
		<td> " . (string) $min . "</td>
		<td> " . (string) (100*($number-$min)/($max-$min)) . "</td>
	  </tr>";
} echo "</table>";

$con->close();
?>

<br><br>


@stop
