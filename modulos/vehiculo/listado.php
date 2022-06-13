<?php

require_once "../../class/vehiculo.php";
require_once "../../class/cliente.php";

$mostrar = "disable";

if(isset($_GET['id_cliente'])){
	$lista = vehiculo::obtenerPorIdCliente($_GET["id_cliente"]);
	$idCliente = $_GET["id_cliente"];
    $lista = vehiculo::obtenerPorIdCliente($idCliente);
    $mostrar = "enable";

}else{
	$lista = vehiculo::obtenerTodos();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vehiculo</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/datatables.min.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tablaVehiculo').DataTable();
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
		<h2>VEHICULOS</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php<?php if($mostrar == "enable"){ echo "?id_cliente=" . $idCliente;}?>"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id = "tablaVehiculo">
				<thead>
					<tr>
						<th>ID vehiculo</th>
						<th>Cliente</th>
						<th>matricula</th>
						<th>anio</th>
						<th>color</th>
						<th>marca</th>
						<th>modelo</th>
						<th>Modificar</th>
						<th>Borrar</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $vehiculo): ?>
						<?php $cliente = cliente::obtenerPorId($vehiculo->getIdCliente())?>
					<tr class="tr">
						
						<td><?php echo $vehiculo->getIdvehiculo(); ?></td>
						<td><?php echo $cliente->getNombre() . ", " . $cliente->getApellido();?></td>
						<td><?php echo $vehiculo->getMatricula(); ?></td>
						<td><?php echo $vehiculo->getAnio(); ?></td>
						<td><?php echo $vehiculo->getColor(); ?></td>
						<td><?php echo $vehiculo->getDescripcionMarca();?></td>
						<td><?php echo $vehiculo->getDescripcionModelo(); ?></td>

						<td>
							<a class = "btnImg" href="modificar.php?id_vehiculo=<?php echo $vehiculo->getIdvehiculo(); ?>&id_marca=<?php echo $vehiculo->getIdMarca()?>&modelo=<?php echo $vehiculo->getDescripcionModelo()?>"> 
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px"> 
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_vehiculo=<?php echo $vehiculo->getIdvehiculo(); ?><?php if($mostrar == "enable"){ echo "&id_cliente=" . $idCliente;}?>"> 
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