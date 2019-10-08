<?php
require_once 'db_connect.php';
//Conexão
//require_once 'db_connect.php';
date_default_timezone_set('America/Sao_Paulo');

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $key = $_POST["keyE"];
        $descricao =   $_POST["descricao"]; 
        $estado =   $_POST["estado"]; 
        //$tempo = $_POST["tempo"];
        //$tamanho = $_POST["tamanho"];
       $status = 0;
        // $data_emprestimo = date('Y/m/d H:i');
        $data_entregou = date('Y/m/d H:i');
        //echo $data_entrega;
        //echo $key;
        // echo $tempo;
        // echo $tamanho;
       
    }
    
$username = "u849859222_adm";
$password="copoadmin";
    
   
            
   try{         
        $pdo = new PDO('mysql:host=localhost;dbname=u849859222_emp_um_copo', $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta_pedidos_usuario = $pdo->prepare("SELECT * FROM Pedido WHERE Voucher_pedido = :key");
        $consulta_pedidos_usuario -> bindParam(':key', $key);
        $consulta_pedidos_usuario -> execute();
        $consulta_pedidos_usuario_ = $consulta_pedidos_usuario ->fetchAll(PDO::FETCH_ASSOC);
        
        if($consulta_pedidos_usuario){
                        
                        $length = count($consulta_pedidos_usuario_);
                        $pedidos_abertos = 0;
                        for ($i =  $length-1; $i >= 0; $i--) {
                          //var_dump($consulta_pedidos_usuario_);
                            
                            list('Id_Pedidos' => $id_pedido, 'Tipo_Pedido' => $tipo_pedido,'Ativo' => $status_pedido,'Data_emprestimo' => $data_emprestimo,'Data_entrega' => $data_entrega) = $consulta_pedidos_usuario_[$i];
                          
                            if($status_pedido == 1 || $status_pedido == '1' ){
                                $str_status = 'aberto';
                                $pedidos_abertos += 1;
                                
                                $sql1 = "UPDATE Pedido SET Ativo = '".$status."'WHERE Id_Pedidos = ".$id_pedido;
                                $sql2 = "UPDATE Pedido SET Estado = '".$estado."'WHERE Id_Pedidos = ".$id_pedido;
                                $sql3 = "UPDATE Pedido SET Data_entregou = '".$data_entregou."'WHERE Id_Pedidos = ".$id_pedido;
                                $sql4 = "UPDATE Pedido SET Descricao_entrega = '".$descricao."'WHERE Id_Pedidos = ".$id_pedido;
                                
                                
                                    
                                //    $insere_relatorio_de_entrega = $pdo->prepare("INSERT INTO `Pedido` (,,) VALUES (:estado,:data_entregou,:descricao)");
                                //    $insere_relatorio_de_entrega->bindParam(':estado', );
                                //    $insere_relatorio_de_entrega->bindParam(':data_entregou', );
                                //   $insere_relatorio_de_entrega->bindParam(':descricao', );
                               
                                    
                                    
                                if(mysqli_query($connect,$sql1) && mysqli_query($connect,$sql2) && mysqli_query($connect,$sql3) && mysqli_query($connect,$sql4)){
                                    
                                    
                                     
                                    $msg = "Devolução autenticada com sucesso!";
                                    echo '<script>alert("'.$msg.'");</script>'; 
                                    echo ("<script>location.href='admin_scam.php';</script>");
                                }else{
                                    $msg = "Erro ao atualizar!";
                                    echo '<script>alert("'.$msg.'");</script>'; 
                                }
                            }
                            
                            
                    }
                    
                    
                    if($pedidos_abertos == 0){
                                echo '<script>alert("O usuário não possui pedidos!");</script>'; 
                                echo ("<script>location.href='admin_scam.php';</script>");
                            }else{
                                if($pedidos_abertos >= 1){
                                    
                            }else{
                                if($pedidos_abertos > 1){
                                    echo '<script>alert("O usuário possui mais de um pedido aberto, solicite regularização do mesmo junto a equipe de desenvolvimento!");</script>'; 
                                }
                            }
                        }    
        }else{
            echo "Não Funciona";
        }   
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    }
      
    
    

  
?>
  