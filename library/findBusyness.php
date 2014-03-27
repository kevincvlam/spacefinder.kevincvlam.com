<?php



//This function will be called by external html ie front end UI
//expects three values to be a string or null if not specified
// $building:	string representing the building
// $floor:		floor of the above building
// $area:		area of the above floor
include 'spaceFunctions.php';		//include

function getFloorPrediction($building, $floor, $timeRange){
   	if (!$building) echo "Error: No Building Indicated <br>";
	
	//connect to the SpaceFinder database
	$connect = connectToDB();
	
	if($connect->errno != 0){
		echo "Error with connection passed to function getPopulation";
		exit();
	}
	if (!$timeRange) $timeRange = 3;
	$endTime = 172 - $timeRange;
	/*$query = "(SELECT SUM(activeconn) FROM populations WHERE timestamp = (SELECT MIN(timestamp) FROM populations 
	         WHERE timestamp >= NOW() - INTERVAL 172 HOUR AND timestamp <= NOW() - INTERVAL ". $endTime ." HOUR ) 
			 AND apn IN (SELECT apn FROM buildings";
	if($building) $query = $query . " WHERE bname = '" . $building;			//remember single quotes for sql query
	if($floor) $query = $query . "' AND bfloor = '" . $floor;
	$query = $query . "'))";
	//echo $query." <br>";
	$newQuery = str_replace('MIN', 'MAX', $query);
	$query = $query . " UNION " . $newQuery;
	echo $query." <br>";*/
	
	$query = "(SELECT SUM(activeconn) FROM populations WHERE timestamp IN (SELECT * FROM (((SELECT MIN(timestamp) FROM populations WHERE timestamp >= NOW() - INTERVAL 190 HOUR AND timestamp <= NOW() - INTERVAL 169 HOUR ))
			UNION
			((SELECT MAX(timestamp)  FROM populations WHERE timestamp >= NOW() - INTERVAL 190 HOUR AND timestamp <= NOW() - INTERVAL ". $endTime ." HOUR ))) AS timestamp)
			 AND apn IN (SELECT apn FROM buildings";
	if($building) $query = $query . " WHERE bname = '" . $building;			//remember single quotes for sql query
	if($floor) $query = $query . "' AND bfloor = '" . $floor;
	$query = $query . "') GROUP BY timestamp)";
	//echo $query." <br>";

		
	//call query
	if($result = $connect->query($query)){					//if successful result
		$row = $result->fetch_array();							//return result
		$startPop =(int) $row[0];
		$row = $result->fetch_array();	
		$endPop = (int) $row[0];
		$result->close();
	}
	$slope = 0;
	$message = "";
	if ($endPop) { 
		$slope = ($endPop - $startPop)/ $startPop;	
	} else {
		echo "Error: End Population is zero";
		return 0;
	}
	switch ($slope){
		case $slope > 0.5:
		   $message = "be Much Busier";
		   break;
		case $slope > 0.1 && $slope <=0.5 :
		   $message = "be Slightly Busier";
		   break;
		case $slope >=-0.1 && $slope <=0.1 :
		   $message = "be The Same";
		   break;
		case $slope >= -0.5 && $slope <0.1 :
		   $message = "be Less Busy";
		   break;
		case $slope < -0.5 :
		   $message = "be Much Emptier";
	}
	
	echo "This floor is predicted to " . $message . " in "  . $timeRange ." Hours.<br>";
	
}	
?>
