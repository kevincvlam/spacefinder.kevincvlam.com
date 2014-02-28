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
        var data = google.visualization.arrayToDataTable([
          ['x', 'Cats', 'Blanket 1', 'Blanket 2'],
          ['A',   1,       1,           0.5],
          ['B',   2,       0.5,         1],
          ['C',   4,       1,           0.5],
          ['D',   8,       0.5,         1],
          ['E',   7,       1,           0.5],
          ['F',   7,       0.5,         1],
          ['G',   8,       1,           0.5],
          ['H',   4,       0.5,         1],
          ['I',   2,       1,           0.5],
          ['J',   3.5,     0.5,         1],
          ['K',   3,       1,           0.5],
          ['L',   3.5,     0.5,         1],
          ['M',   1,       1,           0.5],
          ['N',   1,       0.5,         1]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
                        width: 500, height: 400,
                        vAxis: {maxValue: 10}}
                );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 500px; height: 400px;"></div>
  </body>
</html>
