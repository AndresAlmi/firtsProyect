<?php

require_once "../../class/vehiculo.php";
require_once "../../class/marca.php";

require_once "../../class/color.php";
require_once "../../class/cliente.php";

$mostrarModificar = "publicoModificar";
if (isset($_GET["id_cliente"])){
	$comprobar = $_GET["id_cliente"];
	//echo $comprobar;
	if($comprobar > 0){

		$mostrarModificar = "privadoModificar";
		
	}
}

$id_vehiculo = $_GET["id_vehiculo"];
$modeloDescripcion = $_GET["modelo"];
$listadoModelo =modelo::obtenerTodos();
$listadoColor = color::obtenerTodos();
$vehiculo = vehiculo::obtenerPorId($id_vehiculo);
$listadoMarca = marca::obtenerTodos();
$listadoCliente = cliente::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Vehiculo</title>	
	<style>
		.privadoModificar{
			display: none;
		}
	</style>
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/formulariosM.js"></script>
	<script type="text/javascript" src="../../js/maksJquery.js"></script>
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
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioVehiculo">
				

			<input type = "hidden" name = "txtIdVehiculo" value = "<?php echo $id_vehiculo; ?>">
			<div class="formulario_grupo" id="grupo_Marca">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input" >
					<select onchange="cargarModelo();" name="cboMarca" id = "cboMarca" class="cboMarca">
							
						<option value="NULL">---Seleccionar---</option>

							<?php foreach ($listadoMarca as $Marca): ?>
							<?php

							$selected = "";

							if ($Marca->getIdMarca() == $vehiculo->getIdMarca()) {
								$selected = "SELECTED";
							}

							?>
							<option <?php echo $selected; ?> value= "<?php echo $Marca->getIdMarca(); ?>">
								<?php echo $Marca->getDescripcionMarca(); ?>
							</option>

							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_modelo">
					<label for = "modelo" class = "formulario_label"> Modelo: </label>
					<div class="formulario_grupo-input" >
						<select onchange="validarModelo();" id = "cboModelo" name="cboModelo" id="cboModelo" class="cboModelo">
							<option value="NULL">---Seleccionar---</option>

							<?php foreach ($listadoModelo as $Modelo): ?>
							<?php

							$selected = "";

							if ($modeloDescripcion == $Modelo->getDescripcionModelo()) {
								$selected = "SELECTED";
							}

							?>
							<option <?php echo $selected;?> value="<?php echo $Modelo->getIdModelo(); ?>">
								<?php echo $Modelo->getDescripcionModelo();?>
							</option>

							<?php endforeach ?>
						</select>
					</div>
				</div>
				
				<div class="formulario_grupo" id="grupo_anio">
					<label for = "anio" class = "formulario_label"> Año: </label>
					<div class="formulario_grupo-input" >
						<?php
						$cont = date('Y');
						?>
						<select onchange="cargarPatente();" name="cboAnio" id="cboAnio" class="cboAnio">
							<option value ="2021"> <?php echo($vehiculo->getAnio())?> </option>
							<?php while ($cont >= 1990) { ?>
							<option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
							<?php $cont = ($cont-1); } ?>
						</select>
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_matricula">
					<label for = "Matricula" class = "formulario_label"> Matricula: </label>
					<div class="formulario_grupo-input" >
						<input class = "formulario_input" type="text" name="txtMatricula" id="txtMatricula" placeholder= "Ej. aaa-222-aaa" value="<?php echo $vehiculo->getMatricula();?>">
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_color">
					<label for = "color" class = "formulario_label"> Color: </label>   
					<div class="formulario_grupo-input" >      
						<select name="cboColor" id="cboColor" class="cboColor">
							<option value="NULL">---Seleccionar---</option>

							<?php foreach ($listadoColor as $color): ?>

								<?php

								$selected = "";

								if ($color->getNombre() == $vehiculo->getColor()) {
									$selected = "SELECTED";
								}

								?>

								<option <?php echo $selected; ?> value="<?php echo $color->getNombre(); ?>">
									<?php echo $color->getNombre(); ?>
								</option>

							<?php endforeach ?>

						</select>
					</div>
				</div>

				<div class="formulario_grupo" id="grupo_cliente">
					<label class = "<?php echo $mostrarModificar; ?> formulario_label" for = "cliente" > Cliente: </label>
					<div class="formulario_grupo-input" > 
						<select class = "<?php echo $mostrarModificar; ?>" name="cboCliente" id="cboCliente" class="cboCliente">
							<option value="NULL">---Seleccionar---</option>

							<?php foreach ($listadoCliente as $cliente): ?>

								<?php

								$selected = "";

								if ($cliente->getIdCliente() == $vehiculo->getIdCliente()) {
									$selected = "SELECTED";
								}

								?>

								<option <?php echo $selected; ?> value="<?php echo $cliente->getIdCliente(); ?>">
									<?php echo $cliente->getNombre(); ?>
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