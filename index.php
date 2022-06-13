<?php

require_once "configs.php";


$mensaje = "";

if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == ERROR_LOGIN_CODE) {

		$mensaje = ERROR_LOGIN_MENSAJE;

	} else if ($error == MENSAJE_CODE) {

		$mensaje = MENSAJE_NECESITA_LOGIN;
		
	}

}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesion</title>
	<!--<script src = "js/validar.js"></script>-->
	<link rel= "shortcut icon" href="img/icon.png">
	<link rel="StyleSheet" href = styles/formInicioSesion.css>
</head>
<body>
	<div class="contenedorLogo">
		<header>
			<div class = "logo">
				<img src="img/Logo2.0.png" width = "250px"  height = "250px">
			</div>
		</header>
	</div>
	<div class="contenedorForm">
		<section class = "formulario">
			<form method="POST" action="modulos/usuarios/procesar_login.php">
				<legend>Inicio de Sesion</legend>
				<fieldset>
					
					<label for="username">Usuario: </label>
					<input type="text" name="txtUsername" placeholder="usuario">
					<label for="Password">Contraseña: </label>
					<input type="password" name="txtPassword" placeholder="contraseña">
					
				</fieldset>
				<button onclick="validar();" type="submit">Iniciar Sesion</button>
			</form>
		</section>
	</div>

</body>
</html>