<?php
// Conexão
require_once 'db_connect.php';

// Sessão
session_start();

// Botão enviar
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if(isset($_POST['lembrar-senha'])):

		setcookie('login', $login, time()+3600);
		setcookie('senha', md5($senha), time()+3600);
	endif;

	if(empty($login) or empty($senha)):
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	else:
		

		$sql = "SELECT Email FROM Usuario WHERE Email = '$login'";
		$resultado = mysqli_query($connect, $sql);		

		if(mysqli_num_rows($resultado) > 0):
		$senha = md5($senha);       
		$sql = "SELECT * FROM Usuario WHERE Email = '$login' AND Senha = '$senha'";
		$resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['Id_Usuario'] = $dados['Id_Usuario'];
				header('Location: index.php');
			else:
				$erros[] = "<li> Usuário e senha não conferem </li>";
			endif;

		else:
			$erros[] = "<li> Usuário inexistente </li>";
		endif;

	endif;

endif;
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="theme-color" content="#5F9EA0">
    <meta name="apple-mobile-web-app-status-bar-style" content="#5F9EA0">

    <title>Empresta o copo</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="" style="background-color:#5F9EA0;">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Empresta um Copo - Login </div>
            <div class="card-body">
                <?php 
if(!empty($erros)):
	foreach($erros as $erro):
		echo $erro;
	endforeach;
endif;
?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="login" class="form-control" placeholder="Email" required="required"
                                autofocus="autofocus" name="login" id="login"
                                value="<?php echo isset($_COOKIE['login']) ? $_COOKIE['login'] : '' ?>">
                            <label for="login">Email</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="senha" class="form-control" placeholder="Senha"
                                required="required" name="senha" id="senha"
                                value="<?php echo isset($_COOKIE['senha']) ? $_COOKIE['senha'] : '' ?>">
                            <label for="senha">Senha</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="Lembrar senha" name="lembrar-senha">
                                Relembrar senha
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="btn-entrar" id="btn-entrar" class="btn btn-success btn-block">Entrar</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.html">Criar conta</a>
                    <a class="d-block small" href="forgot-password.html">Esqueceu sua senha?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>