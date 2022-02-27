<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","123456","simples_controle");

$sqlQuery = "SELECT * FROM chamados_totais WHERE  Data_Atendimento = '2022-02-18' ";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//var_dump( $data );

mysqli_close($conn);

echo json_encode($data);
?>