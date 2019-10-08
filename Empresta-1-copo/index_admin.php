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
    $id = $_SESSION['idadmin'];
    $sqli = "SELECT * FROM admin WHERE idadmin = '$id'";
    $resultado = mysqli_query($connect, $sqli);
    $dados = mysqli_fetch_array($resultado);


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <meta name="theme-color" content="#008B8B">
    <meta name="apple-mobile-web-app-status-bar-style" content="#008B8B">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Empresta o copo</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top" >

    <nav class="navbar navbar-expand navbar-dark navbar-static-top  shadow-lg " id="barra-de-navegacao"
        style="background-color:#008B8B;position:fixed;width:100%;z-index:2;">

        <button class="btn btn-link btn-lg text-white " id="sidebarToggle" href="#">
            <i class="fas fa-bars mr-1"></i>
        </button>


        <a class="navbar-brand mr-1" href="index.php">Empresta o copo</a>




         <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0 container-fluid justify-content-end">

            <li class="nav-item dropdown arrow">
                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw active"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" action="logout.php"
                        data-target="#alterCadModal">Alterar cadastro</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" action="logout.php"
                        data-target="#logoutModal">Sair</a>
                </div>
            </li>
        </ul>

    </nav>


<br><br>
    <div id="wrapper" class="" >
    <div class="sidebar" style="background-color:#008B8B;position:relative;">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav" style="background-color:#008B8B;">
        <br><br>

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="charts.php">
                    <i class="fa fa-qrcode"></i>
                    <span>Emprestar</span></a>
            </li>

        </ul>
    </div>
        <div id=" content-wrapper"  style="margin:0;padding:0;" >

            <div class="" >


                <div class="container-fluid"  style="margin:0;padding:0;" >
                   


            <!-- /#wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="background-color:#5F9EA0;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo sair?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-primary" href="logout.php">Sair</a>
                        </div>
                    </div>
                </div>
            </div>


             <!-- Modal alterar cadastro -->
<div class="modal fade" id="alterCadModal" style="background-color:#5F9EA0;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar dados Cadastrais</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="atualizar_cadastro.php">
          <div class="form-group">
            <div class="form-row">
                   <div class="col-md-6">

                <div class="form-label-group">
                  <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required="required"
                    autofocus="autofocus">
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome"
                    required="required">
                  <label for="sobrenome">Sobrenome</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required">
              <label for="email">Email</label>
            </div>
            <div class="form-label-group">
              <input type="text" id="telefone" name="telefone" class="form-control" maxlength="15" placeholder="Telefone" required="required">
              <label for="telefone">Telefone</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"
                    required="required">
                  <label for="senha">Senha</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                   <input type="password" id="confirmarSenha" class="form-control" placeholder="confirmarSenha"
                    name="confirmarSenha" required="required">
                   <label for="confirmarSenha">Confirmar senha</label>
                </div>
                <!--ID_USUARIO-->
                   <input type="hidden" id="id_usuario" name="id_usuario" required="required" value="<?$id?>">
              </div>
            </div>
          </div>
          <button style="float:right;" type="button" class="btn btn-secondary m-1" data-dismiss="modal">Fechar</button>
          <button style="float:right;" type="submit" class="btn btn-primary m-1">Salvar</button>

        </form>
      </div>

    </div>
  </div>
</div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Page level plugin JavaScript-->
            <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin.min.js"></script>

            <!-- Demo scripts for this page-->
            <script src="js/demo/datatables-demo.js"></script>
            <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
