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
   
   $q1 = findBusynessIndex("Robarts Library", "3", 1); 
   $q2 = findBusynessIndex("Robarts Library", "3", 2); 
   $q3 = findBusynessIndex("Robarts Library", "3", 3); 


   function echoColour($index){
        if ($index > CROWDED_THRESHOLD){
           echo "\"fillColor\":\"ff0000\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.5\"";
               return 0;
        }elseif ($index > BUSY_THRESHOLD
        && $index <= CROWDED_THRESHOLD){
           echo "\"fillColor\":\"ff0000\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.5\"";
               return 0;
        }elseif ($index > HASSPACE_THRESHOLD
        && $index <=  BUSY_THRESHOLD){
           echo "\"fillColor\":\"FF6103\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
               return 0;
        }elseif ($index > EMPTY_THRESHOLD 
        && $index <= HASSPACE_THRESHOLD){
           echo "\"fillColor\":\"5DFC0A\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
               return 0;
        }else{
           echo "\"fillColor\":\"1874CD\", \"alwaysOn\":\"true\", \"fillOpacity\":\"0.7\"";
            return 0;
        }
   }
?>

	<img id="library" src="<?php echo asset('static/Robarts3rdFloor.png')?>" alt = "Robarts Floor Map" width="862" height ="857" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="304,382, 493,477, 541,615, 260,621" data-maphilight='{<?php echoColour($q1);?>}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="379,114, 540,116, 548,202, 458,206, 455,265, 383,264, 379,114" data-maphilight='{<?php echoColour($q2);?>}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="608,173, 721,173, 741,223, 693,311" data-maphilight='{<?php echoColour($q3);?>}'/>
	</map>

</body>
</html>