<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico de Chamados </title>
    <link rel="stylesheet" href="libs/bootstrap_v5-0-2.min.css">
    <script src="libs/apexcharts.min.js"></script>
    <script src="libs/axios.min.js"></script>
</head>
<body>
   
    <div class="container-fluid">
       <div class="row my-5">
           <div class="col-10 offset-1">
                <div id="grafico"></div>
           </div>
       </div>
       <div class="text-center">
            <button class="btn btn-primary" onclick="iniciar()" >Start</button>
            <button class="btn btn-primary" onclick="parar()" >Stop </button>
       </div>
     
    </div>
   
    <script>
        // vai buscar o elemento HTML onde o grafico vai ser renderizado
        let el = document.querySelector("#grafico");
        // valores para a inicialização do grafico
        let dados = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        let meuIntervalo = null ;
        //definição das opções do grafico
        let options = {
            chart:{
                type: 'bar',
                animations:{
                    enabled: false
                }
                //height: 650,
               // width: 600
            }, 
            series: [
                {
                    name: 'Dados php ',
                    data: dados
                }       
            ],
            dataLabels:{
                enabled: false
            },
          
             yaxis:{
                min:0 , 
                max: 100
            },
            
            
            title: {
                text: 'Modificações por segundo',
                align: 'center' //'center' , 'left', 'right'
            },
           
            xaxis: {
                categories:   [ '13/02/22', '14/02/22', '15/02/22', '16/02/22', '17/02/22', '18/02/22', '19/02/22']
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
        // -----
        function iniciar(){
            meuIntervalo = setInterval(minhaFuncao,  1000);
        }
        // -----------------
        function parar(){
            console.log( "Parar de executar ");
            clearInterval (meuIntervalo);
        }
        // --------------------
        function minhaFuncao(){
            let caminhoAjax =  'http://localhost:8585/simples_controle/grafico/ajax/script.php';
            axios.get(  caminhoAjax ). 
            then( function(response ){
                dados = response.data; 
               //
                console.log(response.data);
                chart.updateSeries(
                   [
                       {
                           data:  response.data 
                       }
                   ]
               );
           }).
           catch(function(error){
               console.log('Erro: '+ error);
           });
        }
       
    </script>
    
</body>
</html>