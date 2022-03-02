<?php

$nome = "Isabel";
$url_pesquisa = "https://servicodados.ibge.gov.br/api/v2/censos/nomes/".$nome;
$response = file_get_contents( $url_pesquisa );

$response = json_decode( $response, true );

//var_dump( $response );


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequencia de Nomes </title>
    <script src="libs/chart/3-7-1/chart/chart.min.js "></script>


</head>
<body>
    <div style="width:500px;">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>



<script>
    let labels = [
        <?php
            foreach( $response[0]['res'] as $v ){
                echo "'".$v['periodo']."'," ;
            }
        ?>
    ];

    let data = [
        <?php
            foreach( $response[0]['res'] as $v ){
                echo "'".$v['frequencia']."'," ;
            }
        ?>
    ];

    console.log(' periodo: ' + labels );
    console.log( 'Frequencia: ' + data );
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels ,
            datasets: [{
                label: '# Frequencia do nome "<?=$response[0]['nome']?>" ',
                data: data ,
                backgroundColor: [
                    'rgba(255, 99, 132 )',
                    'rgba(54, 162, 235 )',
                    'rgba(255, 206, 86 )',
                    'rgba(75, 192, 192 )',
                    'rgba(153, 102, 255 )',
                    'rgba(255, 159, 64 )'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
 
    
</body>
</html>