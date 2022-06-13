<?php

require_once "../../class/modulo.php";

$listadoModulo = modulo::obtenerTodos();

$mensaje = "";
if (isset($_GET["error"])){

	switch($_GET["error"]){
		case "descripcion0":
			$mensaje = "Ingrese una descripcion.";
			break;
		case "descripcion<3":
			$mensaje = "Requiere más de 3 caracteres.";
			break;
		case "modulo0":
			$mensaje = "Ingrese al menos un modulo.";
			break;
	}
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>
	<script type="text/javascript" src="../../js/select2funcion.js"></script>


</head>
<body>
	<header>
		<?php require_once "../../header.php"; ?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<h1><a href="listado.php">Perfil</a></h1>
		<?php echo $mensaje; ?>
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioPerfil">

		<div class="formulario_grupo" id="grupo_descripcion">
			<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
			<div class="formulario_grupo-input">
				<input class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "" >
				<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
			</div>
			<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>	
		</div>

			<div class="formulario_grupo" id="grupo_modulo">
				<label for = "modulo" class = "formulario_label"> Modulo: </label>
				<div class="formulario_grupo-input">
					<select multiple name = "cboModulo[]" id="cboModulo" class="cboModulo" style="width: 100%;">
						<option value = "">--Seleccionar--</option>
						<?php foreach ($listadoModulo as $modulo): ?>

							<option value="<?php echo $modulo->GetIdModulo(); ?>">
								<?php echo $modulo->getDescripcion(); ?>
							</option>

						<?php endforeach ?>
					</select>
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