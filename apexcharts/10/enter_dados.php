<?php

//para o sistema reconhecer a classe existente
use EasyPDO\EasyPDO;

require "libs/EasyPDO.php";

//verirficar se houve recebimento de dados
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //echo '<br>estamos aqui<br> ';
    $bd = new EasyPDO();
    $parametros = [
        ':valor' => $_POST['numero']
    ];
    $bd->insert("INSERT INTO medidas VALUES ( 0, :valor, now())", $parametros);
    //sou obrigada a adicionar o valor do id, mesmo sendo 0

    echo '<br> Inserido o valor com sucesso: ' .  $_POST['numero'];
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
    <form action="enter_dados.php" method="post">
        <label for="valor">Valor: </label><br>
        <input type="number" id="numero" name="numero" min="0" max="100" size = "5"><hr>
        <input type="submit" value="salvar">
    </form>
</body>
</html>