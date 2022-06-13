<?php

require_once "../../class/repuestos.php";
require_once "../../class/taller.php";

$mostrar = "disable";
if(isset($_GET["id_taller"])){
	$idTaller = $_GET["id_taller"];
	$mostrar = "enable";
	$lista = repuestos::obtenerPorIdTaller($idTaller);
	$taller = taller::obtenerPorId($_GET["id_taller"]);
}else{
	$lista = repuestos::obtenerTodos();
}

//echo $mostrar;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Repuestos</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/datatables.min.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tablaRepuesto').DataTable();
		} );
	</script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>REPUESTOS</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php?<?php if($mostrar != "disable"){echo "?id_taller=$idTaller";}?>"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id="tablaRepuesto">
				<thead>
					<tr>
						<th>ID Repuesto</th>
						<th>Tipo Repuesto</th>
						<th>descripcion</th>
						<th>existencia</th>
						<th>existencia minima</th>
						<th>Marca</th>
						<th>Modificar</th>
						<th>Borrar</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach  ($lista as $Repuesto): ?>
					<?php $tipoRepuesto = tipoRepuesto::obtenerPorId($Repuesto->getIdTipoRepuesto())?>
					<?php $marca = MarcaRepuesto::getMarcaByID($Repuesto->getIdMarca())?>

					<tr class="tr">
						
						<td><?php echo $Repuesto->getIdRepuesto(); ?></td>
						<td><?php echo $tipoRepuesto->getDescripcionM();?></td>
						<td><?php echo $Repuesto->getDescripcion(); ?></td>
						<td><?php echo $Repuesto->getExistencia(); ?></td>
						<td><?php echo $Repuesto->getExistenciaMin(); ?></td>
						<td><?php echo $marca->getDescripcionMa();?></td>

						<td>
							<a class = "btnImg" href="modificar.php?id_Repuesto=<?php echo $Repuesto->getIdRepuesto(); ?><?php if($mostrar != "disable"){echo "&id_taller=$idTaller";}?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_Repuesto=<?php echo $Repuesto->getIdRepuesto(); ?>">
								<img src = "../../img/iconBorrar.png" width = "40px" heigth = "40px">
							</a>
						</td>

					</tr>

				<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>
