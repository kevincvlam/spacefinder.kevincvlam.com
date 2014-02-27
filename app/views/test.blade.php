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
</tr>";

for ($i = 1; $i < 15; $i++){
$number = getPopulation('Robarts Library', $i, 0, $con);
echo "<tr>
		<td> $i </td>
		<td> " . (string) $number . "</td>
		<td> " . (string) getMaxPop('Robarts Library',$i,0,$con) . "</td>
		<td> " . (string) getMinPop('Robarts Library',$i,0,$con) . "</td>
	  </tr>";
} echo "</table>";

$con->close();
?>

<br><br>


@stop
