<?php
    //ligar com o base de dados

    $ligacao = mysqli_connect('localhost', 'root', '123456', 'base_de_dados');
    $ligacao->set_charset("utf8");


    //buscar os dados dos homens e das mulheres 
    $resultados = mysqli_query( $ligacao, "SELECT * FROM  produtos ");

    $nomes = [];
    $quantidades = []; 
    while( $linha = mysqli_fetch_array( $resultados, MYSQLI_ASSOC)) {
        $nomes[] = "'{$linha['Nome_produto']}'" ;
        $quantidades[] = $linha['Qtd'] ;
    
    
    }
    $nomes = implode(',', $nomes);
    $quantidades  = implode(',', $quantidades);
    //$dados = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
    /*echo ' <pre>';
   

    echo ' <pre>';
    print_r( $nomes );

    print_r( $quantidades);
    die(); */
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico </title>
    <link rel="stylesheet" href="libs/bootstrap_v5-0-2.min.css">
    <script src="libs/apexcharts.min.js"></script>
    <script src="libs/axios.min.js"></script>
</head>
<body>
    <!--  <h3>Participantes do Passatempo</h3> -->
    <div class="container-fluid">
       <div class="row my-5">
           <div class="col-6 offset-3">
                <div id="grafico"></div>
           </div>
       </div>
       <div class="row">
           <div class="col text-center">
                <button class="btn btn-primary" onclick="verTrimestre(1)">1º Trimestre</button>
                <button class="btn btn-primary" onclick="verTrimestre(2)">2º Trimestre</button>
                <button class="btn btn-primary" onclick="verTrimestre(3)">3º Trimestre</button>
                <button class="btn btn-primary" onclick="verTrimestre(4)">4º Trimestre</button>


           </div>
       </div>
    </div>
   

    <script>
        // vai buscar o elemento HTML onde o grafico vai ser renderizado
        let el = document.querySelector("#grafico");


        //definição das opções do grafico
        let options = {
            chart:{
                type: 'bar',
                //height: 650,
               // width: 600

            }, 
            series: [
                {
                   //  name: 'Resultado por Trimestre ',
                    data: [  ]
                }
                

            ],
          
             yaxis:{
                min:0 , 
                max: 100
            },
            
            
            title: {
                text: 'Resultados por Trimestre',
                align: 'center' //'center' , 'left', 'right'
            },
           

            xaxis: {
                categories:   []

            },
            grid: {
                borderColor: '#FF0000',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }

           
        };

        // criação do objeto a partir da biblioteca ApexCharts
        let chart = new ApexCharts(el, options );


        //renderização do grafico na pagina 
        chart.render();

        // -----------------
        function verTrimestre( trimestre ){
           //console.log( trimestre);
           //fazer a chamado do ajax

           let caminhoAjax =  'http://localhost/grafico/apexcharts/08/ajax/script.php';
           axios.post(  caminhoAjax , { trimestre: trimestre}). 
           then( function(resposta){
               chart.updateSeries(
                   [
                       {
                           data: resposta.data
                       }
                   ]
               );

           }).
           catch(function(error){
               console.log('Erro: '+ error);
           });
           //receber os resultados

           // atualizar a serie do Grafico
        }

        verTrimestre(1);
    </script>
    
</body>
</html>