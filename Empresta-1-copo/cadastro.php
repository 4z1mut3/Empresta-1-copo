<?php
  include_once "db_connect.php";
  
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instituicao = $_POST["instituicao"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["CPF"];
	$num_mat = $_POST["NumMatricula"];   
	$senha= md5($_POST["senha"]);        
    $nome = $nome ." ". $sobrenome; 
  




                try {
                    
                    $pdo = new PDO('mysql:host=localhost;dbname=u849859222_emp_um_copo', $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    
                    $cadastrar_usuario = $pdo->prepare('INSERT INTO Usuario (Nome, Num_Matricula, Cpf, Email,Senha,Instituicao,Telefone) VALUES(:nome,:numero_matricula,:cpf,:email,:senha,:instituicao,:telefone)');
                    
                    
                    
                    $cadastrar_usuario->bindParam(':nome', $nome);
                    $cadastrar_usuario->bindParam(':numero_matricula', $num_mat);
                    $cadastrar_usuario->bindParam(':cpf', $cpf);
                    $cadastrar_usuario->bindParam(':email', $email);
                    $cadastrar_usuario->bindParam(':senha', $senha);
                    $cadastrar_usuario->bindParam(':instituicao', $instituicao);
                    $cadastrar_usuario->bindParam(':telefone', $telefone);
                    
                     $cadastrar_usuario->execute();                  
                       
                   
                       
                        
                    if($cadastrar_usuario){
       
                        echo '<script>alert("Usuário cadastrado com sucesso!");</script>';  
                        echo ("<script>location.href='login.php';</script>");
                    }else{
                        echo "Não Funciona";
                        echo ("<script>location.href='register.html';</script>");
                    }
                } catch(PDOException $e) {
                   echo 'Error: ' . $e->getMessage();
                }

}
?>