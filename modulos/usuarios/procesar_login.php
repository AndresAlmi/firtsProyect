<?php

require_once "../../configs.php";
require_once "../../class/Usuario.php";


$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];


$usuario = Usuario::login($username, $password);

//highlight_string(var_export($usuario->perfil, true));
//exit;

if ($usuario->estaLogueado()) {
	
	session_start();
	$_SESSION['usuario'] = $usuario;
	header("location: ../../inicio.php");

} else {

	header("location: ../../index.php?error=" . ERROR_LOGIN_CODE);
}


?>