<?php
// Define a few constants that are reused
define('EMPTY_THRESHOLD', '15');
define('HASSPACE_THRESHOLD', '30');
define('BUSY_THRESHOLD', '70');
define('CROWDED_THRESHOLD', '90');


//This function will be called by external html ie front end UI
//expects three values to be a string or null if not specified
// $building:	string representing the building
// $floor:		floor of the above building
// $area:		area of the above floor
include 'spaceFunctions.php';		//include
function findBusyness ($building, $floor, $area){
	
	
	if (!$building) echo "Error: No Building Indicated <br>";
	
	//connect to the SpaceFinder database
	$con = connectToDB();
	
	if ($con->errno) return 2;			//return 2 if connection failed
	
	//get values from SpaceFinder database
	$currPop = getPopulation($building, $floor, $area, $con);
	$maxPop = getMaxPop($building, $floor, $area, $con);
    $minPop = getMinPop($building, $floor, $area, $con);

    // Normalize by $minPop
    $currPop = $currPop - $minPop;
    $maxPop = $maxPop - $minPop;
	
	//calculate busyness index
	if ($maxPop) { 
	$busyness = $currPop / $maxPop *100;	
	} else {
	echo "Error: Max Population is zero";
	return 0;
	}
	
	// echo "<br> busyness is : " . $busyness . "<br>";  //display busyness for testing
	
	if ($busyness > CROWDED_THRESHOLD){
		   echo "Very Crowded";
		   return 0;
	}elseif ($busyness > BUSY_THRESHOLD
    && $busyness <= CROWDED_THRESHOLD){
		   echo "Crowded";
		   return 0;
	}elseif ($busyness > HASSPACE_THRESHOLD
    && $busyness <=  BUSY_THRESHOLD){
		   echo "Busy";
		   return 0;
	}elseif ($busyness > EMPTY_THRESHOLD 
    && $busyness <= HASSPACE_THRESHOLD){
		   echo "Has Space";
		   return 0;
	}else{
		echo "Empty";
		return 0;
	}
	
	if ($con) $con->close;

return 1;		//return 1 if the case statement did not work
}

function findBusynessTag ($building, $floor, $area){
	
	
	if (!$building) echo "Error: No Building Indicated <br>";
	
	//connect to the SpaceFinder database
	$con = connectToDB();
	
	if ($con->errno) return 2;			//return 2 if connection failed
	
	//get values from SpaceFinder database
	$currPop = getPopulation($building, $floor, $area, $con);
	$maxPop = getMaxPop($building, $floor, $area, $con);
    $minPop = getMinPop($building, $floor, $area, $con);

    // Normalize by $minPop
    $currPop = $currPop - $minPop;
    $maxPop = $maxPop - $minPop;

	//calculate busyness index
	if ($maxPop) { 
	$busyness = $currPop / $maxPop *100;	
	} else {
	echo "Error: Max Population is zero";
	return 0;
	}
	
	// echo "<br> busyness is : " . $busyness . "<br>";  //display busyness for testing
	
	if ($busyness > CROWDED_THRESHOLD){
		   echo "alert";
		   return 0;
	}elseif ($busyness > BUSY_THRESHOLD
    && $busyness <= CROWDED_THRESHOLD){
		   echo "alert";
		   return 0;
	}elseif ($busyness > HASSPACE_THRESHOLD
    && $busyness <=  BUSY_THRESHOLD){
		   echo "warning";
		   return 0;
	}elseif ($busyness > EMPTY_THRESHOLD 
    && $busyness <= HASSPACE_THRESHOLD){
		   echo "success";
		   return 0;
	}else{
		echo "info";
		return 0;
	}
	
	if ($con) $con->close;

return 1;		//return 1 if the case statement did not work
}
?>
