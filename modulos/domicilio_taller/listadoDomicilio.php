<?php

require_once "../../class/domicilioTaller.php";
require_once "../../class/taller.php";

$idTaller = $_GET["id_taller"];
$listadoDomicilioPersona = domicilioTaller::obtenerPorIdtaller($idTaller);
$tallerLocal = taller::obtenerPorId($idTaller);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Domicilio</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../header.php";?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>DOMICILIO</h2>	
		<h1><a href="javascript:history.back()"><?php echo $tallerLocal->getNombre()?></a></h1>


		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href='nuevo.php?id_taller=<?php echo $idTaller?>'><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>Barrio</th>
						<th>Calle</th>
						<th>Altura</th>
						<th>Manzana</th>
						<th>Torre</th>
						<th>Piso</th>
						<th>Numero de Casa</th>
						<th colspan = "2">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($listadoDomicilioPersona as $domicilio): ?>

					<tr class="tr">
						
						<td><?php echo $domicilio->getIdBarrio(); ?></td>
						<td><?php echo $domicilio->getCalle(); ?></td>
						<td><?php echo $domicilio->getAltura(); ?></td>
						<td><?php echo $domicilio->getManzana(); ?></td>
						<td><?php echo $domicilio->getTorre(); ?></td>
						<td><?php echo $domicilio->getPiso();?></td>
						<td><?php echo $domicilio->getNumCasa();?></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_domicilio=<?php echo $domicilio->getIdDomicilio(); ?>&id_taller=<?php echo $idTaller; ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_domicilio=<?php echo $domicilio->getIdDomicilio(); ?>&id_taller=<?php echo $idTaller; ?>">
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