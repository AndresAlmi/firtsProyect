<?php

require_once "../../class/turnoServicio.php";
require_once "../../class/servicio.php";

$idTurno = $_GET["id_turno"];
$lista = turnoServicio::obtenerPorIdTurno($idTurno);

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

	
		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>ID Servicio</th>
						<th>Descripcion</th>
						<th colspan = "2">Acciones</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $servicio): ?>
                        <?php $servicioD = Servicio::obtenerPorId($servicio->getIdServicio())?>
					<tr class="tr">
						
						<td><?php echo $servicio->getIdServicio(); ?></td>
						<td><?php echo $servicioD->getdescripcion(); ?></td>
						<td>
							<a class = "btnImg" href="quitarServicio.php?id_servicio=<?php echo $servicio->getidservicio(); ?>&id_turno=<?php echo $idTurno?>"> 
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
