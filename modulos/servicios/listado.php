<?php

require_once "../../class/servicio.php";

$lista = servicio::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Servicios</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>SERVICIOS</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO SERVICIO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>
		<!--<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO TIPO SERVICIO</label>
			<a href="../tipo_servicio/nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>-->

		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>ID Servicio</th>
						<th>Tipo Servicio</th>
						<th>Descripcion</th>
						<th>Repuestos</th>
						<th>Duracion</th>
						<th>Precio</th>
						<th colspan = "2">Acciones</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $servicio): ?>

					<tr class="tr">
						
						<td><?php echo $servicio->getidservicio(); ?></td>
						<td><?php echo $servicio->getIdTipoServicio();?></td>
						<td><?php echo $servicio->getdescripcion(); ?></td>
						<td>
							<a href="servicio_repuesto/listado.php?id_servicio=<?php echo $servicio->getidservicio(); ?>">ver</a>
						</td>
						<td><?php echo $servicio->getDuracion(); ?></td>
						<td><?php echo $servicio->getPrecio(); ?></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_servicio=<?php echo $servicio->getidservicio(); ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px"> 
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_servicio=<?php echo $servicio->getidservicio(); ?>"> 
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
