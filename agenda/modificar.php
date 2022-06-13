<?php

	require_once "../../class/agenda.php";


	$id_agenda = $_GET["id_agenda"];

	$agenda = Agenda::obtenerPorId($id_agenda);
	$idTaller = $agenda->getIdTaller();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Agenda</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="stylesheet" href="../../styles/footer.css">
	
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
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioAgenda">
				<input type="hidden" name="txtidagenda" value="<?php echo $id_agenda; ?>">
				<input type="hidden" name="txtidtaller" value="<?php echo $idTaller; ?>">

				<div class="formulario_grupo" id="grupo_fechaInicio">
					<label for = "fechaInicio" class = "formulario_label"> Fecha de Inicio: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="date" name="txtfechaInicio" id="txtfechaInicio"  value="<?php echo $agenda->getfechainicio(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>
				<div class="formulario_grupo" id="grupo_fechafin">
					<label for = "fechafin" class = "formulario_label"> Fecha de Fin: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="date" name="txtfechafin" id="txtfechafin" value="<?php echo $agenda->getfechafin(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>
				<div class="formulario_grupo" id="grupo_horainicio">
					<label for = "horainicio" class = "formulario_label"> Hora de Inicio: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="time" name="txthorainicio" id="txthorainicio" value="<?php echo $agenda->gethorainicio(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>
				<div class="formulario_grupo" id="grupo_horafin">
					<label for = "horafin" class = "formulario_label"> Hora de Fin: </label>
					<div class="formulario_grupo-input">
						<input class = "formulario_input" type="time" name="txthorafin" id="txthorafin"  value="<?php echo $agenda->gethorafin(); ?>">
						<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
					</div>
				</div>
					
				<div class="formulario_grupo" id="grupo_estado">
					<label for = "estado" class = "formulario_label"> Estado: </label>
					<div class="formulario_grupo-input">
						<select class="Cboestado" name="Cboestado" id = "Cboestado" style="width: 100%">
							<?php if ($agenda->getestado() == "ocupado"){ 
								echo "<option value = 'ocupado'>Ocupado</option>";
								echo "<option value = 'disponible'>Disponible</option>";
							} else if ($agenda->getestado() == "disponible"){
								echo "<option value = 'disponible'>Disponible</option>";
								echo "<option value = 'ocupado'>Ocupado</option>";
							} else{
								echo "<option value = ''>--Seleccione</option>";
								echo "<option value = 'disponible'>Disponible</option>";
								echo "<option value = 'ocupado'>Ocupado</option>";
							}
							?>
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