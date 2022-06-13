<?php

require_once "../../class/proveedor.php";

$listadoProveedores = proveedor::obtenerTodos();

?>

<!DOCTYPE html>
<html lang = "es">
<head>
	<title>Clientes</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
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
			$('#tablaProveedor').DataTable();
		} );
	</script>

</head>
<body>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>PROVEEDOR</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

				<table id="tablaProveedor">
					<thead>

						<tr>
							<th>ID Proveedor</th>
							<th>Nombre</th>
							<th>Fecha Alta</th>
							<th>Contacto</th>
							<th>Domicilio</th>
							<th>Modificar</th>
							<th>Borrar</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach  ($listadoProveedores as $proovedor): ?>
						<tr>
							
							<td><?php echo $proovedor->getIdProveedor(); ?></td>
							<td><?php echo $proovedor->getNombre(); ?></td>
							<td><?php echo $proovedor->getFechaAlta();?></td>
							<td><a href = "#">Contacto</a></td>
							<td><a href = "#"> Domicilio </a></td>
							<td>
								<a class = "btnImg" href="modificar.php?">
									<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
								</a>
							</td>
							<td>
								<a class = "btnImg" class = "nav-menu-link" href="eliminar.php?"> 
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
