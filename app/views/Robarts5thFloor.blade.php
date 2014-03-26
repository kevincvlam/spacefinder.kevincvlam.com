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
   
   $q1 = busynessindex("Robarts Library", 5, 1); 
   $q2 = busynessindex("Robarts Library", 5, 2); 
   $q3 = busynessindex("Robarts Library", 5, 3); 


?>

	<img id="library" src="<?php echo asset('static/Robarts5thFloor.png')?>" alt = "Robarts Floor Map" width="862" height ="857" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="104,144, 243,145, 249,192, 444,193, 256,363, 139,364, 61,224, 104,144" data-maphilight='{<?php echoColour($q1);?>}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="521,146, 662,147, 705,220, 639,358, 521,146" data-maphilight='{<?php echoColour($q2);?>}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="280,443, 490,442, 439,547, 338,547, 280,443" data-maphilight='{<?php echoColour($q3);?>}'/>
		
	</map>

</body>
</html>