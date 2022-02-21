<?php
    //ligar com o base de dados

    $ligacao = mysqli_connect('localhost', 'root', '123456', 'base_de_dados');


    //buscar os dados dos homens e das mulheres 
    $resultados = mysqli_query( $ligacao, "SELECT * FROM  dados ");
    $dados = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
    /*echo ' <pre>';
    print_r( $dados );
    die();
    */


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/apexcharts.min.js"></script>
</head>
<body>
   <!--  <h3>Participantes do Passatempo</h3> -->
    <div id="grafico"></div>

    <script>
        // vai buscar o elemento HTML onde o grafico vai ser renderizado
        let el = document.getElementById("grafico");

        //definição das opções do grafico
        let options = {
            chart:{
                type: 'bar',
                height: 700,
                width: 600

            }, 
            series: [
                {
                    name: 'Funcionarios',
                    data: [ <?=$dados['Homens']; ?>, <?=$dados['Mulheres']; ?> ]
                }
                /*
                {
                    name: 'Ana',
                    data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47 ]
                },
                {
                    name: 'Carlos',
                    data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35 ]
                }
                //12 informações para cada um 
                */

            ],
            /*
            //para aparecer o valor no ponto do valor //true or false 
            dataLabels: {
                enabled: false 
            },
             yaxis:{
                min:0 , 
                max: 120
            },
            */
            
            title: {
                text: 'Funcionários da Empresa',
                align: 'center' //'center' , 'left', 'right'
            },
            /*
            
            stroke:{
                width: [2,5,7], // espessura da linha de cada serie 
                //curve: 'smooth'  //straight or smooth or stepline
                curve: ['smooth', 'straight', 'stepline'],
                lineCap: 'butt'
            }, 
            */

            xaxis: {
                categories:   [ 'Homens', 'Mulheres' ]

            },
            grid: {
                borderColor: '#FF0000',
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            }

            /*
            // labels ou xaxis: categories tem a mesma função 

            // labels: [ '2ª-feira', '3ª-feira', '4ª-feira', '5ª-feira', '6ª-feira', 'sábado', 'Domingo' ]
            plotOptions:{
                bar: {
                    horizontal: false,
                    dataLabels:{
                        position: 'top' // top // botton //center 
                    }
                }
            },
            yaxis:{
                min:10, 
                max: 80
            },
            grid: {
                show: true,
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            colors: ['#4466FF','#FF6688']

            */

        };

        // criação do objeto a partir da biblioteca ApexCharts
        let chart = new ApexCharts(el, options );


        //renderização do grafico na pagina 
        chart.render()
    </script>
    
</body>
</html>