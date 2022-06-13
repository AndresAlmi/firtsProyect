<?php

require_once "../../class/servicio.php";


$id_servicio = $_GET["id_servicio"];

$servicio = Servicio::obtenerPorId($id_servicio);


?>

<!DOCTYPE html>
<html>
<head>
<title>Modificar Servicio</title>
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/formulariosM.js"></script>
	<script>
		$(document).ready(function() {
			$(".cboTipoServicio").select2({
				placeholder: 'Seleccionar',
				width: 'resolve',
			});
		});
		
	</script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioServicio">

			<input type="hidden" name="txtidservicio" value="<?php echo $id_servicio; ?>">
			
			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDescripcion()" class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "Ej. Jorge" value="<?php echo $servicio->getDescripcion(); ?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>
			
			<div class="formulario_grupo" id="grupo_duracion">
				<label for = "duracion" class = "formulario_label"> Duracion: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDuracion()" class = "formulario_input" type="text" name="txtDuracion" id="txtDuracion" placeholder= "Ej. " value="<?php echo $servicio->getDuracion();?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>

			<div class="formulario_grupo" id="grupo_precio">
				<label for = "precio" class = "formulario_label"> Precio: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarPrecio()" class = "formulario_input" type="text" name="txtPrecio" id="txtPrecio" placeholder= "Ej. " value="<?php echo $servicio->getPrecio();?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>

			<div class="formulario_grupo" id="grupo_tipoServicio">
					<label for = "tipoServicio" class = "formulario_label"> Tipo Servicio: </label>
					<div class="formulario_grupo-input">
						<select onchange="validarTipoServicio();" name="cboTipoServicio" id = "cboTipoServicio">

							<option value="">-------Seleccionar------</option>

							<?php foreach ($tipoServicio as $tipoServicio): ?>

								<?php
								$selected = "";

								if ($tipoServicio->getIdTipoServicio() == $Servicio->getIdTipoServicio()) {
									$selected = "SELECTED";
								}
								?>

								<option <?php echo $selected; ?> value="<?php echo $tipoServicio->getIdTipoServicio(); ?>">
									<?php echo $tipoServicio->getDescripcion(); ?>
								</option>

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