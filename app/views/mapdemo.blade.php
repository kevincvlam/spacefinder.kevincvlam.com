<!DOCTYPE html>
<html>

<head>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://davidlynch.org/projects/maphilight/jquery.maphilight.js"></script>
	<script type="text/javascript">
	$(function() {
	$('img[usemap]').maphilight();
	});
	</script>
</head>
	<!--data-maphilight codes for different alert boxes
	<!--Green: {"fillColor":"5DFC0A", "alwaysOn":"true", "fillOpacity" = 0.7"} -->
	<!--Blue: {"fillColor":"1874CD", "alwaysOn":"true", "fillOpacity" = 0.6"} -->
	<!--Red: {"fillColor":"ff0000", "alwaysOn":"true", "fillOpacity" = 0.5"} -->
	<!--Orange: {"fillColor":"FF6103", "alwaysOn":"true", "fillOpacity" = 0.7"} -->
	

<?php
    // Run Some PHP To get busyness of each quadrant.
    include '/home7/kevincvl/public_html/spacefinder/library/findBusyness.php';
   
   $q1 = findBusynessIndex("Robarts Library", "13", 1); 
   $q2 = findBusynessIndex("Robarts Library", "13", 2); 
   $q3 = findBusynessIndex("Robarts Library", "13", 3); 
   $q4 = findBusynessIndex("Robarts Library", "13", 4);

   function echoColour($index){
        if ($index > CROWDED_THRESHOLD){
               echo "fillColor':'ff0000', 'alwaysOn':'true', 'fillOpacity' ='0.5";
               return 0;
        }elseif ($index > BUSY_THRESHOLD
        && $index <= CROWDED_THRESHOLD){
               echo "fillColor':'ff0000', 'alwaysOn':'true', 'fillOpacity' ='0.5";
               return 0;
        }elseif ($index > HASSPACE_THRESHOLD
        && $index <=  BUSY_THRESHOLD){
               echo "fillColor':'FF6103', 'alwaysOn':'true', 'fillOpacity' ='0.7";
               return 0;
        }elseif ($index > EMPTY_THRESHOLD 
        && $index <= HASSPACE_THRESHOLD){
               echo "fillColor':'5DFC0A', 'alwaysOn':'true', 'fillOpacity' ='0.7";
               return 0;
        }else{
            echo "fillColor':'1874CD', 'alwaysOn':'true', 'fillOpacity' ='0.6";
            return 0;
        }
   }
?>

	<img id="library" src="<?php echo asset('static/006-_13th-AP-positions-page1.jpg')?>" alt = "Robarts Floor Map" width="2550" height ="3300" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="91,463, 900,463, 897,817, 801,989, 491,1177, 91,463" data-maphilight='{'<?php echoColour($q1);?>'}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="1627,451, 2453,461, 2151,1055, 1745,977, 1651,821, 1627,451" data-maphilight='{'<?php echoColour($q2);?>'}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="775,1657, 1771,1667, 1271,2511, 775,1657" data-maphilight='{'<?php echoColour($q3);?>'}'/>
		<area shape="poly" title="Quadrant4" href="#4" alt="Quadrant4" coords="1135,887, 1403,891, 1551,1179, 1425,1381, 1109,1391, 977,1165, 1135,887" data-maphilight='{'<?php echoColour($q4);?>'}'/>
	</map>

</body>
</html>
