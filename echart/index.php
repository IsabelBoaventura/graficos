<?php

require_once('libs/conexao.php');

echo ' <br>ola mundo<br> ';

//phpinfo();

?>


<!DOCTYPE html>
<html>
  <head>
    <title> Echarts </title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="dist/echarts_5_3_1.min.js"></script>
  </head>
  
  <body>
	<h1>Graficos com Echarts da Apache </h1> 
  <!-- Prepare a DOM with a defined width and height for ECharts -->
  <div id="main" style="width: 600px;height:400px;border: 2px solid blue"></div>
  
   
    <script type="text/javascript">
      // Initialize the echarts instance based on the prepared dom
      var myChart = echarts.init(document.getElementById('main'));

      // Specify the configuration items and data for the chart
      var option = {
        title: {
          text: 'ECharts Getting Started Example'
        },
        tooltip: {},
        legend: {
          data: ['sales']
        },
        xAxis: {
          data: ['Shirts', 'Cardigans', 'Chiffons', 'Pants', 'Heels', 'Socks']
        },
        yAxis: {},
        series: [
          {
            name: 'sales',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
          }
        ]
      };

      // Display the chart using the configuration items and data just specified.
      myChart.setOption(option);
    </script>
	
	
</body>
</html>

