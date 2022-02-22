<?php

    // qual a classe que iremos usar 
    use EasyPDO\EasyPDO ;

    //onde esta a classe a ser usada 
    require "../libs/EasyPDO.php";

    $bd = new EasyPDO();

    //para esta situacao  queremos devolver para o AJAX uma array com 10 valores 
    // para este caso sempre será 10 ;

    $resultados = $bd->select("
        SELECT * FROM 
            (SELECT * FROM medidas ORDER BY created_at DESC LIMIT 10) 
        temp  ORDER BY created_at
    ");
    // seleciona apenas os 10 mais recentes
    /**que coisa mais louca,  primeiro busca os ultimos 10 adicionados,  e deles pegar por ordem crescente */

    $dados = [] ;

    if( $bd->affectedRows < 10){
        //criar array com numero de dados para completar 10 

        $dados = array_fill(0 ,10 - $bd->affectedRows, 0); 

    }

    //criar array de dados 
    // var_dump($resultados );
    foreach( $resultados as $resultado ){

        // echo ' linha 35 '. $resultado->valor ; 
        //echo ' linha 36 '. $resultado->Valor ; 
        //echo ' linha 37 '. $resultado['Valor'] ; 
        $dados[] = intval( $resultado['Valor'] );

    }

    /*
    $post = json_decode(file_get_contents("php://input", true));

    $dados  = $post->informacao;
    array_shift( $dados );
    $dados[] = rand(1,99);
    */
   
    echo json_encode( $dados);

?>