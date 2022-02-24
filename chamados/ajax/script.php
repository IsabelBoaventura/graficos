<?php

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


    $resultados = $bd->select("SELECT * FROM chamado
            WHERE DH_Chamado >= '".$dia." 00:00:01' AND DH_Chamado <= '".$dia." 23:59:59' 
            AND Usuario_Atendimento = '".$usuario."' AND Finalizado = '".$fin."' ;
    
    
        
    ");


    /**
     * 
     * 
     * SELECT * FROM simples_controle.chamado WHERE DH_Chamado >='2022-01-01 00:00:01' AND Situacao = 'F' order by DH_Chamado DESC;
     * 
     * 
     *     SELECT * FROM 
            (SELECT * FROM medidas ORDER BY created_at DESC LIMIT 10) 
        temp  ORDER BY created_at


        SELECT * FROM simples_controle.chamado WHERE DH_Chamado >= '2022-02-19 01:01:01';


          SELECT * FROM chamado 
        WHERE DH_Chamado >='2022-01-01 00:00:01' 
            AND Situacao = 'F'
            AND Finalizado= 'S'
        order by DH_Chamado DESC;
     * 
     */
    // seleciona apenas os 10 mais recentes
    /**que coisa mais louca,  primeiro busca os ultimos 10 adicionados,  e deles pegar por ordem crescente */

    $dados = [] ;
    echo 'totais do banco ' . $totais =  $bd->affectedRows;
    $ttl_atendente  = 0;

    if( $totais > 0 ){

    


                //------
        // teste para a inserção na tabela 

        /*
        
        $parametros = [
            ':data' => $dia,
            ':atendente' => $usuario,
            ':total_atendente' => $ttl_atendente , 
            ':sit'  => 'A',
            ':total_fin' =>  $totais
        ];

        $bd->insert("INSERT INTO chamados_totais  VALUES ( 0, :data ,  :atendente , :total_atendente,   now(),   now(), :sit, :total_fin  )", $parametros);
            //sou obrigada a adicionar o valor do id, mesmo sendo 0

        echo '<br> Inserido o valor com sucesso: ' ;

        */


          $parametros = [        
        ':data1' => $dia ,
        ':atendente' =>  $usuario ,
        ':total_atendente' =>'15',
        ':sit'  => 'A',
        ':total_fin' =>   $bd->affectedRows,
    ];

    // 
    var_dump( $parametros );
    $bd->insert("INSERT INTO chamados_totais VALUES ( 0,  :data1,  :atendente , :total_atendente ,  now() , now(),  :sit,  :total_fin  )", $parametros);
    //sou obrigada a adicionar o valor do id, mesmo sendo 0

    }



    //------
    // teste para a inserção na tabela 
      /*
    $parametros = [
        ':data' => $dia,
        ':atendente' => $usuario, 
        ':total_atendente' => $_POST['ttl_atendente'] , 
        ':total_fin' =>  $totais
    ];
    $bd->insert("INSERT INTO chamados_totais  VALUES ( 0,  :data ,  :atendente , 0,   now(),   now(),  'A', :total_fin  )", $parametros);
        //sou obrigada a adicionar o valor do id, mesmo sendo 0

    echo '<br> Inserido o valor com sucesso: ' .  $_POST['numero'];
    //
     echo ' totais de chamados '. $totais . ' no dia  '. $dia . ' do usuario : '. $usuario .' Com o tipo de Finalizado => '. $fin . '    ' ;

    
    
    */
    
    
    
    
    //
     $dados = [ 0, 70, 54, 53, 30, 48, 5];





    /*if( $bd->affectedRows < 10){
        //criar array com numero de dados para completar 10 

        $dados = array_fill(0 ,10 - $bd->affectedRows, 0); 

    }*/

    //criar array de dados 
    //   var_dump($resultados );
    foreach( $resultados as $resultado ){

        // echo ' linha 35 '. $resultado->valor ; 
        //echo ' linha 36 '. $resultado->Valor ; 
        //echo ' linha 37 '. $resultado['Valor'] ; 
        //$dados[] = intval( $resultado['Valor'] );

    }

    /*
    $post = json_decode(file_get_contents("php://input", true));

    $dados  = $post->informacao;
    array_shift( $dados );
    $dados[] = rand(1,99);
    */
   
    echo json_encode( $dados);

?>