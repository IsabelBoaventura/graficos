<?php
header('Content-Type: application/json');

require_once('conexao.php');

$sqlQuery = "SELECT * FROM chamados_totais 
            WHERE Data_Atendimento = '2022-02-19'";

$result = mysqli_query($conn,$sqlQuery);

$data = [];

$linha = mysqli_fetch_array( $result, MYSQLI_ASSOC);
foreach ($linha as $row) {
	$data[] = $row;
}
    //mysqli_close($conn);

echo json_encode($data);
?>