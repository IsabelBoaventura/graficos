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

try{
    $sql_2 = "SELECT Codigo , Nome FROM funcionario WHERE Situacao='A'";  
    //echo  $sql_2 ;   
    $resposta2 = $conn->prepare( $sql_2);

    while ($linhaFunc = $resposta2->fetchAll()) {
        echo  "<option value='".$linhaFunc['Codigo']."'>".$linhaFunc['Nome']."</option>";
        //  echo ' linha 24 '. $linhaFunc->Codigo;
    }

    $funcionarioArray = array();
    $funcionarioNomeArray = array();

    $options = '';
    $teste= $conn->prepare("SELECT * FROM funcionario WHERE Situacao='A' ");
    $teste->execute();
    $totalFuncionario =  $teste->rowCount();
    $result = $teste->fetchAll();
    if(!empty($result)) { 
        foreach($result as $row) {
            //  echo ' <br> linha 35: ' . $row['Codigo'];
            $options .=  "<option value='".$row['Codigo']."'>".utf8_encode($row['Nome'])."</option>";
            $funcionarioArray[] = $row['Codigo'];
            $funcionarioNomeArray[] = utf8_encode($row['Nome']);
        }
    }

    $codFuncionario = $_REQUEST['html_funcionario'];
    $anoMesAtual = date('Ym');

    $sql_ano = "SELECT AnoMes, Funcionario, Saldo_Geral 
                FROM  funcionario_saldo_mes
                WHERE funcionario='".$codFuncionario."' 
                AND AnoMes >='202101' AND AnoMes <=202201
                ORDER BY AnoMes  ";

    $anoMesArray = array();
    $saldoGeralArray = array();

    $teste_ano = $conn->prepare( $sql_ano );
    $teste_ano->execute();
    $totalAno =  $teste_ano->rowCount();
    $result_ano = $teste_ano->fetchAll();
    if(!empty($result_ano)) { 
        foreach($result_ano as $row2) {
            $anoMesArray[] = $row2['AnoMes'];
            $saldoGeralArray[] = $row2['Saldo_Geral'];
        }
    }

    for( $a=0; $a<$totalFuncionario; $a++){
        if( $codFuncionario == $funcionarioArray[$a]){
            $apresentaFuncionario = 

        }

    }

    // echo '<br><pre>';
    // print_r( $anoMesArray );
    // echo '</pre><br>';
    // echo '<br><pre>';
    // print_r( $saldoGeralArray );
    // echo '</pre><br>';

    $tabela2 = '<table border=3>';
    $tabela2 .= '<tr><th> Ano Mes </th><th> Saldo Geral </th><th> Saldo Grafico </th></tr>';
    for( $i=0; $i<$totalAno; $i++){
        $tabela2 .= '<tr>';
        $tabela2 .= '<td>'.$anoMesArray[$i].'</td><td>'.$saldoGeralArray[$i].'</td>';
        $tabela2 .= '</tr>';

    }

    $tabela2 .='</table>';

    // echo $tabela2 ;


} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
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
    //echo '<br><br> Totais encontrados: '. $count . '<br>';
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
    // echo '<pre> ';
    // print_r( $nomeFuncionarioTexto );
    // echo '</pre>';

       
    $tabela =  "<table border='3'>";
    $tabela .= "<th>Funcionario</th><th>Nome Funcionario</th><th>Nome no Grafico</th><th>Saldo Anterior </th><th>Saldo Mes </th><th>Saldo Geral</th><th>Horario Grafico</th><th>Ações </th>";

    for( $t=0; $t<$count ; $t++){

        $horaGrafico .= transformaHorasInteiro( $saldoGeral[$t]). ", ";

     
        $maisUmNome[] = substr( $nomeFuncionario[$t], 0 , $posicao[$t]);
        $nomeGrafico .= " ' ".substr( $nomeFuncionario[$t], 0 , $posicao[$t]) ." ', ";
     
        $tabela .= "<tr>";
        $tabela .= "<td>".$funcionario[$t]."</td><td>".utf8_encode($nomeFuncionario[$t])."</td><td>".utf8_encode($maisUmNome[$t])."</td><td>".
                        $saldoGeralAnt[$t]."</td><td>".$saldoMes[$t].  "</td><td>".$saldoGeral[$t]. "</td><td>".  transformaHorasInteiro( $saldoGeral[$t])
                      ."</td><td><center><a href=\"\">[Alterar]</a>"
                      ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                      ."<a href=\"\">[Excluir]</a></center></td>";
        $tabela .= "</tr>";   

    }    
    $tabela .= '</table>';

    //  echo '<br> nome no grafico: '. utf8_decode($nomeGrafico) .'<br>' . utf8_encode( $nomeGrafico);
    // echo '<br> Horario para o grafico: '. $horaGrafico ;

} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}


?>


<!DOCTYPE html>
<html>
  <head>
    
    <title> Apache Saldo Ano  </title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="dist/echarts_5_3_1.min.js"></script>
  </head>
  
  <body>

   
    <form action="saldo_ano.php" method="POST">
    <fieldset>
       
        <label for="html_funcionario">Escolha um Funcionario:
            <select id="html_funcionario" name="html_funcionario">
                <option value="" selected>Selecione </option>
                <?php   echo $options;  ?>    
            </select>
        </label>
        <input type="submit" value="Enviar">
        </fieldset>
    </form>

    <h3> Conteudo do Funcionario  por Ano</h3>
    <?php echo $tabela2; ?>
	






























    <h2>Conteudo do Banco de Dados </h2>
    <h3>Lista de Funcionarios </h3>

    <?= $tabela ;?>

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