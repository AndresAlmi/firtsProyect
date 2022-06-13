<?php

require_once "../../class/modulo.php";

$lista = modulo::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Modulo</title>
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel= "StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/datatables.min.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tablaModulo').DataTable();
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
		<h2>MODULO</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id="tablaModulo">
				<thead>
					<tr>

						<th>ID Modulo</th>
						<th>Descripcion</th>
						<th>directorio</th>
						<th>Estado</th>
						<th>Nivel</th>
						<th>Orden</th>
						<th>Hijo De</th>
						<th>Modificar</th>
						<th>Borrar</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $modulo): ?>

					<tr class="tr">
						
						<td><?php echo $modulo->GetIdModulo(); ?></td>
						<td><?php echo $modulo->getDescripcion();?></td>
						<td><?php echo $modulo->getDirectorio();?></td>
						<td><?php echo $modulo->getEstado(); ?></td>
						<td><?php echo $modulo->getNivel();?></td>
						<td><?php echo $modulo->getOrden();?></td>
						<td><?php echo $modulo->getHijoDe();?></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_modulo=<?php echo $modulo->getIdModulo(); ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_modulo=<?php echo $modulo->getIdModulo(); ?>">
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