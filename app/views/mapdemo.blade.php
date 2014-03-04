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
	<!--Green: {"fillColor":"5DFC0A", "alwaysOn":"true", "fillOpacity = 0.7"} -->
	<!--Blue: {"fillColor":"1874CD", "alwaysOn":"true", "fillOpacity = 0.6"} -->
	<!--Red: {"fillColor":"ff0000", "alwaysOn":"true", "fillOpacity = 0.5"} -->
	<!--Orange: {"fillColor":"FF6103", "alwaysOn":"true", "fillOpacity = 0.7"} -->
	

	<img id="library" src="<?php echo asset('static/006-_13th-AP-positions-page1.jpg')?>" alt = "Robarts Floor Map" width="2550" height ="3300" usemap="#triangle">
	<map id="triangle" name ="triangle">
		
	
		<area shape="poly" title="Quadrant1" href="#1" alt="Quadrant1" coords="91,463, 900,463, 897,817, 801,989, 491,1177, 91,463" data-maphilight='{"fillColor":"5DFC0A", "alwaysOn":"true","fillOpacity":"0.7"}'/>
		<area shape="poly" title="Quadrant2" href="#2" alt="Quadrant2" coords="1627,451, 2453,461, 2151,1055, 1745,977, 1651,821, 1627,451" data-maphilight='{"fillColor":"ff0000","alwaysOn":"true","fillOpacity":"0.5"}'/>
		<area shape="poly" title="Quadrant3" href="#3" alt="Quadrant3" coords="775,1657, 1771,1667, 1271,2511, 775,1657" data-maphilight='{"fillColor":"1874CD", "alwaysOn":"true","fillOpacity":"0.6"}'/>
		<area shape="poly" title="Quadrant4" href="#4" alt="Quadrant4" coords="1135,887, 1403,891, 1551,1179, 1425,1381, 1109,1391, 977,1165, 1135,887" data-maphilight='{"fillColor":"FF6103", "alwaysOn":"true", "fillOpacity":"0.6"}'/>
	</map>

</body>
</html>
