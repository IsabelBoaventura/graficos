<?php

    require_once 'libs/conexao.php';
	$dia = '2022-02-18';

	try{
		$sql_todos  = "SELECT * FROM chamados_totais 
					WHERE Data_Atendimento = '".$dia."' 
				"; 
		$resultados = $conn->query( $sql_todos . ";" );
			   
		$total_dia = $resultados->rowCount();
		//
		echo '<br>';
		//
		print_r("Encontradas  $total_dia no total do dia ". $dia);
		//
		echo '<br>';
			   

		if( $total_dia>0){
			while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {
					
				//echo  $row['Atendente'];
				$nomes[] = $row['Atendente'];
				$quantidades[]  = $row['Total_Atendente'];//$chave ;
				$finalizados[] = $row['Total_Finalizados'];        
			}
		
				
			$nomes2 = implode(',', $nomes);
			$quantidades2  = implode(',', $quantidades );
			$finalizados2  = implode(',', $finalizados );
			
	
		
		
		}


		/*for( $t = 0;  $t< $total_dia; $t++){
			echo "['".$nomes[$t]."', ".$quantidades[$t]."],";
		}*/

	
				  
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


   <title>Demonstração de gráfico de pizza - PHPCluster</title>

   <!-- --> <script  src="libs/loader.js"></script> <!-- -->   
   <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->

</head>

<body>
	

    <div id="piechart" style="width: 900px; height: 500px;">grafico</div>


          

		  <script >
				google.charts.load('current' , {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);
			

			

				function drawChart(){
					var data = google.visualization.arrayToDataTable([
						['Codigo' , 'Horas por dia '],
						<?php
							for( $t = 0;  $t< $total_dia; $t++){
								echo "['".$nomes[$t]."', ".$quantidades[$t]."],";
							}

						?>
						//['Aldenir', 9],
						//['jessica',16]
					]);
					var options = {
						title: ' titulo do grafico  ',
						//is3D: true,
						//pieHole: 0.5,
						//pieStartAngle: 120,
						is3D: true,
						//colors: ['cyan', 'orange', 'blue', 'green', 'pink']
						//  legend: 'none', 

					};
					var chart = new google.visualization.PieChart(document.getElementById('piechart'));
					chart.draw( data , options );
				}
			</script>

  </body>

</html>




