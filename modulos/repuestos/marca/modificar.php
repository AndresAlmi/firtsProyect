<?php
require_once "../../../class/marcaRepuesto.php";

$idMarca = $_GET["id_marca"];
$marca = MarcaRepuesto::obtenerPorIdMarca($idMarca);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../../../js/jquery.3.6.js"></script>
	<script type="text/javascript">
	</script>
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
		<form action="procesar_modificar.php" method="POST" class="formulario" id="formularioMarca">

			<input type="hidden" name= "txtIdMarca" value=<?php echo $marca->getIdMarca();?>>

			<div class="formulario_grupo" id="grupo_marca">
				<label for = "marca" class = "formulario_label"> Nombre de la Marca:: </label>
				<div class="formulario_grupo-input">
					<input type="text" name = "txtMarca" id="txtMarcas" class = "formulario_input" value = "<?php echo $marca->getDescripcionMa()?>">
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