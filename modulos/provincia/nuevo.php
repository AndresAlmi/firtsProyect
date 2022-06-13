<?php
require_once "../../class/provincia.php";
require_once "../../class/pais.php";

$listaPais = pais::obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pais</title>
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
		<h1><a href="listado.php">Domicilio</a></h1>
		
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioProvincia">
            <div class="formulario_grupo" id="grupo_Pais">
                <label for = "provincia" class = "formulario_label"> Pais: </label>
                <div class="formulario_grupo-input">
                    <select name="cboPais" id="cboPais" class="formulario_input" style="width: 100%">
                        <option value="">Seleccionar</option>
                        <?php foreach($listaPais as $listaPais):?>
                            <option value="<?php echo $listaPais->getIdPais()?>">
                                <?php echo $listaPais->getDescripcion();?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="formulario_grupo" id="grupo_descripcion">
                <label for = "descripcion" class = "formulario_label"> Descripcion: </label>
                <div class="formulario_grupo-input">
                    <input class = "formulario_input" type="text" name="txtDescripcion" id="txtDescripcion" placeholder= "Ej. Formosa" >
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