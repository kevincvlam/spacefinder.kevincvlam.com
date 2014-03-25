
<?php
function connectToDB(){
// Create connection to spacefinder database
$con=mysqli_connect("localhost","kevincvl_sf","spacefinder","kevincvl_spacefinder");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
return $con;
}

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
	$query = "(SELECT SUM(activeconn) FROM populations WHERE timestamp = (SELECT MIN(timestamp) FROM populations 
	         WHERE timestamp >= NOW() - INTERVAL 172 HOUR AND timestamp <= NOW() - INTERVAL ". $endTime ." HOUR ) 
			 AND apn IN (SELECT apn FROM buildings";
	if($building) $query = $query . " WHERE bname = '" . $building;			//remember single quotes for sql query
	if($floor) $query = $query . "' AND bfloor = '" . $floor;
	$query = $query . "'))";
	//echo $query." <br>";
	$newQuery = str_replace('MIN', 'MAX', $query);
	$query = $query . " UNION " . $newQuery;
	#echo $query." <br>";

		
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
		   $message = "get very busy";
		   break;
		case $slope > 0.1 && $slope <=0.5 :
		   $message = "get slightly busier";
		   break;
		case $slope >=-0.1 && $slope <=0.1 :
		   $message = "be the same";
		   break;
		case $slope >= -0.5 && $slope <0.1 :
		   $message = "get less busy";
		   break;
		case $slope < -0.5 :
		   $message = "get close to empty";
	}
	
	echo "Floor " . $floor . " is predicted to " . $message . " in the next " . $timeRange ." hours<br>";
	
	
}

?>
