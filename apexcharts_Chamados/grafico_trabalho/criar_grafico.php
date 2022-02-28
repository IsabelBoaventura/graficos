<?php

//para o sistema reconhecer a classe existente
//use EasyPDO\EasyPDO;

//require "libs/EasyPDO.php";
require "libs/conexao.php";

//verirficar se houve recebimento de dados
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //echo '<br>estamos aqui<br> ';
    //$bd = new EasyPDO();

    echo ' <br> data inicio '. $data_inicio = $_POST['data_inicio'];
    echo ' <br> dia inicio '.$dia_inicio = substr( $data_inicio, 8,2) ;
    echo ' <br> mes inicio '.$mes_inicio = substr( $data_inicio, 5,2)  ;
    echo ' <br> ano inicio '.$ano_inicio = substr( $data_inicio, 0,4)  ;
    echo  ' <br><br> data fim '. $dia_fim = $_POST['data_fim'];

    echo  ' <br> Atendente '.$atendente  =  $_POST['atendente']; 
    $fin = 'S';

    //
    echo ' <br> linha 16: informações dia: '.  $dia . ' atendente: '. $atendente ; 

    /* if($dia < $dia_fim){
        echo ' linha 23'. $dia ;
        $dia += 1;
         echo ' linha 25'. $dia ;


    }  */   

    try{

        echo '<br> sql de pesquisa '.
        $sql_todos  = "SELECT * FROM chamado
                    WHERE DH_Chamado >= '".$data_inicio." 00:00:01' 
                    AND DH_Chamado <= '".$data_inicio." 23:59:59' ";
        $sql_usuario = "  AND Usuario_Atendimento= '13' ";
        $sql_fin = " AND Finalizado = " .$fin ;

        $resultados = $conn->query( $sql_todos . ";" );


        $total_dia = $resultados->rowCount();
        /* echo '<br>';
        print_r("Encontradas  $total_dia no total do dia ". $dia);
        echo '<br>';
        */
        // $novo = now();
        $situacao = 'A';
        $atendentes =  array(); //[]; 
        $temp = array(); // [];
        $a = 0;
        $atendentes['Dia'] = $dia;
        $usuarios = array(); //  [];
        $quantidades= array(); // [];
        $linhas = 0;
        $qtd=0;
        $qtd_fin = 0; 
        $totais = 0;
        

        while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {
            $chave = $row['Usuario_Atendimento'];
            $temp[$chave]['Atendente'] = $chave;
            //$qtd ++;
            $temp[$chave]['Quantidade'] += 1 ;            
            if( $row['Finalizado'] == 'S'){
               // $qtd_fin ++;
                        $temp[$chave]['Finalizados'] += 1;
            }

            $totais  ++;    
        } // fecha while

        $atendentes['Total'] = $totais ;
       

        //echo ' <br> linha 114 quantidade  ===> ', sizeof($temp);

                // echo ' <br> linha 65 TOTAIS'

        var_dump( $temp );

         foreach(  $temp as $key => $value ){        
            $usuarios[] = $key ;
            $quantidades[]= $value['Quantidade']; // [ '5', '10', '15'];
            $finalizados[]= $value['Finalizados'];
            //echo '<br> quantidades: '. $value['Quantidade'];

            try{

             
                //$totais = 0;

                $sql_ch_atendente  = "SELECT * FROM chamados_totais
                                    WHERE Data_Atendimento = '".$dia."' 
                                    AND Atendente = '".$key."' 
                ";


                $resultados_ch= $conn->query( $sql_ch_atendente  . ";" );


                $totalChamadosPorAtendentes  = $resultados_ch->rowCount();

                if( $totalChamadosPorAtendentes < 1 ) {    
                      
                            $situacao = 'A';
                            $sql_insert = "INSERT INTO chamados_totais 
                            (Data_Atendimento, Atendente, Total_Atendente, created_at, updated_at, Situacao, Total_Finalizados) 
                            VALUES (?,?,?,  now(), now() , ?,?)";
                            $stmt= $conn->prepare($sql_insert);
                            $dados_insert = array(  $dia, $key, $value['Quantidade'], $situacao, $value['Finalizados']  );
                            $stmt->execute(  $dados_insert  );
                        
                                                  
                                echo '<br> Inserido o valor com sucesso: ' ;
                    
                }        


            }catch(PDOException $e) {
                            echo 'ERROR: ' . $e->getMessage();

            }

            
   
        
   
        }/**/



        

        $nomes = implode(',', $usuarios);
        $quantidades = implode (',', $quantidades);
        $finalizados = implode(',', $finalizados);
        $atendentes['Totais'] = $temp;
       
          




    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    /*
    $resultados = $conn->query("SELECT * FROM chamado
            WHERE DH_Chamado >= '".$dia." 00:00:01' AND DH_Chamado <= '".$dia." 23:59:59' 
            AND Usuario_Atendimento = '".$atendente ."' AND Finalizado = '".$fin."' ;  
        
    ");
    echo '<BR> resposta do total: '. $totais  =  $bd->affectedRows;
    */

    /**/

  





}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criando Grafico<div class="container-fluid">  </title>
    <script src="libs/apexcharts.min.js"></script>



    <link rel="stylesheet" href="libs/bootstrap_v5-0-2.min.css">
    <script src="libs/axios.min.js"></script>
  
</head>
<body>

    <hr/> 
    <div class="container-fluid">
       <div class="row my-5">
           <div class="col-10 offset-1">
                <div id="grafico"></div>
           </div>
       </div>
       <hr/>

       <div class="row my-5">
           <?=$nomes?>
           <br>
           <?=$quantidades?>
           <br>
           <?=$finalizados?>

           <hr/>

       </div>
     
     
    </div>








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
                    name: 'Atendimentos',
                    data: [ <?=$quantidades?> ]
                },
                {
                    name: 'Finalizados',
                    data: [<?=$finalizados?>]
                }
                

            ],
          
            /*yaxis:{
                min:0 , 
                max: 20
            },*/
            
            
            title: {
                text: 'Atendimentos por dia ',
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
            },
            colors: [ '#000080', '#6B8E23'  ]

           
        };

        // criação do objeto a partir da biblioteca ApexCharts
        let chart = new ApexCharts(el, options );


        //renderização do grafico na pagina 
        chart.render()
    </script>
    
   





</body>
</html>