@extends('layout')

@section('content')

<?php

// Dump a chunk of data from SQL into a google array format

// For a given floor, output active conns over the past 6 hours

/* The Query
SELECT SUM(activeconn), timestamp FROM
(SELECT apn, activeconn, timestamp
FROM populations
WHERE (apn
IN (

SELECT apn
FROM buildings
WHERE bname =  'Robarts Library'
AND bfloor =  '1'
AND barea =0
) )
) as relevantvals
GROUP BY timestamp
ORDER BY timestamp desc
LIMIT 72
*/ 
include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';

$con = connectToDB();

function getTimeSeriesPrototype($numEntries, $building, $floor, $area, $connect){
	//check for errors on connection
	if($connect->errno != 0){
		echo "Error with connection passed to function getPopulation";
		exit();
	}
	//construct query:
	$query  = "SELECT SUM(activeconn), timestamp FROM	";						//summing query	
	$query = $query . "(SELECT apn, activeconn, timestamp FROM populations		
	WHERE apn IN (SELECT apn FROM buildings";  								//building info subquery
	if($building) $query = $query . " WHERE bname = '" . $building;			//building info subquery
	if($floor) $query = $query . "' AND bfloor = '" . $floor;				//building info subquery
	if($area) $query = $query . "' AND barea = '" . $area;					//building info subquery
	$query = $query . "')";													//building info subquery
	$query = $query . ") as relevantVals
     GROUP BY timestamp
     ORDER BY timestamp desc
     LIMIT " . $numEntries;				
	
	//echo $query;   //display query for testing
	
	
	//call query
	if($result = $connect->query($query)){	
		print_r($result);
		echo "<br><br>";
		while($row = $result->fetch_row()){
		//print_r($row);
        	echo "$row[0] $row[1]<br>";
        }
		return (int) $row[0];
		$result->close();
	}
	
	echo "error in result from query...result was null <br>";					//result was null
	return 0;

}


    $result = getTimeSeries(10, 'Robarts Library', '1', 0, $con);
    while($row = $result->fetch_row()){
        echo "$row[0] $row[1]<br>";
    }
?>
@stop
