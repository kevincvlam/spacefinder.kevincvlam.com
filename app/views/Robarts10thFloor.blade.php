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
   
   $q1 = busynessindex("Robarts Library", 10, 1); 
   $q2 = busynessindex("Robarts Library", 10, 2); 
   $q3 = busynessindex("Robarts Library", 10, 3); 
   $q4 = busynessindex("Robarts Library", 10, 4);

?>

	<img id="library" src="<?php echo asset('static/Robarts10thFloor.png')?>" alt = "Robarts Floor Map" width="862" height ="857" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="347,330, 422,326, 465,401, 430,465, 340,465, 304,403, 347,330" data-maphilight='{<?php echoColour($q1);?>}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="523,208, 720,203, 645,318, 523,208" data-maphilight='{<?php echoColour($q2);?>}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="284,604, 484,609, 384,789, 284,604" data-maphilight='{<?php echoColour($q3);?>}'/>
		<area shape="poly" title="Quadrant4" href="#4" alt="Quadrant4" coords="47,203, 232,207, 119,312, 47,203" data-maphilight='{<?php echoColour($q4);?>}'/>
	</map>

</body>
</html>
