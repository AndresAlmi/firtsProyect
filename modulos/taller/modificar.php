<?php
require_once "../../class/taller.php";
$idTaller = $_GET["id_taller"];

$taller = taller::obtenerPorId($idTaller);

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formulariosM.js"></script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<h1><a href="listado.php"><?php echo $taller->getNombre();?></a></h1>
		<form action="procesar_modificar.php" method="POST" class="formulario" id="formularioTaller">
			<input type = "hidden" name ="txtIdTaller" value = "<?php echo $idTaller; ?>">

			<div class="formulario_grupo" id="grupo_nombre">
				<label for = "nombre" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarNombre2()" value="<?php echo $taller->getNombre();?>" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" placeholder= "Ej. MiTaller">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Puede contener letras,numeros, y debe ser mayor a 3 y menor a 15</p>
			</div>

			<div class="formulario_grupo" id="grupo_cantidad">
				<label for = "cantidad" class = "formulario_label"> Turnos habilitados por dia: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarCantidad()" value="<?php echo $taller->getMaxTurno();?>" class = "formulario_input" type="number" name="txtMaxTurno" id="cantidad" placeholder= "Ej. 1, 2, 3.. 100">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener numeros, debe ser mayor a 1</p>
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
