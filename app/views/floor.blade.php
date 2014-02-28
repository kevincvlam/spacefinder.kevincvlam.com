@extends('layout')

@section('scripts')
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        <?php
            include '/home7/kevincvl/public_html/spacefinder/library/findBusyness.php';
        $con = connectToDB();
        printGoogleChartData(72, 'Robarts Library', "$floornum", 0, $con); 
        ?>
        // Create and draw the visualization.
        new google.visualization.SteppedAreaChart(document.getElementById('visualization')).
            draw(data, {hAxis: {direction: -1}
                       }
                );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
@stop

@section('content')
    <h1> Robarts Building, Floor {{ $floornum }} </h1>
       <?php
			echo "<div data-alert class='alert-box "; 
			// Insert Tag Here
			findBusynessTag('Robarts Library', {{ $floornum }}, 0);
			echo" radius'>";
			findBusyness('Robarts Library', {{ $floornum }}, 0);	 
			echo"</div>"
       ?>

       <h3> Recent Wireless Activity </h3>
        <div id="visualization" style="height: 400px;"></div>
@stop
