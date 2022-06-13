<?php

require_once "../../class/vehiculo.php";
require_once "../../class/color.php";
require_once "../../class/cliente.php";

$listadoMarca = marca::obtenerTodos();
$listadoColor = color::obtenerTodos();

$mostrar = "disable";
if (isset($_GET["id_cliente"])){
    $idCliente = $_GET["id_cliente"];
    $mostrar = "enable";
	$listadoCliente = cliente::obtenerPorId($idCliente);

}else{
	$listadoCliente = cliente::obtenerTodos();

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Vehiculo</title>
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formularios.js"></script>
	<script type="text/javascript" src="../../js/maksJquery.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../js/select2funcion.js"></script>
	<script type="text/javascript" src="../../js/Modelo-Patente.js"></script>

</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<h1><a href="listado.php">Vehiculos</a></h2>
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioVehiculo">
		
			<div class="formulario_grupo" id="grupo_marca">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input">
					<select onchange="cargarModelo();"  id="cboMarca" name="cboMarca" class= "cboMarca" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach ($listadoMarca as $Marca): ?>

							<option value= "<?php echo $Marca->getIdMarca(); ?>">
								<?php echo $Marca->getDescripcionMarca(); ?>
							</option>

						<?php endforeach ?>
					</select>
				</div>
			</div>
			
			<div class="formulario_grupo" id="grupo_modelo">
				<label for = "modelo" class = "formulario_label"> Modelo: </label>
				<div class="formulario_grupo-input">
					<select id = "cboModelo" name="cboModelo" class = "formulario_input cboModelo" style="width: 100%">
						<option value=0>---Seleccionar---</option>
					</select>
				</div>	
			</div>	
			<div class="formulario_grupo" id="grupo_anio">
				<label for = "anio" class = "formulario_label"> Año: </label>
				<div class="formulario_grupo-input">
					<?php
					$cont = date('Y');
					?>
					<select onchange ="cargarPatente();" name = "cboAnio" id="cboAnio" class="cboAnio" style="width: 100%">
						<option value ="2021"> --Seleccionar-- </option>
						<?php while ($cont >= 1990) { ?>
						<option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
						<?php $cont = ($cont-1); } ?>
					</select>
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_matricula">
				<label for = "matricula" class = "formulario_label"> Matricula: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarMatricula()" type="text" id="txtMatricula" name="txtMatricula" class="formulario_input txtMatricula" placeholder= "Ej" style="width: 100%">
					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Patente En Uso</p>
			</div>	

			<div class="formulario_grupo" id="grupo_color">	
				<label for = "color" class = "formulario_label"> Color: </label>   
				<div class="formulario_grupo-input">     
					<select name="cboColor" id="cboColor" class="cboColor" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach ($listadoColor as $color): ?>


							<option value="<?php echo $color->getNombre(); ?>">
								<?php echo $color->getNombre(); ?>
							</option>

						<?php endforeach ?>

					</select>
				</div> 
			</div> 
			<?php if($mostrar == "disable"){?>
			<div class="formulario_grupo" id="grupo_color">	
				<label for = "cliente" class = "formulario_label"> Cliente: </label>
				<div class="formulario_grupo-input">  
					<select name="cboCliente"  id = "cboCliente" class="cboCliente" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>
						<?php foreach ($listadoCliente as $cliente): ?>
							<option value="<?php echo $cliente->getIdCliente(); ?>">
								<?php echo $cliente->getNombre(); ?>
							</option>

						<?php endforeach ?>
					</select>
				</div>
			</div>
			<?php } else { ?>
			<div class="formulario_grupo" id="grupo_cliente">
				<label for = "Cliente" class = "formulario_label"> Cliente: </label>
				<div class="formulario_grupo-input">
					<input onkeyup = "validarMatricula()" type="text" name=""  class="formulario_input" placeholder= "<?php echo $listadoCliente->getNombre() . ", " . $listadoCliente->getApellido()?>" style="width: 100%" readonly>
					<input type="hidden" name ="cboCliente" value="<?php echo $idCliente;?>">
					<input type="hidden" name ="mostrar" value="<?php echo $mostrar;?>">

					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
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