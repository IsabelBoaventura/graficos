<?php

	require "libs/conexao.php"; 


	$teste = "[123, 456, 789, 111, 222]" ;
	echo ' testes em  php :'. $teste;
	//var_dump( $teste );
	$dia = '2022-02-18';


	try{

        $sql_todos  = "SELECT * FROM chamados_totais 
                    	WHERE Data_Atendimento = '".$dia."' 
                    "; 
        $resultados = $conn->query( $sql_todos . ";" );

        $total_dia = $resultados->rowCount();
        echo '<br>';
        print_r("Encontradas  $total_dia no total do dia ". $dia);
        echo '<br>';

		$nomes = [];
		$quantidades = [];
		$finalizados =[];
       

        while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {

			//echo  $row['Atendente'];
            $nomes[] = $row['Atendente'];
            $quantidades[]  = $row['Total_Atendente'];//$chave ;
            $finalizados[] = $row['Total_Finalizados'];        
        }

		
		$nomes = implode(',', $nomes);
		$quantidades  = implode(',', $quantidades );
        $finalizados  = implode(',', $finalizados );

		var_dump( $nomes );
		var_dump( $quantidades );
		var_dump( $finalizados ); 
   
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Exemplo 02 </title>
	
	<style>
		body{width:550px;}
		.chart-filter{    border-bottom: #CCC 1px solid;padding: 20px;}
		.btn-input {background: #333;color: #FFF;border: 0;padding: 8px 20px;border-radius: 4px;}
		.chart-item-title {padding:25px 0px;}
		.chart-item-option {margin-left: 20px;}
	</style>

	<script src="libs/jquery-3.6.0.min.js"></script>
	<script src="libs/chart.min.js"></script>
</head>
<body>

	
	<div class="chart-filter">
		<div class="chart-item-title">
			<input type="checkbox" name="countries" value="China" checked /> China
			<input type="checkbox" name="countries" value="India" class="chart-item-option" checked /> India
			<input type="checkbox" name="countries" value="United States" class="chart-item-option" /> United States
		</div>
		<input type="button" id="compare" value="Compare" class="btn-input" />
	</div>
	<div id="chart"></div>

	

	<script>
	$(function () {
		$(document).ready(function() {
			//Default Options
			var options = {
				chart: {
					renderTo: 'chart',
					type: 'column',
					height: 500,
					width:530
				},
				title: {
					text: 'Chamados'
				},
				xAxis: {
					categories:[ <?=$teste?>] , // [ '2014','2015','2016' ],
					title: { text: 'Year' }
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Millon',
						align: 'middle'
					}
				},
				plotOptions: {
					column: {
						dataLabels: {
							enabled: true
						}
					}
				},
				series: [{},{},{}, {}, {}]
			};
			alert (' teste ' + <?=$teste?>);
			
			// On click event handler to compare data
			$("#compare").on("click",function(){
				var countries =   //["China","India","United States"];
				//
				[<?=$nomes?>]; //"China","India","United States"];
				var data =
				 [
					[1,2,3,4,5],
					[6,7,8,9,0],
					[1,1,1,1,1],
					[2,2,2,2,2],
					[3,3,3,3,3]
				];
				//  [[1347,1360,1374],[1210,1233,1255],[311,316,322]  ];
				var color = ["#10c0d2","#f1e019","#a2d210", '#6959CD', '#778899'];
				var selected_countries,j;

				//alert( data.length );

				// Clear previous data and reset series data
				for (i=0;i<data.length;i++) {
					options.series[i].name = "";
					options.series[i].data = "";
					options.series[i].color = "";
				}

				// Intializeseries data based on selected countries
				var i = 0;
				$("input[name='countries']:checked").each(function() {	
					selected_countries = $(this).val();
					j = jQuery.inArray(selected_countries,countries)
					if(j >= 0){
						options.series[i].name = countries[j];
						options.series[i].data = data[j];
						options.series[i].color = color[j];
						i++;	
					}					
				});
				
				// Draw chart with options
				var chart = new Chart(options);

				// Display legend only for visible data.
				var item;
				for (k=i;k<=data.length;k++) {
					item= chart.series[k];				
					if(item) {
						item.options.showInLegend = false;
						item.legendItem = null;
						chart.legend.destroyItem(item);
						chart.legend.render();
					}
				}			
			});
					
		});
	});

	</script>
	
</body>
</html>




