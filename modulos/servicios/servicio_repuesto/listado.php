<?php

require_once "../../../class/serviciosRepuestos.php";
require_once "../../../class/repuestos.php";

$idServicio = $_GET["id_servicio"];
$lista = serviciosRepuesto::obtenerPorIdServicio($idServicio);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Servicios</title>
	<link rel= "shortcut icon" href="../../../img/icon.png">
	<link rel="stylesheet" href="../../../styles/header.css">
	<link rel="StyleSheet" href = "../../../styles/table.css">
	<link rel= "StyleSheet" href = "../../../styles/button.css">
	<link rel= "StyleSheet" href = "../../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../../menu.php"; ?>
	</nav>

	<div class="contenedorTabla">
		<h1><a href="../listado.php">Servicios Repuesto</a></h1>		
		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO REPUESTO NECESARIO</label>
			<a href="nuevo.php?id_servicio=<?php echo $idServicio;?>"><img src="../../../img/mas.png" height="20px" width="20px"></a>
		</div>
			
		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>ID Repuesto</th>
						<th>Tipo Repuesto</th>
						<th>Repuestos</th>
						<th>Cantidad</th>
						<th colspan = "2">Acciones</th>

					</tr>
				</thead>
				<tbody>
					<?php $idrepuesto = 0;?>
					<?php foreach  ($lista as $repuesto): ?>
						<?php 
							if($repuesto->getIdRepuesto() == $idrepuesto){
								$cantidad += $repuesto->getCantidad();
							}
							$id = repuestos::obtenerPorIdRepuesto($repuesto->getIdRepuesto());?>
					<tr>
						
						<td>
							<?php 
							$idrepuesto = $repuesto->getIdRepuesto(); 
							echo $idrepuesto;
							?>
						</td>
						<td><?php echo $id->getIdTipoRepuesto();?></td>
						<td><?php echo $id->getDescripcion();?></td>
						<td>
							<?php 
							$cantidad = $repuesto->getCantidad(); 
							echo $cantidad;
							?>
						</td>
						<td>
							<a class = "btnImg" href="modificar.php?id_servicio_repuesto=<?php echo $repuesto->getIdServicioRepuesto(); ?>">
								<img src = "../../../img/iconModificar.png" width = "40px" heigth = "40px"> 
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_servicio_repuesto=<?php echo $repuesto->getIdServicioRepuesto(); ?>"> 
								<img src = "../../../img/iconBorrar.png" width = "40px" heigth = "40px">
							</a>
						</td>

					</tr>

					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>
	</div>
	<footer>
		<?php require_once "../../../footer.php";?>
	</footer>
</body>
</html>
