<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Tipo Servicio</title>
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>

</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">

		<h1><a href="listado.php">Servicio</a></h1>

		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioTipoServicios">
			
			<div class="formulario_grupo btn-enviar" id="grupo_nombre">
				<label for = "nombre" class = "formulario_label"> Nombre: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="txtNombre" class="txtNombre formulario_label" id="txtNombre" > 
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
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
