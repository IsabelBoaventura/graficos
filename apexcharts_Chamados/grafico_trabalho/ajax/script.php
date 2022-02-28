<?php

    /*
    // qual a classe que iremos usar 
    use EasyPDO\EasyPDO ;

    //onde esta a classe a ser usada 
    require "../libs/EasyPDO.php";

    $bd = new EasyPDO();

    //para esta situacao  queremos devolver para o AJAX uma array com 10 valores 
    // para este caso sempre será 10 ;
    $dia = '2022-02-18'; 
    $usuario = '5';
    $fin = 'S';
    $sql_select = "SELECT * FROM chamado
            WHERE DH_Chamado >= '".$dia." 00:00:01' AND DH_Chamado <= '".$dia." 23:59:59' 
            AND Usuario_Atendimento = '".$usuario."' AND Finalizado = '".$fin."' ; " ;


    $resultados = $bd->select(  $sql_select );


  

    //$dados = array() ;
    echo 'totais do banco ' . $totais =  $bd->affectedRows;
    $ttl_atendente  = 0;

   



 
    





    /*if( $bd->affectedRows < 10){
        //criar array com numero de dados para completar 10 
        $dados = array_fill(0 ,10 - $bd->affectedRows, 0); 
    }*/

    //criar array de dados 
    //  var_dump($resultados );

    /*
    foreach( $resultados as $resultado ){

        // echo ' linha 35 '. $resultado->valor ; 
        //echo ' linha 36 '. $resultado->Valor ; 
        //
        echo ' linha 37 '. $resultado['Valor'] ; 
        //
        $dados2[] = intval( $resultado['Valor'] );

    }*/

    /*
    $post = json_decode(file_get_contents("php://input", true));
    $dados  = $post->informacao;
    array_shift( $dados );
    $dados[] = rand(1,99);
    */

    //$dados = [];


     $dados = array( '0', '70', '54', '53', '30', '48', '5');

     //var_dump( $dados );
   
    echo json_encode( $dados);

?>