<?php
// Conexão
require_once 'db_connect.php';



//$key = "";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta name="theme-color" content="#343A40">
    <meta name="apple-mobile-web-app-status-bar-style" content="#343A40">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Empresta o copo - Administrador</title>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

   <nav class="navbar navbar-expand navbar-dark static-top shadow-lg " id="barra-de-navegacao"
        style="background-color:#343A40;">

        <button class="btn btn-link btn-sm text-white " id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>


        <a class="navbar-brand mr-1" href="index.php">Empresta o copo</a>

        
        

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0 container-fluid justify-content-end">

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw active"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Configurações</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" action="logout.php"
                        data-target="#logoutModal">Sair</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="admin_index.php">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <li class=" nav-item active">
                <a class="nav-link" href="admin_scam.php.php">
                    <i class="fa fa-qrcode" aria-hidden="true"></i>
                    <span>Autenticar</span></a>
            </li>

        </ul>

        <div id=" content-wrapper">




<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fa fa-qrcode" id="exampleModalLabel">&nbsp;&nbsp;Aproxime o QR Code.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <video id="preview" class="col-md-6"></video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       
      </div>
    </div>
  </div>
</div>


     
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Emprestar</div>
            <div class="card-body">


                <form action="auth.php" method="POST" id="auth">
                    <div class="form-group">
                        <div class="form-label-group">
                           <div class="input-group mb-3">
                               <input type="hidden" name="key" id="key">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="tamanho">Tamanho</label>
                              </div>
                              <select class="custom-select" name="tamanho" id="tamanho">
                                <option value="250 ml">250 ml</option>
                                <option value="400 ml">400 ml</option>
                                <option value="600 ml">600 ml </option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="tempo">Plano</label>
                              </div>
                              <select class="custom-select" id="tempo" name="tempo">
                                <option value="gratuito">Gratuito</option>
                                <option value="plano_1">Plano 1</option>
                                <option value="plano_1">Plano 2</option>
                              </select>
                            </div>
                        </div>
                    </div>
                 
                  <!-- Botão para acionar modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
  Validar emprestimo
</button>
                </form>
                
            </div>
        </div>
    </div>


           
            <script type="text/javascript">
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });
            
            scanner.addListener('scan', function(content) {
               
               document.getElementById("key").value = content;
               document.getElementById("auth").submit();
           
            });
            
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[1]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
            </script>
            <form action="auth.php" method="POST" id="auth">
                <input type="hidden" name="key" id="key">
                
            </form>
        </div>
        <!-- /#wrapper -->
            
        
            
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
        
        
        <script src="./bower_components/axios/dist/axios.js"></script>
        <script>
        axios.get('https://api.github.com/users/codeheaven-io');
        </script>

</body>

</html>