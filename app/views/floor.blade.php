<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Google Visualization API Sample
    </title>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        <?php
        include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';
        $con = connectToDB();
        printGoogleChartData(72, 'Robarts Library', '{{floornum}}', 0, $con); 
        ?>
        // Create and draw the visualization.
        new google.visualization.SteppedAreaChart(document.getElementById('visualization')).
            draw(data, {hAxis: {direction: -1}
                       }
                );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 1000px; height: 400px;"></div>
  </body>
</html>
