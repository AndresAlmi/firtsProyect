<?php

require_once "../../class/agenda.php";
require_once "../../class/taller.php";
require_once "../../class/dia.php";
$idTaller = $_GET["id_taller"];
$taller = taller::obtenerPorId($idTaller);
$lista = Agenda::obtenerPorIdTaller($idTaller);
$idAgenda = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/jbox.min.css">
	<link rel="stylesheet" href="../../styles/datatables.min.css">
	<link rel='stylesheet' href='../../styles/square/grey.css'>
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script src="../../js/jbox.min.js"></script>
    <script src='../../js/icheck.min.js'></script>
	<script src="../../js/modalAgenda.js"></script>
	<style>
		input{
			outline: none;
			text-align: center;
			border: none;
		}
	</style>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>AGENDA</h2>
		<h1><a href="javascript:history.back()"><?php echo $taller->getNombre()?></a></h1>


		

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php?id_taller=<?php echo $idTaller;?>"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id="tablaAgenda">
				<thead>
					<tr>
						<th>ID Agenda</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th>Hora Inicio</th>
						<th>Hora Fin</th>
						<th>Estado</th>
						<th>Dias</th>
						<th>Modificar</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($lista as $agenda):?>

						<tr>

							<td><input type="text" id="idAgenda" value="<?php echo $agenda->getIdAgenda();?>" readonly></td>
							<td><?php echo $agenda->getfechainicio(); ?></td>
							<td><?php echo $agenda->getfechafin(); ?></td>
							<td><?php echo $agenda->gethorainicio(); ?></td>
							<td><?php echo $agenda->gethorafin(); ?></td>
							<td><?php echo $agenda->getestado(); ?></td>

							<td>
								<div onclick="modalFunciones();"class="modal">
									<button type="button" id="myModal" >Ver Dias</button>
								</div>
							</td>
							<td>
								<a class = "btnImg" href="modificar.php?id_agenda=<?php echo $agenda->getidAgenda(); ?>">
									<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px"> 
								</a>
							</td>
							

						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</section>
	</div>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>
