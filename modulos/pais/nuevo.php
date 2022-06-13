<?php
require_once "../../class/pais.php"

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Pais</title>
    <link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>
</head>
<body>
    <header>
		<?php require_once "../../header.php"; ?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<h1><a href="listado.php">Domicilio</a></h1>
		
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioPais">

            <div class="formulario_grupo" id="grupo_descripcion">
                <label for = "descripcion" class = "formulario_label"> Descripcion: </label>
                <div class="formulario_grupo-input">
                    <input class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "Ej. Bolivia" >
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