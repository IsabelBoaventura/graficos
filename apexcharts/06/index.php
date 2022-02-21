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
    <title>Grafico Dinamico</title>
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
                    name: 'Produtos da Loja ',
                    data: [ <?=$quantidades?> ]
                }
                

            ],
          
             yaxis:{
                min:0 , 
                max: 20
            },
            
            
            title: {
                text: 'Produtos da Loja',
                align: 'center' //'center' , 'left', 'right'
            },
           

            xaxis: {
                categories:   [ <?= $nomes ?>]

            },
            grid: {
                borderColor: '#FF0000',
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            }

           
        };

        // criação do objeto a partir da biblioteca ApexCharts
        let chart = new ApexCharts(el, options );


        //renderização do grafico na pagina 
        chart.render()
    </script>
    
</body>
</html>