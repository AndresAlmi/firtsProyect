<?php
require_once "../../class/Sexo.php";
require_once "../../class/perfil.php";
require_once "../../class/usuario.php";

$listadoSexo = Sexo::obtenerTodos();
$listadoPerfil = perfil::obtenerTodos();
$idUsuario = $_GET["id_usuario"];
$usuariom = usuario::obtenerPorId($idUsuario);
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
<html lang = "es">
<head>
	<title>Modificar Usuario</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
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
		<?php echo $mensaje; ?>
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioUsuario">
			
			<input type = "hidden" name = "txtUsuario" value = "<?php echo $usuariom->getIdUsuario()?>">

			<div class="formulario_grupo" id="grupo_password">	
				<label for = "password" class = "formulario_label"> Contraseña: </label>
				<div class="formulario_grupo-input">
					<input type="password" onkeyup="validarPassword();" name="txtPassword" id="txtPassword" placeholder = "Contraseña" class = "formulario_input">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Puede contener letras, guiones o numeros, debe ser mayor a 3 y menor a 12</p>

			</div>
			

			<div class="formulario_grupo" id="grupo_nombre">	
				<label for = "nombre" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarNombre()" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" value = "<?php echo $usuariom->getNombre()?>">

				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 12</p>

			</div>

			<div class="formulario_grupo" id="grupo_apellido">	
				<label for = "apellido" class = "formulario_label"> Apellido: </label>
				<div class="formulario_grupo-input">
					<input type="text" onkeyup="validarApellido();" name="txtApellido" id="txtApellido" class = "formulario_input" value = "<?php echo $usuariom->getApellido()?>">

				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 12</p>

			</div>

			<div class="formulario_grupo" id="grupo_dni">	
				<label for = "dni" class = "formulario_label"> DNI: </label>
				<div class="formulario_grupo-input">
					<input type="number" onkeyup="validarDni();" id="txtDni" name = "txtDni" class = "formulario_input" value = "<?php echo $usuariom->getDni()?>">

				</div>
				<p class="formulario_input-error">Solo puede contener numeros, debe ser mayor a 7 y menor a 10</p>

			</div>

			<div class="formulario_grupo" id="grupo_fechanacimiento">	
				<label for = "FechaNacimiento" class = "formulario_label"> Fecha Nacimiento: </label>
				<div class="formulario_grupo-input">		
					<input type="date" name="txtFechaNacimiento" class = "formulario_input" value = "<?php echo $usuariom->getFechaNacimiento()?>">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_sexo">	
				<label for = "Sexo" class = "formulario_label"> Sexo: </label>
				<div class="formulario_grupo-input">
					<select name="cboSexo" onchange="validarSexo()" id="cboSexo" class = "formulario_input">
						<option value="NULL">---Seleccionar---</option>
						<?php foreach ($listadoSexo as $sexo): ?>

						<?php
						$selected = "";

						if ($sexo->getDescripcion() == $usuariom->getIdSexo()) {
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

			<div class="formulario_grupo" id="grupo_perfil">	
				<label for = "Perfil" class = "formulario_label"> Perfil: </label>
				<div class="formulario_grupo-input">	
					<select name="cboPerfil" onchange="validarPerfil();"id = "cboPerfil" class = "formulario_input">

					<option value="NULL">---Seleccionar---</option>

							<?php foreach ($listadoPerfil as $perfil):
							
							$selected = "";

							if ($perfil->getIdPerfil() == $usuariom->getIdPerfil()) {
								$selected = "SELECTED";
							}
							?>

							<option <?php echo $selected; ?> value="<?php echo $perfil->getIdPerfil(); ?>">
								<?php echo $perfil->getDescripcion(); ?>
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
	</div>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>

</body>
</html>