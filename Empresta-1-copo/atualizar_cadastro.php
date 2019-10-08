<?php
  
  // Conexão
require_once 'db_connect.php';


// Sessão
session_start();

// Verificação
if(!isset($_SESSION['logado'])):
	//header('Location: login.php');
	echo ("<script>location.href='login.php';</script>");
endif;

    // Dados
    $id_usuario = $_SESSION['Id_Usuario'];
    $sqli = "SELECT * FROM Usuario WHERE Id_Usuario = '$id'";
    $resultado = mysqli_query($connect, $sqli);
    $dados = mysqli_fetch_array($resultado);
    
    

  
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    
	
	$senha= md5($_POST["senha"]);        
    $nome = $nome ." ". $sobrenome; 
  

    $atualiza_nome = "UPDATE Usuario SET Nome = '".$nome."'WHERE Id_Usuario = ".$id_usuario;
    $atualiza_email = "UPDATE Usuario SET Email = '".$email."'WHERE Id_Usuario = ".$id_usuario;
    $atualiza_telefone = "UPDATE Usuario SET Telefone = '".$telefone."'WHERE Id_Usuario = ".$id_usuario;
    $atualiza_senha = "UPDATE Usuario SET Senha = '".$senha."'WHERE Id_Usuario = ".$id_usuario;
    
    if(mysqli_query($connect,$atualiza_nome) && mysqli_query($connect,$atualiza_email) && mysqli_query($connect,$atualiza_telefone) && mysqli_query($connect,$atualiza_senha)){
        echo '<script>alert("Dados Atualizados com sucesso!");</script>'; 
        echo ("<script>location.href='index.php';</script>");
    }else{
        echo '<script>alert("No momento não foi possivel atualizar seus dados, por favor tente mais tarde!");</script>'; 
        //echo ("<script>location.href='index.php';</script>");
    }
    
    
}
?>