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
        printGoogleChartData(6, 'Robarts Library', "$floornum", 0, $con); 
        ?>
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {hAxis: {direction: -1},
                        vAxis: {title: 'Active Connections'}
                       }
                );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
@stop

@section('content')
    <h1> Robarts Building, Floor {{ $floornum }} </h1>
       <?php
            $curIndex = 100*busynessIndex('Robarts Library', $floornum);
           // $curIndex = findBusynessIndex("Robarts Library", $floornum, 0); 
            if ($curIndex > CROWDED_THRESHOLD){
                   $word = "Very Crowded";
                   $tag = "alert";
            }elseif ($curIndex > BUSY_THRESHOLD
            && $curIndex <= CROWDED_THRESHOLD){
                   $word = "Crowded";
                   $tag = "alert";
            }elseif ($curIndex > HASSPACE_THRESHOLD
            && $curIndex <=  BUSY_THRESHOLD){
                   $word = "Busy";
                   $tag = "warning";
            }elseif ($curIndex > EMPTY_THRESHOLD 
            && $curIndex <= HASSPACE_THRESHOLD){
                   $word = "Has Space";
                   $tag = "success";
            }else{
                $word = "Empty";
                $tag = "info";
            }
			echo "<div data-alert class='alert-box "; 
			// Insert Tag Here
            echo $tag;
			echo" radius'>";
            echo $word;
			echo"</div>";
             
            getFloorPrediction('Robarts Library', $floornum, 0);	  
            echo"<br>";
       ?>

       <h3> Recent Wireless Activity </h3>
        <div id="visualization" style="height: 400px;"></div>

        <?php 

            echo "<a href=";
            echo asset("/mapdata/$floornum");
            echo ">See Floor Map</a>";
        ?>
@stop
