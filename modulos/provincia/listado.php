<?php

require_once "../../class/provincia.php";


$lista = provincia::obtenerTodos();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Perfil</title>
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
			$('#tablaProvincia').DataTable();
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
		<h2>PROVICNIA</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id="tablaProvincia">
				<thead>
					<tr>
						<th>ID Pais</th>
						<th>ID Provincia</th>
						<th>Descripcion</th>
						<th>Modificar</th>
						<th>Borrar</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $pais): ?>

					<tr class="tr">
						
						<td><?php echo $pais->getIdPais(); ?></td>
						<td><?php echo $pais->getIdProvincia(); ?></td>
						<td><?php echo $pais->getDescripcion(); ?></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_provincia=<?php echo $pais->getIdProvincia(); ?>"> 
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px"> 
							</a>
						</td>
						<td> 
							<a class = "btnImg" href="eliminar.php?id_provincia=<?php echo $pais->getIdProvincia(); ?>">
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
