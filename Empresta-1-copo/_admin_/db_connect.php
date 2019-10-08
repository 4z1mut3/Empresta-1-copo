<?php
// Conexão com banco de dados
$servername = "localhost";
$username = "u849859222_adm";
$password = "copoadmin";
$db_name = "u849859222_emp_um_copo";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(!$connect):
	echo "Falha na conexão: ".mysqli_connect_error();
endif;