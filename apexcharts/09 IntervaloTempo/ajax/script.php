<?php

    $post = json_decode(file_get_contents("php://input", true));

    $dados  = $post->informacao;
    array_shift( $dados );
    $dados[] = rand(1,99);
   
    echo json_encode( $dados);

?>