<?php

require_once "../../../class/marcaRepuesto.php";
require_once "../../../class/tipoRepuesto.php";
require_once "../../../class/repuestos.php";
$listaMarca = MarcaRepuesto::obtenerTodos();
$listadoTipoRepuesto = tipoRepuesto::ObtenerTodos();
$idServicio = $_GET["id_servicio"];
$mensaje = "";
if (isset($_GET["add"])){

	switch($_GET["add"]){
		case "continue":
			$mensaje = "Puede Seguir Agregando Repuestos";
			break;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="StyleSheet" href = "../../../styles/header.css">
	<link rel="StyleSheet" href = "../../../styles/form.css">
	<link rel="StyleSheet" href = "../../../styles/footer.css">
    <script type="text/javascript" src="../../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../../js/tiporepuesto.js"></script>
</head>
<body>
	<header>
		<?php require_once "../../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<h1><a href="listado.php?id_servicio=<?php echo $idServicio;?>">Tipo Repuesto</a></h1>
		<?php echo "<h2> ". $mensaje ."</h2>";?>
		<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioRepuesto">

			<input type="hidden" name = "txtIdServicio" value = "<?php echo $idServicio;?>">
			<div class="formulario_grupo" id="grupo_marca">
				<label for = "marca" class = "formulario_label"> Marca: </label>
				<div class="formulario_grupo-input">
					<select class="cboMarca" name="cboMarca" id = "cboMarca" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach ($listaMarca as $marca): ?>

							<option value="<?php echo $marca->getIdMarca(); ?>">
								<?php echo $marca->getDescripcionMa(); ?>
							</option>

						<?php endforeach ?>

					</select>
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_tipoRepuesto">
				<label for = "TipoRepuesto" class = "formulario_label"> Tipo Repuesto: </label>
				<div class="formulario_grupo-input">
					<select class="cboTipoRepuesto" name="cboTipoRepuesto" id = "cboTipoRepuesto" style="width: 100%">
						<option value="NULL">---Seleccionar---</option>

						<?php foreach($listadoTipoRepuesto as $tipoRepuesto):?>
							<option value="<?php echo $tipoRepuesto->getIdTipoRepuesto()?>">
								<?php echo $tipoRepuesto->getDescripcionM()?>
							</option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
				
			<div class="formulario_grupo" id="grupo_repuesto">
				<label for = "repuesto" class = "formulario_label">Repuesto: </label>
				<div class="formulario_grupo-input">
					<select id = "cboRepuesto" name="cboRepuesto" style="width: 100%">>
						<option value=0>---Seleccionar---</option>
					</select>
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "cantidad" class = "formulario_label"> Cantidad: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="number" name="txtCantidad" id="txtDescripcion" placeholder= "">
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
		<?php require_once "../../../footer.php";?>
	</footer>
</body>
</html>