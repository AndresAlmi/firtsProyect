<?php
require_once "../../../class/marca.php";
require_once "../../../class/modelo.php";
$idModelo = $_GET["id_modelo"];
$modelo = modelo::obtenerPorId($idModelo);
$marca = marca::obtenerTodos();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Modelo Vehiculo</title>
	<script type="text/javascript" src="../../../js/formularios.js"></script>
	<script type="text/javascript" src="../../../js/jquery.3.6.js"></script>
	<script type="text/javascript"></script>
	<link rel="stylesheet" href="../../../styles/select2.min.css">
	<link rel="StyleSheet" href = "../../../styles/nav.css">
	<link rel="stylesheet" href="../../../styles/header.css">
	<link rel="StyleSheet" href = "../../../styles/form.css">
	<link rel="StyleSheet" href = "../../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<form action="procesar_modificar.php" method="POST" class="formulario" id="formularioModeloVehiculo">

			<input type="hidden" name ="txtIdModelo" value = "<?php echo $idModelo;?>">

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="txtdescripcion" class = "formulario_input" value="<?php echo $modelo->getDescripcionModelo(); ?> ">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input">
			<select name="cboMarca" id="cboMarca" class="cboMarca">
				<option value="">--Seleccionar--</option>
				
				<?php foreach($marca as $marca):?>
				<?php $selected = "";

				if ($marca->getIdMarca() == $modelo->getIdMarca()) {
					$selected = "SELECTED";
				}

				?>
					<option <?php echo $selected?> value="<?php echo $marca->getIdMarca();?>">
						<?php echo $marca->getDescripcionMarca();?>
					</option>
				<?php endforeach;?>
			</select>
		
		
			<div class="formulario_alerta">
				<p>Por favor rellena el formulario.</p>
			</div>

			<div class = "formulario_grupo-btn-enviar">
				<button type="submit" class="formulario_btn">Guardar</button>
			</div>				
		</form>
	</section>
	<footer>
		<?php require_once "../../../footer.php";?>
	</footer>
</body>
</html>