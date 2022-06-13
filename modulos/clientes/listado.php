<?php

require_once "../../class/Cliente.php";

$listaClientes = Cliente::obtenerTodos();
$tipoCliente = 0;

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
			$('#tablaClientes').DataTable();
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
		<h2>CLIENTES</h2>

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>
		<section id="tabla_busqueda">

				<table id="tablaClientes">
					<thead>

						<tr>
							<th>ID Cliente</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Dni</th>
							<th>Fecha Nacimiento</th>
							<th>Fecha Alta</th>
							<th>Sexo</th>
							<th>Contacto</th>
							<th>Domicilio</th>
							<th>Modificar</th>
							<th>Borrar</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach  ($listaClientes as $Cliente): ?>
						<tr class="tr">
							
							<td><?php echo $Cliente->getIdCliente(); ?></td>
							<td><?php echo $Cliente->getNombre(); ?></td>
							<td><?php echo $Cliente->getApellido(); ?></td>
							<td><?php echo $Cliente->getDni(); ?></td>
							<td><?php echo $Cliente->getFechaNacimiento(); ?></td>
							<td><?php echo $Cliente->getFechaAlta();?></td>
							<td><?php echo $Cliente->getIdSexo();?></td>
							<td><a href = "../contacto/listadoContacto.php?id_persona=<?php echo $Cliente->getIdPersona(); ?>">Contacto</a></td>
							<td><a href = "../domicilio/listadoDomicilio.php?id_persona=<?php echo $Cliente->getIdPersona(); ?>"> Domicilio </a></td>
							<td>
								<a class = "btnImg" href="modificar.php?id_cliente=<?php echo $Cliente->getIdCliente(); ?>">
									<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
								</a>
							</td>
							<td>
								<a class = "btnImg" class = "nav-menu-link" href="eliminar.php?id_cliente=<?php echo $Cliente->getIdCliente(); ?>"> 
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
