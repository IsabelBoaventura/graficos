<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico 09 </title>
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
                type: 'area',
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
                categories:   ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']

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
            clearInterval (meuIntervalo);

        }



        // --------------------
        function minhaFuncao(){

            let caminhoAjax =  'http://localhost/grafico/apexcharts/10/ajax/script.php';
            axios.get(  caminhoAjax ). 
            then( function(response ){

                dados = response.data; 

               // console.log(response.data);
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

      // verTrimestre(1);
    </script>
    
</body>
</html>