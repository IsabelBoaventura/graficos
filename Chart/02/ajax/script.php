<?php
    require "../libs/conexao.php";

    $post = json_decode(file_get_contents("php://input", true));

    switch( $post->tempo_escolhido  ){
        case '1':
            $dia = '2022-02-19';
            try{
                $sql_todos  = "SELECT * FROM chamados_totais
                            WHERE Data_Atendimento = '".$dia."' 
                              AND Situacao = 'A' 
                ";     
                $resultados = $conn->query( $sql_todos . ";" );    
        
                $total_dia = $resultados->rowCount();               
                $usuarios = [];
                $quantidades=[];
                $finalizados=[];      
               
        
                while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {
                    
                    $usuarios[] = $row['Atendente']  ;
                    $quantidades[]= $row['Total_Atendente']; 
                    if( $row['Total_Finalizados'] < 1){
                        $finalizados[]= 0;      
                    }else{
                        $finalizados[]= $row['Total_Finalizados'];      
                    }
                          
                }/**/
                $nomes = implode(',', $usuarios);
                $quantidades = implode (',', $quantidades);
                $finalizados = implode(',', $finalizados);        
                          
            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            // $dados  = "[" . $quantidades . "];[". $finalizados ."];" ;
            $dados = "[" . $nomes . "];[".$quantidades . "];[". $finalizados ."];" ;
            $dados2 = "[5,0];[3,2];[0,0];";
            break;
        case '2':

            $dia = '2022-02-18';
            try{
                $sql_todos  = "SELECT * FROM chamados_totais
                            WHERE Data_Atendimento = '".$dia."' 
                              AND Situacao = 'A' 
                ";     
                $resultados = $conn->query( $sql_todos . ";" );    
        
                $total_dia = $resultados->rowCount();               
                $usuarios = [];
                $quantidades=[];
                $finalizados=[];      
               
        
                while($row = $resultados->fetch(PDO::FETCH_ASSOC)) {
                    
                    $usuarios[] = $row['Atendente']  ;
                    $quantidades[]= $row['Total_Atendente']; 
                    if( $row['Total_Finalizados'] < 1){
                        $finalizados[]= 0;      
                    }else{
                        $finalizados[]= $row['Total_Finalizados'];      
                    }
                          
                }/**/
                $nomes = implode(',', $usuarios);
                $quantidades = implode (',', $quantidades);
                $finalizados = implode(',', $finalizados);        
                          
            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            $dados = "[" . $nomes . "];[".$quantidades . "];[". $finalizados ."];" ;
           // $dados = "[5,0];[3,2];[0,0];";




           // $dados = [30, 20, 40];
            break;
        case '3':
            $dados = [25,35, 45];
            break;
        case '4':
            $dados = [18, 32, 46];
            break;
    }

    echo json_encode( $dados);

?>