<?php 
require_once "../../class/agenda.php";
require_once "../../class/taller.php";
$idTaller = $_GET["id_taller"];

$listadoTaller = taller::obtenerTodos();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nueva Agenda</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/formularios.js"></script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>

	<section class="contenedorFormularios">
		<h1><a href="listado.php?id_taller=<?php echo $idTaller;?>">AGENDA</a></h1>

		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioAgenda">
			<div class="formulario_grupo" id="grupo_fechaInicio">
				<label for = "fechaInicio" class = "formulario_label"> Fecha de Inicio: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="date" name="txtfechaInicio" id="txtfechaInicio">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_fechafin">
				<label for = "fechafin" class = "formulario_label"> Fecha de Fin: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="date" name="txtfechafin" id="txtfechafin">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_horainicio">
				<label for = "horainicio" class = "formulario_label"> Hora de Inicio: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="time" name="txthorainicio" id="txthorainicio">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_horafin">
				<label for = "horafin" class = "formulario_label"> Hora de Fin: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="time" name="txthorafin" id="txthorafin">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
				
			<div class="formulario_grupo" id="grupo_estado">
				<label for = "estado" class = "formulario_label"> Estado: </label>
				<div class="formulario_grupo-input">
					<select class="Cboestado" name="Cboestado" id = "Cboestado" style="width: 100%">
						
						<option value = 'NULL'>Seleccionar</option>
						<option value = 'ocupado'>Ocupado</option>
						<option value = 'disponible'>Disponible</option>

					</select>
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_taller">
				<label for = "taller" class = "formulario_label"> Taller: </label>
				<div class="formulario_grupo-input">
					<select class="cboTaller" name="cboTaller" id = "cboTaller" style="width: 100%">

						<option value = "0">Seleccionar</option>
						<?php foreach ($listadoTaller as $taller):  ?>
						<option value="<?php echo $taller->getIdTaller();?>">
							<?php echo $taller->getNombre(); ?>
						<?php endforeach ?>

					</select>
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