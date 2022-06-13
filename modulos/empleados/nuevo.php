<?php

require_once "../../class/Sexo.php";
require_once "../../class/taller.php";

$listadoSexo = Sexo::obtenerTodos();
$listadoTaller = taller::obtenerTodos();
$fechaActual = date("Y")."-".date("m")."-".date("d");
//echo $fechaActual;
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
	<title>Nuevo Empleado</title>

	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/select2funcion.js"></script>

</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
		<section class="contenedorFormularios">

		<form action="procesar_alta.php" method="POST" class="formulario" id="formularioEmpleado">
			
			<div class="formulario_grupo" id="grupo_nombre">
				<label for = "nombre" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarNombre()" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" placeholder= "Ej. Jorge">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>
			
			
			<div class="formulario_grupo" id="grupo_apellido">
				<label for = "apellido" class = "formulario_label"> Apellido: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarApellido()" class = "formulario_input" type="text" name="txtApellido" id="txtApellido" placeholder= "Ej. Ramirez">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>

			</div>

			<div class="formulario_grupo" id="grupo_dni">
				<label for = "dni" class = "formulario_label"> Dni: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDni()" class = "formulario_input" type="number" name="txtDni" id="txtDni" placeholder= "Ej. 32541326">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo debe ingresar numeros.</p>
			</div>

			<div class="formulario_grupo" id="grupo_legajo">
				<label for = "legajo" class = "formulario_label"> Legajo: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarLegajo()" class = "formulario_input" type="number" name="txtLegajo" id="txtLegajo" placeholder= "Ej. 32541326">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Numero no valido, debe ser mayor a 3</p>
			</div>

			<div class="formulario_grupo" id="grupo_sexo">
				<label for = "sexo" class = "formulario_label"> Sexo: </label>
				<div class="formulario_grupo-input">
					<select onchange="validarSexo();" name="cboSexo" id = "cboSexo" class="cboSexo" style="width:100%">

						<option value="">-------Seleccionar------</option>

						<?php foreach ($listadoSexo as $sexo): ?>

							<option value="<?php echo $sexo->getIdSexo(); ?>">
								<?php echo $sexo->getDescripcion(); ?>
							</option>

						<?php endforeach ?>

					</select>
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
			
			<div class="formulario_grupo" id="grupo_taller">
				<label for = "taller" class = "formulario_label"> Taller: </label>
				<div class="formulario_grupo-input">
					<select onchange="validarSexo();" name="cboTaller" id = "cboTaller" class="cboTaller" style="width:100%">

						<option value="">-------Seleccionar------</option>

						<?php foreach ($listadoTaller as $taller): ?>

							<option value="<?php echo $taller->getIdTaller(); ?>">
								<?php echo $taller->getNombre(); ?>
							</option>

						<?php endforeach ?>

					</select>
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_fechaNacimiento">
				<label for = "fechaNacimiento" class = "formulario_label"> Fecha de Nacimiento: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="date" name="txtFechaNacimiento" id="txtFechaNacimiento" >
					
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_fechaAlta">
				<label for = "fechaAlta" class = "formulario_label"> Fecha de Alta: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="date" value="<?php echo $fechaActual;?>" name="txtFechaAlta" id="txtFechaAlta" readonly>
				</div>
			</div>
			
			<div class="formulario_alerta">
				<p>Por favor rellena el formulario.</p>
			</div>

			<div class = "formulario_grupo formulario_grupo-btn-enviar">
				<button type="submit" class="formulario_btn">Guardar</button>
			</div>
		
			
		</form>
	</section>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>

</body>
</html>