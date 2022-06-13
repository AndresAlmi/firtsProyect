<?php
require_once "../../../class/tipoRepuesto.php";
$idTipoRepuesto = $_GET["id_tipo_repuesto"];
$tipoRepuesto = tipoRepuesto::obtenerPorId($idTipoRepuesto);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../../js/maksJquery.js"></script>
	<script type="text/javascript"></script>
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
		<form action="procesar_modificar.php" method="POST" class="formulario" id="formularioTipoRepuesto">

			<input type="hidden" name ="txtIdModelo" value = "<?php echo $idTipoRepuesto;?>">
			
			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "Descripcion" class = "formulario_label">Descripcion Del Tipo De Repuesto:</label>
				<div class="formulario_grupo-input">
					<input type="text" name = "txtModelo" class = "formulario_input" id="txtModelo" value = "<?php echo $tipoRepuesto->getDescripcionM();?>">
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
		<?php require_once "../../../footer.php";?>
	</footer>
</body>
</html>