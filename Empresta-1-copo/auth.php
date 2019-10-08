<?php

//Conexão
//require_once 'db_connect.php';
date_default_timezone_set('America/Sao_Paulo');

    //echo ("<script>location.href='admin_scam.php';</script>");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $key = $_POST["key"];
        $tempo = $_POST["tempo"];
        $tamanho = $_POST["tamanho"];
        $status = 1;
        $data_emprestimo = date('Y/m/d H:i');
        $data_entrega = date('d/m/Y', strtotime($data_emprestimo. ' + 2 days'));
        $quantidade_de_pedidos_abertos=0;
        $aptidao = TRUE;
        // echo $data_entrega;
        // echo $key;
        // echo $tempo;
        // echo $tamanho;
       
    }
    
$username = "u849859222_adm";
$password="copoadmin";
    
    try {
        
        $pdo = new PDO('mysql:host=localhost;dbname=u849859222_emp_um_copo', $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Procura key no chave no banco
        $cunsulta_id_voucher = $pdo->prepare('SELECT Id_Voucher FROM Voucher WHERE Num_Voucher = :key');
        $cunsulta_id_voucher->execute(array(':key'=>$key));
        $cunsulta_id_voucher_ = $cunsulta_id_voucher ->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($cunsulta_id_voucher_ as $item){
                $Id_Voucher = $item['Id_Voucher'];
                //echo $Id_Voucher;
            }
            
            
            
            
            
        $cunsulta_id_usuario = $pdo->prepare('SELECT * FROM Usuario');
        $cunsulta_id_usuario->execute();
        $cunsulta_id_usuario_ = $cunsulta_id_usuario ->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($cunsulta_id_usuario_ as $item){
              
               $id_usuario = $item['Id_Usuario'];
               $nome_usuario = $item['Nome'];
               $cod_instituicao = $item['Instituicao'];
               $numero_matricula = $item['Num_Matricula'];
               
                if($cod_instituicao == 1 || $cod_instituicao == "1" ){
                   $instituicao_usuario ="Universidade Federal Rural da Amazonia.";
                }
                
            
            
                if(md5($id_usuario) == $key){
                    
                    
                    $consulta_pedidos_ativos = $pdo->prepare('SELECT * FROM `Pedido` WHERE Voucher_pedido = :key_pedido');
                    $consulta_pedidos_ativos ->execute(array(':key_pedido'=>$id_usuario));
                    $consulta_pedidos_ativos_ = $consulta_pedidos_ativos ->fetchAll(PDO::FETCH_ASSOC);
                    
                    $length_pedidos = count($consulta_pedidos_ativos_);
                    
                    for ($i = $length_pedidos-1; $i >= 0; $i--) {
                          //var_dump($consulta_pedidos_usuario_);
                            
                        list('Id_Pedidos' => $id_pedido, 'Tipo_Pedido' => $tipo_pedido,'Ativo' => $status_pedido,'Data_emprestimo' => $data_emprestimo,'Data_entrega' => $data_entrega) = $consulta_pedidos_ativos_[$i];
                          
                        if($status_pedido == 1 || $status_pedido == '1' ){
                            $str_status = 'Cliente possui emprestimos em aberto, ele deve validar a devoluções de emprestimos anteriores para continuar emprestando!';
                        $aptidao = FALSE;
                        echo '<script>alert("Nome usuario: '.$str_status.'");</script>'; 
                        echo ("<script>location.href='admin_scam.php';</script>");
                        
                        }
                    }
                    
                    if($aptidao == TRUE){
                        $insere_dados_pedido = $pdo->prepare('INSERT INTO Pedido (Tipo_Pedido, Ativo, Data_emprestimo, Data_entrega,Voucher_pedido,Tamanho) VALUES(:tempo,:status,:data_emprestimo,:data_entrega,:voucher_pedido,:tamanho)');
                        $insere_dados_pedido->bindParam(':tempo', $tempo);
                        $insere_dados_pedido->bindParam(':status', $status);
                        $insere_dados_pedido->bindParam(':data_emprestimo', $data_emprestimo);
                        $insere_dados_pedido->bindParam(':data_entrega', $data_entrega);
                        $insere_dados_pedido->bindParam(':voucher_pedido', $key);
                        //$insere_dados_pedido->bindParam(':voucher_id_voucher', $id_Voucher);
                        $insere_dados_pedido->bindParam(':tamanho', $tamanho);
                        
                        
                        if($insere_dados_pedido->execute()){
                        
                            echo '<script>alert("Nome usuario: '.$nome_usuario.'\nInstituicao: '.$instituicao_usuario.'\nMatricula: '.$numero_matricula.'\nData emprestimo: '.$data_emprestimo.'\nData entrega: '.$data_entrega.'");</script>';
                            echo ("<script>location.href='admin_scam.php';</script>");

                        } 
                    }
                              
                   
                }
            }
             
} catch(PDOException $e) {
  
     echo 'Error: ' . $e->getMessage();
    
        

    
}
  
    
    

  
?>
  