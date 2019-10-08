<?php
  include_once "db_connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instituicao = $_POST["instituicao"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];


    $num_mat = $_POST["NumMatricula"];
    $senha= md5($_POST["senha"]);
    $nome = $nome ." ". $sobrenome;

    $seleciona_ultimo_id_admin = "SELECT Max(idadmin) FROM admin";
    $ultimo_id_admin = mysqli_query($connect,$seleciona_ultimo_id_admin);
    $id_novo_usuario = $ultimo_id_admin +1;
    


                try {

                    $pdo = new PDO('mysql:host=localhost;dbname=u849859222_emp_um_copo', $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $cadastrar_usuario = $pdo->prepare('INSERT INTO admin (idadmin,admin_instituicao, admin_matricula, Nome_admin, Email_admin,Senha_admin) VALUES(:idadmin,:instituicao_admin,:matricula_admin,:nome_admin,:email_admin,:senha_admin)');
                    $cadastrar_usuario->bindParam(':idadmin', $id_novo_usuario);
                    $cadastrar_usuario->bindParam(':nome_admin', $nome);
                    $cadastrar_usuario->bindParam(':matricula_admin', $num_mat);

                    $cadastrar_usuario->bindParam(':email_admin', $email);
                    $cadastrar_usuario->bindParam(':senha_admin', $senha);
                    $cadastrar_usuario->bindParam(':instituicao_admin', $instituicao);


                    $cadastrar_usuario->execute();




                    if($cadastrar_usuario){

                        echo '<script>alert("Usuário cadastrado com sucesso!");</script>';
                        //echo ("<script>location.href='login_adm.php';</script>");
                    }else{
                        echo "Não Funciona";
                        //echo ("<script>location.href='register.html';</script>");
                    }
                } catch(PDOException $e) {
                   echo 'Error: ' . $e->getMessage();
                }

}
?>
