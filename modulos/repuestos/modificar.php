<?php

require_once "../../class/MySQL.php";
require_once "../../class/marcaRepuesto.php";
require_once "../../class/repuestos.php";
require_once "../../class/taller.php";
$id = $_GET["id_Repuesto"];


$listadoMarca = MarcaRepuesto::obtenerTodos();
$tipoRepuesto = tipoRepuesto::ObtenerTodos();
$mostrar = "disable";
if(isset($_GET["id_taller"])){
	$idTaller= $_GET["id_taller"];
	$mostrar = "enable";
	$repuesto = repuestos::obtenerPorIdRepuestoYIdTaller($id,$_GET["id_taller"]);
	$taller = taller::obtenerPorId($_GET["id_taller"]);
}else{
	$repuesto = repuestos::obtenerPorIdRepuesto($id);
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Modificar Repuesto</title>
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
		<form action="procesar_modificar.php" method="POST" class="formulario" id="formularioRepuesto">
			<input type = "hidden" name = "txtIdRepuesto" value = "<?php echo $repuesto->getIdRepuesto();?>">
			<?php if($mostrar != "disable"){echo "<input type='hidden' name='txtIdTaller' value='$idTaller'>";}?>
			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarDescripcion()" class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "Ej. " value="<?php echo $repuesto->getDescripcion(); ?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input">
					<select onchange = "cargarModelo();" name="cboMarca" id = "cboMarca">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach ($listadoMarca as $marca): ?>

							<?php
							$selected = "";

							if ($marca->getIdMarca() == $repuesto->getIdMarca()) {
								$selected = "SELECTED";
							}
							?>

							<option <?php echo $selected; ?> value="<?php echo $marca->getIdMarca(); ?>">
								<?php echo $marca->getDescripcionMa(); ?>
							</option>

						<?php endforeach ?>

					</select>
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_tipoRepuesto">
				<label for = "tipoRepuesto" class = "formulario_label"> tipoRepuesto: </label>
				<div class="formulario_grupo-input">
					<select name="cbotipoRepuesto" id= "cbotipoRepuesto">
						<option value="0">---Seleccionar---</option>
						<?php foreach ($tipoRepuesto as $tipoRepuesto): ?>

							<?php
							$selected = "";

							if ($tipoRepuesto->getIdTipoRepuesto() == $repuesto->getIdTipoRepuesto()) {
								$selected = "SELECTED";
							}
							?>

							<option <?php echo $selected; ?> value="<?php echo $tipoRepuesto->getIdTipoRepuesto(); ?>">
								<?php echo $tipoRepuesto->getDescripcionM(); ?>
							</option>

						<?php endforeach ?>
					</select>
				</div>
			</div>
			<?php if($mostrar != "disable"){?>
			<div class="formulario_grupo" id="grupo_existencia">
				<label for = "existencia" class = "formulario_label"> Existencia: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarExistencia()" class = "formulario_input" type="number" name="txtExistencia" id="txtExistencia" placeholder= "Ej. " value = "<?php echo $repuesto->getExistencia();?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "existenciaMin" class = "formulario_label"> Existencia Minima: </label>
					<div class="formulario_grupo-input">
					<input onkeyup = "validarExistenciaMin()" class = "formulario_input" type="number" name="txtExistenciaMinima" id="txtExistenciaMinima" placeholder= "Ej. " value = "<?php echo $repuesto->getExistenciaMin();?>">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
			</div>
			<?php }?>
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