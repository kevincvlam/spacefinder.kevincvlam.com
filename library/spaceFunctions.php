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

//creates an html table of the building floors and their active connections on each floor
function getCurrFloorPop($bname, $con){
echo "<table border='1'>
<tr>
<th>AP name</th>
<th>Current Connection</th>
</tr>";
$result = mysqli_query($con, "SELECT B.bfloor AS floornum, SUM(P.activeconn) AS sum ".
								"FROM populations AS P, buildings AS B WHERE P.apn = B.apn AND B.bname LIKE '". $bname . "'" . " GROUP BY B.bfloor");
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['floornum'] . "</td>";
  echo "<td>" . $row['sum']. "</td>";
  echo "</tr>";
  }
echo "</table>";
}
 
function printResult ($result){
 echo "<table border='1'>
<tr>
<th>Floor number</th>
<th> current pop</th>
</tr>";
 while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['floornum'] . "</td>";
  echo "<td>" . $row['curPop'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
}



//update.php
//this is a php file that updates values in the populations table
//for Robarts Library demo
//NOTE: usually this would be done as a scheduled SQL query on the
//server, but we do not yet have a server and the data that is 
//being given to us is on a webpage rather than in a SQL database
//
//This function is expected to be called from a batch file that will
//be called by the windows scheduler...again this is usually an SQL
//subroutine called by the server task scheduler

function update(){
	//establish and check connection to database spacedb
	$con = connectToDB();
	if($con->errno) return $con->errno;
	
	//ADD NEW INFORMATION TO THE TABLE
	
	//set up a query to get all of the Access Points that we are actively checking
	$query = "SELECT apn FROM buildings";
	$result = $con->query($query);
	
	//get information from webpage
	$livedata = file_get_contents('http://info.wireless.utoronto.ca/rob/');
	/*//test file_get_contents
	echo $livedata;*/
	
	while($apn = $result->fetch_array()){
		//set id to search for
		$id = $apn[0];
		//find position of id in livedata
		$pos = strpos($livedata, $id);
		//parse line; four elements delimted by commas; get positions of commas
		$pos2 = strpos($livedata, ",",$pos);
		$pos3 = strpos($livedata, ",",$pos2+1);
		$pos4 = strpos($livedata, ",",$pos3+1);
		//find the next line break
		$pos_end = strpos($livedata, "<BR>", $pos3);
		
		//parse data (NOTE minus and plus ones account for commas
		$num_conns = (int) substr($livedata, ($pos3+1),($pos4-$pos3-1));
		$timestamp = substr($livedata, ($pos4+1),($pos_end-$pos4-1));
		
		/* //test parsing
		echo $id . "..." . $num_conns . "..." . $timestamp . "<BR>"; */
		
		//write data into database
		$query = "INSERT INTO populations
		VALUES('$id','$num_conns','$timestamp')";
		if(!($con->query($query))){
		echo "<br> insert query error <br>";
		return 1;
		}		
	}
	$result->close();
	
	//DELETE OLD INFORMATION FROM THE TABLE
	$query = "DELETE FROM populations WHERE timestamp < (NOW() - INTERVAL 14 DAY)";
	if(!($con->query($query))){
		echo "<br> delete query error <br>";
		return 1;
	}		
	
	//RETURN 0 NO ERROR
	return 0;
}

function getBusyIndex(){

	$connect = connectToDB();
    $query = "
    SELECT bname, bfloor, (
    SUM( activeconn ) - SUM( bminpop )
    ) / ( SUM( bmaxpop ) - SUM( bminpop ) ) 
    FROM (
    (

    SELECT apn, activeconn, timestamp
    FROM (

    SELECT apn, activeconn, timestamp
    FROM populations
    ORDER BY timestamp desc
    ) AS data
    GROUP BY apn
    ) AS currentData


    INNER JOIN buildings ON currentData.apn = buildings.apn
    )
    WHERE bname =  'Robarts Library'
    GROUP BY bfloor
    ";


	//call query
	if($result = $connect->query($query)){	
		return $result;
		$result->close();
	}
	
    $result->close();
	echo "Something went wrong!";
    return 0;

}

//returns a time series 2D array
function getTimeSeries($hours, $building, $floor, $area, $connect){
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
	$query = $query . "')													//building info subquery
	WHERE populations.timestamp < (NOW()+INTERVAL 2 HOUR)
	AND populations.timestamp > (NOW()-INTERVAL " . $hours . " HOUR + INTERVAL 2 HOUR)"
	$query = $query . ") as relevantVals
	 GROUP BY timestamp							
     ORDER BY timestamp desc";				
	
	//echo $query;   //display query for testing
	
	
	//call query
	if($result = $connect->query($query)){	
		return $result;
		$result->close();
	}
	
    $result->close();
	echo "error in result from query...result was null <br>";					//result was null
	return 0;

}

function printGoogleChartData($hours, $building, $floor, $area, $connect){
    $result = getTimeSeries($hours, $building, $floor, $area, $connect);
    echo "
    var data = google.visualization.arrayToDataTable([
    ['Time', 'Active Connections'],
    ";
    for($i = 0; $i < $result->num_rows; $i++){
        $row = $result->fetch_row();
        $row[1] = substr($row[1], 11);
        if($i != $result->num_rows-1){
                echo "['$row[1]', $row[0]],";
        }
        else{
                echo "['$row[1]', $row[0]]
                ]);
                ";
        }
    }
    return 0;
} 

// Define a few constants that are reused
define('EMPTY_THRESHOLD', '15');
define('HASSPACE_THRESHOLD', '50');
define('BUSY_THRESHOLD', '70');
define('CROWDED_THRESHOLD', '100');

//colour define function for maps
function echoColour($index){
        if ($index > CROWDED_THRESHOLD/100){
           echo "\"fillColor\":\"ff0000\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.5\"";
               return 0;
        }elseif ($index > BUSY_THRESHOLD/100
        && $index <= CROWDED_THRESHOLD/100){
           echo "\"fillColor\":\"ff0000\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.5\"";
               return 0;
        }elseif ($index > HASSPACE_THRESHOLD/100
        && $index <=  BUSY_THRESHOLD/100){
           echo "\"fillColor\":\"FF6103\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
               return 0;
        }elseif ($index > EMPTY_THRESHOLD/100 
        && $index <= HASSPACE_THRESHOLD/100){
           echo "\"fillColor\":\"5DFC0A\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
               return 0;
        }else{
           echo "\"fillColor\":\"1874CD\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
            return 0;
        }
   }

///BELOW IS FUNCTIONS BEING TESTED


//busynessTable Function
//if input is only the building then return a mysqli object of the floor, floor business index, and timestamp
//if input is the building and floor, return a mysqli object with the areas, area index and timestamp

function busynessTable(){
	//initialize connection
	$con = connectToDB();
	if ($con->errno){
		echo "Could not establish connection in busynessTable function <br>";
		return $con->errno;
	}
	//build query base
	$query = "
	SELECT (SUM( conn ) - SUM( min )) / ( SUM( max ) - SUM( min ) )
	FROM (

	SELECT currentPop.activeconn AS conn, b.bminpop AS min, b.bmaxpop AS max, bfloor, barea, bname
	FROM 
	(SELECT * FROM buildings)b
	INNER JOIN 
		(SELECT apn, activeconn
		FROM populations AS p
		WHERE p.timestamp > NOW( ) - INTERVAL 5 
		MINUTE + INTERVAL 2 HOUR
		)currentPop
	ON b.apn = currentPop.apn

	) AS tablet
	WHERE bname = '";
	if (func_num_args() == 1){
		//call sql query for a building ie return floor array
		$building = func_get_arg(0);
		//build query
		$query = $query . $building . "'";
		$query = $query . "
		GROUP BY bfloor";
		
		//submit query
		if ($result = $con->query($query)){ //if good result
			$con->close();
			return $result;
		}
		
		echo "query error in busynessTable function <br>";
		$con->close();
		
		return 0;
	}
	if (func_num_args() == 2){
		//call sql query for a floor ie return area array
		$building = func_get_arg(0);
		$floor = func_get_arg(1);
		//build query
		$query = $query . $building . "'";
		$query = $query . "WHERE bfloor =  ";
		$query = $query . $floor;
		$query = $query . "
		GROUP BY barea";
		
		//submit query
		if ($result = $con->query($query)){ //if good result
			$con->close();
			return $result;
		}
		
		echo "query error in busynessTable function <br>";
		$con->close();
		
		return 0;
	}
		
	echo "Too many or too few arguments to function businessTable <br>";
	return 0;
}

//busynessIndex function
//returns the business of a building, floor of a building, or area of a floor of a building depending
// busynessIndex(building, [floor, [area]])
function busynessIndex(){
	//initialize connection
	$con = connectToDB();
	if ($con->errno){
		echo "Could not establish connection in busynessTable function <br>";
		return $con->errno;
	}
	
	//build query base
	$query = "
		SELECT (SUM( conn ) - SUM( min )) / ( SUM( max ) - SUM( min ) )
		FROM (

		SELECT currentPop.activeconn AS conn, b.bminpop AS min, b.bmaxpop AS max, bfloor, barea, bname
		FROM 
		(SELECT * FROM buildings)b
		INNER JOIN 
			(SELECT apn, activeconn
			FROM populations AS p
			WHERE p.timestamp > NOW( ) - INTERVAL 5 
			MINUTE + INTERVAL 2 HOUR
			)currentPop
		ON b.apn = currentPop.apn

		) AS tablet
		WHERE bname = '";
			
	if (func_num_args() == 1){
		$building = func_get_arg(0);
		//build query
		$query = $query . $building . "'";
				
		//submit query
		if ($result = $con->query($query)){ //if good result
			$con->close();
			$row = $result->fetch_array();
			$result->close();
			return $row[0];
		}
		//query error
		echo "query error in busynessIndex function <br>";
		$con->close();
		
		return 0;
	}
	if (func_num_args() == 2){
		$building = func_get_arg(0);
		$floor = func_get_arg(1);
		//build query
		
		$query = $query . $building . "'";
		$query = $query . " AND bfloor = ";
		$query = $query . $floor;
				
		//submit query
		if ($result = $con->query($query)){ //if good result
			$con->close();
			$row = $result->fetch_array();
			$result->close();
			return $row[0];
		}
		//query error
		echo "query error in busynessIndex function <br>";
		$con->close();
		
		return 0;	
	}
	if (func_num_args() == 3){
		$building = func_get_arg(0);
		$floor = func_get_arg(1);
		$area = func_get_arg(2);
		//build query
		$query = $query . $building. "'";
		$query = $query . " AND bfloor = ";
		$query = $query . $floor;
		$query = $query . " AND barea = ";
		$query = $query . $area;
				
		//submit query
		
		if ($result = $con->query($query)){ //if good result
			$con->close();
			$row = $result->fetch_array();
			$result->close();
			return $row[0];
		}
		//query error
		echo "query error in busynessIndex function <br>";
		$con->close();
		
		return 0;
		}
	
	echo "error with number of arguments to function busynessIndex";
	return 0;
}

?>
