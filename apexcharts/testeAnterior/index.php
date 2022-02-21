<?php
    /** Site original deste conteudo:
     * https://www.youtube.com/watch?v=06tTS7t3saU&t=852s
     * 
     * Titulo: APEXCHARTS #06 CONSTRUIR GRÁFICO COM PHP E MYSQL AINDA MAIS DINÂMICO
     * 
     * 
     */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/apexcharts.min.js"></script>
</head>
<body>
   <h1> test 2 e </h1> 
    <div id="grafico"></div>


    <script>
        let el = document.getElementById('grafico');
        let options = {
            chart: {
                type: 'bar',
                width: 700,
                height: 500
            },
            series: [
                {
                    name: "Produtos de teste ",
                    data: [10,20]
                }
            ],

            xaxis: {
                categories: ['um', 'dois ']
            },
            title: {
                text: "os proddutos de teste da lija "
            }
        };
        let chart = new ApexCharts( el, options );
        chart.render();
    </script>
</body>
</html>

