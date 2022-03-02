<?php

$nome = "Andr";
$url_pesquisa = "https://servicodados.ibge.gov.br/api/v2/censos/nomes/".$nome;
$response = file_get_contents( $url_pesquisa );


?>