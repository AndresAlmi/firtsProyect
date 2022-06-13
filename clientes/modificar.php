<?php

require_once "../../class/cliente.php";
require_once "../../class/Sexo.php";
require_once "../../class/tipoCliente.php";

$id_cliente = $_GET["id_cliente"];
$tipoCliente = tipoCliente::obtenerTodos();
$listadoSexo = Sexo::obtenerTodos();
$clientee = cliente::obtenerPorId($id_cliente);

$mensaje = "";

if (isset($_GET["error"])){

	switch($_GET["error"]){
		case "nombre<>0":
			$mensaje = "Datos obligatorios.";
			break;
		case "nombre<3":
			$mensaje = "Requiere más de 3 caracteres.";
			break;
		case "dni":
			$mensaje = "Ingrese un numero valido.";
			break;
		case "sexo":
			$mensaje = "Seleccione una opción.";
			break;
		case "fechaAlta":
			$mensaje = "Fecha no valida.";
			break;
	}

}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Modificar Cliente</title>
		<meta charset="UTF-8">
		<meta name = "author" content="Andres Almiron">
		<link rel="StyleSheet" href = "../../styles/header.css">
		<link rel="StyleSheet" href = "../../styles/form.css">
		<link rel="StyleSheet" href = "../../styles/footer.css">
		<link rel= "shortcut icon" href="../../img/icon.png">
		<script src="../../js/jquery.3.6.js"></script>
		<script src="../../js/formulariosM.js"></script>
	</head>
	<body>
		<header>
			<?php require_once "../../header.php"?>
		</header>
		<nav>
			<?php require_once "../../menu.php"; ?>
		</nav>
		<section class="contenedorFormularios">

			<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioCliente">
				<input type="hidden" name="txtIdcliente" value="<?php echo $id_cliente; ?>">

				<div class="formulario_grupo" id="grupo_nombre">
					<label for = "nombre" class = "formulario_label"> Nombre: </label>
					<div class="formulario_grupo-input">
						<input onkeyup = "validarNombre()" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" placeholder= "Ej. Jorge" value="<?php echo $clientee->getNombre(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
					<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
				</div>
				
				
				<div class="formulario_grupo" id="grupo_apellido">
					<label for = "apellido" class = "formulario_label"> Apellido: </label>
					<div class="formulario_grupo-input">
						<input onkeyup = "validarApellido()" class = "formulario_input" type="text" name="txtApellido" id="txtApellido" placeholder= "Ej. Ramirez" value="<?php echo $clientee->getApellido(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
					<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>

				</div>

				<div class="formulario_grupo" id="grupo_dni">
					<label for = "dni" class = "formulario_label"> Dni: </label>
					<div class="formulario_grupo-input">
						<input onkeyup = "validarDni()" class = "formulario_input" type="number" name="txtDni" id="txtDni" placeholder= "Ej. 32541326" value="<?php echo $clientee->getDni(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
					<p class="formulario_input-error">Numero no valido.</p>
				</div>

				<div class="formulario_grupo" id="grupo_sexo">
					<label for = "sexo" class = "formulario_label"> Sexo: </label>
					<div class="formulario_grupo-input">
						<select onchange="validarSexo();" name="cboSexo" id = "cboSexo">

							<option value="">-------Seleccionar------</option>

							<?php foreach ($listadoSexo as $sexo): ?>

								<?php

								$selected = "";

								if ($sexo->getIdSexo() == $clientee->getIdSexo()) {
									$selected = "SELECTED";
								}

								?>

								<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
									<?php echo $sexo->getDescripcion(); ?>
								</option>

							<?php endforeach ?>

						</select>
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_tipoCliente">
					<label for = "tipoCliente" class = "formulario_label"> Tipo Cliente: </label>
					<div class="formulario_grupo-input">
						<select onchange="validarTipoCliente();" name="cboTipoCliente" id = "cboSexo">

							<option value="">-------Seleccionar------</option>

							<?php foreach ($tipoCliente as $tipoCliente): ?>

								<?php
								$selected = "";

								if ($tipoCliente->getTipoCliente() == $clientee->getTipoCliente()) {
									$selected = "SELECTED";
								}
								?>

								<option <?php echo $selected; ?> value="<?php echo $tipoCliente->getTipoCliente(); ?>">
									<?php echo $tipoCliente->getDescripcion(); ?>
								</option>

							<?php endforeach ?>

						</select>
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_fechaNacimiento">
					<label for = "fechaNacimiento" class = "formulario_label"> Fecha de Nacimiento: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="date" name="txtFechaNacimiento" id="txtFechaNacimiento"  value="<?php echo $clientee->getFechaNacimiento(); ?>">
						
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_fechaAlta">
					<label for = "fechaAlta" class = "formulario_label"> Fecha de Alta: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="date" name="txtFechaAlta" id="txtFechaAlta"  value="<?php echo $clientee->getFechaAlta(); ?>" readonly>
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>
				
				<div class="formulario_alerta">
					<p>Por favor rellena el formulario.</p>
				</div>

				
				<div class = "formulario_grupo-btn-enviar">
					<button type="submit" class="formulario_btn">Guardar</button>
				</div>
				
			</form>
		</section>
		<footer>
			<?php require_once "../../footer.php";?>
		</footer>
	</body>
</html>