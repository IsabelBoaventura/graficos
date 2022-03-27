<?php


require_once('libs/conexao.php');

// $horaGrafico[] = transformaHorasInteiro( $saldoGeral[$t]);

function transformaHorasInteiro( $hora ){
       //descobrir a posicao do primeiro separador
    $posicao =   strpos( $hora , ":") ;
    $novaHora =  substr( $hora , 0 , $posicao) ;
    $minuto = substr( $hora, $posicao+1, 2);
    $horaFinal = $novaHora.".".$minuto;
    return $novaHora; // $horaFinal;

}



try {

    $funcionario =array();
    $saldoGeral = array();
    $saldoGeralAnt = array();
    $saldoMes = array();
    $nomeFuncionario = array();
    $testeFunc = '';
    $testeSaldoGeral = '';
    $maisUmNome = array();
    $posicao = array();
    $horaGrafico = array();
    $nomeGrafico = '';
    $horaGrafico = '';


    $sql = "SELECT * FROM funcionario_saldo_mes WHERE ANOMES ='202201' ";
    //echo '<br> '  . $sql . '<br>';
 
    $stmt = $conn->prepare( $sql);

  
 
    if ($stmt->execute()) {

        $count = $stmt->rowCount();
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $funcionario[] = $rs->Funcionario;
            $saldoGeral[] =  $rs->Saldo_Geral ;
            $saldoGeralAnt[] = $rs->Saldo_Geral_Anterior ;
            $saldoMes[] = $rs->Saldo_Mes;
            $testeFunc .= $rs->Funcionario.", ";
            $testeSaldoGeral .= $rs->Saldo_Geral. ", ";
           
        }
    } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
    }
    echo '</table>';
    echo '<br><br> Totais encontrados: '. $count . '<br>';

    // var_dump( $funcionario );
    // //$rFunc = explode(",", $funcionario);
    // echo ' <br>'. $testeFunc .'<br>';
    // echo '<br> Removendo o Ultimo caracter <br>';
    // $finFuncionario = substr( $testeFunc , 0, -2);
    // echo '<br> '. $finFuncionario. '<br>';
    // echo ' <br> '. $testeSaldoGeral . '<br>';
    // print_r(  $saldoGeral );
    // $finSaldoGeral = substr( $testeSaldoGeral,  0,  -2 );
    // echo '<br><br>' . $finSaldoGeral. '<br>';

  
    $nomeFuncionarioTexto = '';



    for( $f=0; $f<$count ; $f++){
        $sql_func = "SELECT Nome FROM funcionario WHERE Codigo='".$funcionario[$f]."' ";
        //echo '<br>  '. $sql_func ;
        $resposta = $conn->prepare( $sql_func );

        $pdo_statement = $conn->prepare( $sql_func );
	    $pdo_statement->execute();
	    $result = $pdo_statement->fetchAll();
        foreach($result as $row) {            
            // echo $row["Nome"]; 
            $nomeFuncionarioTexto .= $row["Nome"].", ";
            $nomeFuncionario[] = $row["Nome"];
            $posicao[] =   strpos( $row["Nome"], " ") ;
        } 
    }
    $nomeFuncionarioTexto  = substr( $nomeFuncionarioTexto ,  0,  -2 );
    echo '<pre> ';
    print_r( $nomeFuncionarioTexto );
    echo '</pre>';



       
    echo '<table border="3" >';
    echo "<th>Funcionario</th><th>Nome Funcionario</th><th>Nome no Grafico</th><th>Saldo Anterior </th><th>Saldo Mes </th><th>Saldo Geral</th><th>Horario Grafico</th><th>Ações </th>";

    for( $t=0; $t<$count ; $t++){

        $horaGrafico .= transformaHorasInteiro( $saldoGeral[$t]). ", ";

     
        $maisUmNome[] = substr( $nomeFuncionario[$t], 0 , $posicao[$t]);
        $nomeGrafico .= " ' ".substr( $nomeFuncionario[$t], 0 , $posicao[$t]) ." ', ";
     
        echo "<tr>";
        echo "<td>".$funcionario[$t]."</td><td>".utf8_encode($nomeFuncionario[$t])."</td><td>".utf8_encode($maisUmNome[$t])."</td><td>".
                        $saldoGeralAnt[$t]."</td><td>".$saldoMes[$t].  "</td><td>".$saldoGeral[$t]. "</td><td>".  transformaHorasInteiro( $saldoGeral[$t])
                      ."</td><td><center><a href=\"\">[Alterar]</a>"
                      ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                      ."<a href=\"\">[Excluir]</a></center></td>";
       echo "</tr>";   

    }    
    echo '</table>';

    //  echo '<br> nome no grafico: '. utf8_decode($nomeGrafico) .'<br>' . utf8_encode( $nomeGrafico);
    // echo '<br> Horario para o grafico: '. $horaGrafico ;

} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}


?>


<!DOCTYPE html>
<html>
  <head>
    
    <title> Apache Echarts </title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="dist/echarts_5_3_1.min.js"></script>
  </head>
  
  <body>
	<h1>Graficos com Echarts da Apache </h1> 
  <!-- Prepare a DOM with a defined width and height for ECharts -->
  <div id="main" style="width: 750px;height:400px;border: 2px solid blue"></div>
  
   
    <script type="text/javascript">
      // Initialize the echarts instance based on the prepared dom
      var myChart = echarts.init(document.getElementById('main'));

      // Specify the configuration items and data for the chart
      var option = {
        title: {
          text: 'Saldo do Banco de Horas '
        },
        tooltip: {},
        legend: {
          data: []
        },
        xAxis: {
          data:  [<?=  utf8_encode($nomeGrafico) ; ?>  ]
        },
        yAxis: {},
        series: [
          {
            name: 'Horas',
            type: 'bar',
            data: [<?= $horaGrafico ; ?>]
          }
        ]
      };

      // Display the chart using the configuration items and data just specified.
      myChart.setOption(option);
    </script>
	
	
</body>
</html>

