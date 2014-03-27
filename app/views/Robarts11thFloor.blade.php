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
   
   $q1 = busynessIndex("Robarts Library", 11, 1); 
   $q2 = busynessIndex("Robarts Library", 11, 2); 
   $q3 = busynessIndex("Robarts Library", 11, 3); 
   $q4 = busynessIndex("Robarts Library", 11, 4);

?>

	<img id="library" src="<?php echo asset('static/Robarts11thFloor.png')?>" alt = "Robarts Floor Map" width="862" height ="857" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="346,231, 431,231, 478,322, 439,387, 337,387, 300,316, 346,231" data-maphilight='{<?php echoColour($q1);?>}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="592,95, 765,94, 686,238, 592,95" data-maphilight='{<?php echoColour($q2);?>}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="255,530, 522,530, 388,746, 255,530" data-maphilight='{<?php echoColour($q3);?>}'/>
		<area shape="poly" title="Quadrant4" href="#4" alt="Quadrant4" coords="17,93, 213,93, 100,245, 17,93" data-maphilight='{<?php echoColour($q4);?>}'/>
	</map>

</body>
</html>

