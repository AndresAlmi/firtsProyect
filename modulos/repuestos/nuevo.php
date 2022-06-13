<?php

require_once "../../class/MySQL.php";
require_once "../../class/marcaRepuesto.php";
require_once "../../class/tipoRepuesto.php";

$listadoTipoRepuesto = tipoRepuesto::ObtenerTodos();
$listadoMarca = MarcaRepuesto::obtenerTodos();

?>


<!DOCTYPE html>
<html>
<head>
<title>Nuevo Repuesto</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>
	<script>
		$(document).ready(function() {
			$(".cboTipoRepuesto").select2({
				placeholder: 'Seleccionar',
				width: 'resolve',
			});
			$(".cboMarca").select2({
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
		<h1><a href="listado.php">Repuestos</a></h1>
		<h2>Se Instancian Los Repuestos en 0</h2>
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioRepuesto">

			<div class="formulario_grupo" id="grupo_marca">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input">
					<select onchange = "validarMarca();" class="cboMarca" name="cboMarca" id = "cboMarca" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach ($listadoMarca as $marca): ?>

							<option value="<?php echo $marca->getIdMarca(); ?>">
								<?php echo $marca->getDescripcionMa(); ?>
							</option>

						<?php endforeach ?>

					</select>
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_tipoRepuesto">
				<label for = "TipoRepuesto" class = "formulario_label"> Tipo Repuesto: </label>
				<div class="formulario_grupo-input">
					<select onchange="validarTipoRepuesto();" class="cboTipoRepuesto" name="cboTipoRepuesto" id = "cboTipoRepuesto" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach($listadoTipoRepuesto as $tipoRepuesto):?>

							<option value="<?php echo $tipoRepuesto->getIdTipoRepuesto()?>">
								<?php echo $tipoRepuesto->getDescripcionM()?>
							</option>

						<?php endforeach;?>
					</select>
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
				
				
			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDescripcion()" class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
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