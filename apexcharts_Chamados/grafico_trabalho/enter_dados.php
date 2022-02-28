<?php

//para o sistema reconhecer a classe existente
//use EasyPDO\EasyPDO;

//require "libs/EasyPDO.php";
require "libs/conexao.php";

//verirficar se houve recebimento de dados
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //echo '<br>estamos aqui<br> ';
    //$bd = new EasyPDO();

    $dia = $_POST['data_inicio'];
    $dia_fim = $_POST['data_fim'];
    $atendente  =  $_POST['atendente']; 

    echo ' <br> linha 16: informações dia: '.  $dia . ' atendente: '. $atendente ; 

    $fin = 'S';

    if($dia < $dia_fin){
        echo ' linha 23'. $dia ;
        $dia += 1;
         echo ' linha 25'. $dia ;


    }

    try{

        $sql_todos  = "SELECT * FROM chamado
                    WHERE DH_Chamado >= '2022-02-18 00:00:01' 
                    AND DH_Chamado <= '2022-02-18 23:59:59' 
        ";
        $sql_usuario = "  AND Usuario_Atendimento= '5' ";
        $sql_fin = " AND Finalizado ='".$fin."' ";

        $resultados = $conn->query( $sql_todos . ";" );


        // $rows = $resultados->fetchAll();
        //  $rows = $resultados->fetchAll( PDO::FETCH_ASSOC );

       // echo ' linha 31 '. $rows; 

        $total_dia = $resultados->rowCount();
        echo '<br>';
        print_r("Encontradas  $total_dia no total do dia ". $dia);
        echo '<br>';
        // $novo = now();
        $situacao = 'A';
        $atendentes = array(); 
        $temp = array() ;
        $a = 0;
        $atendentes['Dia'] = $dia;
        $usuarios = array() ;


        // var_dump( $temp);

        while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {
            $chave = $row['Usuario_Atendimento'];
            $usuario = $row['Usuario_Atendimento'];//$chave ;
            $temp[$chave]['Quantidade'] ++;


            
            if( $row['Finalizado'] == 'S'){
                        $temp[$chave]['Finalizados'] ++ ;

            }

            $atendentes['Total'] ++;

            //echo $row['Usuario_Atendimento'] . ' <== linha 50 <br />';
           // $atendentes['Atendente'] = $row['Usuario_Atendimento'];
          
             //
             /*
            if( !(isset($temp) )   ) {
               // $atendentes['Atendente']  = $row['Usuario_Atendimento']; 
                if( $temp['Atendente'] == $row['Usuario_Atendimento'] ){
                 
                    $temp['Quantidade'] ++ ;
                    if( $row['Finalizado'] == 'S'){
                        $temp['Finalizados'] ++ ;
                    }
                 
                }else{
                    $temp['Atendente'] = $row['Usuario_Atendimento'];
                    $temp['Quantidade']++;
                    if( $row['Finalizado'] == 'S'){
                        $temp['Finalizados'] ++ ;
                    }
                    $a++;
                }
                // 
               
                $temp['Total'] ++ ;
                
             
                
            
              
                 
                    
            
            // 
            }*/

            // $a++;
        }
        $atendentes['Totais'] = $temp;


        //
        
        var_dump( $atendentes );
       // var_dump( $temp);

        print_r($temp);



       // $usuarios = $temp[$chave];

        echo ' os usuarios: '. $usuarios ;

        var_dump($usuarios );


        /*
        foreach ($resultados  as $row) {
            //isset( $atendentes[$a] )
            //if( empty($atendentes[$a] ) ){
                $atendentes[$a] = $row['Usuario_Atendimento'];
              
                print $row['Usuario_Atendimento'] . "linha 53 \t";
           // }
            $a++;
           
            print  "linha 57  $a \n";
        }
        var_dump( $atendentes );
        */

        
        $totais = 0;

        if( $totais >0){

            $resultados_fin = $conn->query(
                $sql_todos . $sql_fin . ";"
            );
     
     
            $rows_fin = $resultados_fin->fetchAll( PDO::FETCH_ASSOC );
       
            $totais_fin  = $resultados_fin->rowCount();
            echo '<br>';
            print_r("Encontradas  Totais dos Finalizados $totais_fin  linhas.\n");
            echo '<br>';

            $dados_execute = array();

            $sql_insert = "INSERT INTO chamados_totais 
            (Data_Atendimento, Atendente, Total_Atendente, created_at, updated_at, Situacao, Total_Finalizados) 
            VALUES (?,?,?,  now(), now() , ?,?)";
            $stmt= $conn->prepare($sql_insert);
            $dados_execute =  array ( $dia, $atendente, $totais,  $situacao, $totais_fin ) ;
            $stmt->execute(  $dados_execute );
          
            /* $parametros = [        
                ':data1' => $_POST['data'],
                ':atendente' =>  $_POST['atendente'],
                ':total_atendente' => $totais , 
                ':sit'  => 'A',
                ':total_fin' =>   $totais_fin
            ];       
            // 
            var_dump( $parametros );*/


            /*   $bd->insert("INSERT INTO chamados_totais VALUES (0,  :data1,  :atendente , :total_atendente ,  now() , now(),  :sit,  :total_fin  )", $parametros);
               //sou obrigada a adicionar o valor do id, mesmo sendo 0
            */
                echo '<br> Inserido o valor com sucesso: ' ;
       
            /**/





   
            echo '<br> Inserido o valor com sucesso: ' ;
   
        }/**/




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

  









    /** Testado e inserido com sucesso  */
    /*
    $parametros = [        
        ':data1' => '2022-02-18',
        ':atendente' => '5',
        ':total_atendente' =>'10', 
        ':sit'  => 'A',
        ':total_fin' => '5'
    ];
    // var_dump( $parametros );
    $bd->insert("INSERT INTO chamados_totais VALUES ( 0,  :data1,  :atendente , :total_atendente ,  now() , now(),  :sit,  :total_fin  )", $parametros);
    //sou obrigada a adicionar o valor do id, mesmo sendo 0
    echo '<br> Inserido o valor com sucesso: ' ;
  */
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar informaçoes</title>
</head>
<body>
    <p>Inserir Temperatura</p>
    <form action="criar_grafico.php" method="post">
        <label for="data_inicio"> Data Inicial: </label><br>
        <input type="text" id="data_inicio" name="data_inicio" size = "10"><br><br>

        <label for="data_fim"> Data Final: </label><br>
        <input type="text" id="data_fim" name="data_fim" size = "10"><br><br>
        
        <label for="atendente">Atendente: </label><br>
        <input type="number" id="atendente" name="atendente" min="0" max="20" size = "5"> <br><br>

        <!-- <label for="ttl_atendente">Total por Atendente: </label><br>
        <input type="number" id="ttl_atendente" name="ttl_atendente" min="0" max="100" size = "5"> <br><br>
         <label for="ttl_fin">Total Finalizador por Atendente: </label><br>
        <input type="number" id="ttl_fin" name="ttl_fin" min="0" max="100" size = "5"> <br><br> -->
        
        
        
        
        
        <hr>
        
        
        
        
        
        
        <hr>
        <input type="submit" value="salvar">
    </form>
</body>




</html>