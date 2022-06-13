<?php

require_once "../../class/Empleado.php";
require_once "../../class/Sexo.php";

$listadoSexo = Sexo::obtenerTodos();

$id_empleado = $_GET["id_empleado"];

$empleado = Empleado::obtenerPorId($id_empleado);
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
	<title>Modificar Empleado</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formulariosM.js "></script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<?php echo $mensaje; ?>
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioUsuario">
			<input type="hidden" name="txtIdEmpleado" value="<?php echo $id_empleado; ?>">

			<div class="formulario_grupo" id="grupo_nombre">	
				<label for = "nombre" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
				<input onkeyup = "validarNombre()" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" value = "<?php echo $empleado->getNombre()?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">

				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>

			</div>

			<div class="formulario_grupo" id="grupo_apellido">	
				<label for = "apellido" class = "formulario_label"> Apellido: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarApellido()" class = "formulario_input" type="text" name="txtApellido" id="txtApellido" value = "<?php echo $empleado->getApellido()?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>

			</div>

			<div class="formulario_grupo" id="grupo_dni">	
				<label for = "dni" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDni()" class = "formulario_input" type="number" name="txtDni" id="txtDni"  value = "<?php echo $empleado->getDni()?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo debe ingresar numeros.</p>

			</div>

			<div class="formulario_grupo" id="grupo_legajo">	
				<label for = "legajo" class = "formulario_label"> Numero de Legajo: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarLegajo()" class = "formulario_input" type="number" name="txtLegajo" id="txtLegajo" value="<?php echo $empleado->getNumeroLegajo(); ?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Numero no valido, debe ser mayor a 3</p>

			</div>
			
			<div class="formulario_grupo" id="grupo_fechanacimiento">	
				<label for = "FechaNacimiento" class = "formulario_label"> Fecha Nacimiento: </label>
				<div class="formulario_grupo-input">		
					<input type="date" name="txtFechaNacimiento" class = "formulario_input" value = "<?php echo $empleado->getFechaNacimiento()?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">

				</div>
			</div>
			<div class="formulario_grupo" id="grupo_fechaAlta">	
				<label for = "fechaAlta" class = "formulario_label"> Fecha de Alta: </label>
				<div class="formulario_grupo-input">		
					<input type="date" name="txtFechaAlta" class = "formulario_input" value="<?php echo $empleado->getFechaAlta(); ?>" readonly>
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_sexo">	
				<label for = "Sexo" class = "formulario_label"> Sexo: </label>
				<div class="formulario_grupo-input">
					<label for = "sexo"> Sexo: </label>
					<select onchange="validarSexo();" id = "cboSexo"  name="cboSexo">
						<option value="0">---Seleccionar---</option>

						<?php foreach ($listadoSexo as $sexo): ?>

							<?php

							$selected = "";

							if ($sexo->getIdSexo() == $empleado->getIdSexo()) {
								$selected = "SELECTED";
							}

							?>

							<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
								<?php echo $sexo->getDescripcion(); ?>
							</option>

						<?php endforeach ?>

					</select>
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