<?php

require_once "../../class/modulo.php";

$idModulo = $_GET["id_modulo"];

$modulos = modulo::obtenerPorId($idModulo);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Modulo</title>
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioModulo">
			<input type="hidden" name="txtIdModulo" value="<?php echo $idModulo; ?>">

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="txtdescripcion" class = "formulario_input" value="<?php echo $modulos->getdescripcion(); ?> ">
				</div>
			</div>
			
			<div class="formulario_grupo" id="grupo_directorio">
				<label for = "directorio" class = "formulario_label"> Directorio: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="txtDirectorio" class = "formulario_input" value="<?php echo $modulos->getDirectorio(); ?>">
				</div>
			</div>

		
			<div class="formulario_alerta">
				<p>Por favor rellena el formulario.</p>
			</div>

			
			<div class = "formulario_grupo-btn-enviar">
				<button type="submit" class="formulario_btn">Guardar</button>
			</div>		</form>
	</section>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>