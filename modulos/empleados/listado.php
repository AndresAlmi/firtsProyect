<?php

require_once "../../class/Empleado.php";
require_once "../../class/taller.php";

$lista = Empleado::obtenerTodos();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Empleado</title>
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
			$('#tablaEmpleado').DataTable();
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
		<h2>EMPLEADOS</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">
			<table id="tablaEmpleado">
				<thead>
					<tr>
						<th>Taller</th>
						<th>Numero Legajo</th>
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
					<?php foreach  ($lista as $empleado): ?>
					<?php $taller = taller::obtenerPorId($empleado->getIdTaller())?>
					<tr class="tr">
						
						<td><?php echo $taller->getNombre();?></td>
						<td><?php echo $empleado->getNumeroLegajo(); ?></td>
						<td><?php echo $empleado->getNombre(); ?></td>
						<td><?php echo $empleado->getApellido(); ?></td>
						<td><?php echo $empleado->getDni(); ?></td>
						<td><?php echo $empleado->getFechaNacimiento(); ?></td>
						<td><?php echo $empleado->getFechaAlta();?></td>
						<td><?php echo $empleado->getIdSexo();?></td>
						<td><a href = "../contacto/listadoContacto.php?id_persona=<?php echo $empleado->getIdPersona(); ?>">Contacto</a>
						<td><a href = "../domicilio/listadoDomicilio.php?id_persona=<?php echo $empleado->getIdPersona(); ?>"> Domicilio </a></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>"> 
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px"> 
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>">
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
