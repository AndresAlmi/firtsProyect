<?php

require_once "../../class/taller.php";
$foreach = "disable";
if(isset($_GET["id_taller"])){
	$lista = taller::obtenerPorId($_GET["id_taller"]);

}else{
	$lista = taller::obtenerTodos();
	$foreach = "enable";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Taller</title>
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
			$('#tablaTaller').DataTable();
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
		<h2>TALLER</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table id="tablaTaller">
				<thead>
					<tr>
						<th>ID taller</th>
						<th>Nombre</th>
						<th>Turnos</th>
						<th>Disponibles por dia</th>
						<th>Repuestos</th>
						<th>Agenda</th>
						<th>Contacto</th>
						<th>Direccion</th>
						<th>Modificar</th>
						<th>Borrar</th>
					</tr>
				</thead>
				<tbody>
					<?php if($foreach == "enable"){ ?>
					<?php foreach($lista as $lista): ?>
					

					<tr class="tr">
						
						<td><?php echo $lista->getIdtaller(); ?></td>
						<td><?php echo $lista->getNombre(); ?></td>
						
						<td>
							<a href="../turno/listado.php?id_taller=<?php echo $lista->getIdTaller(); ?>">Turnos</a>
						</td>
						<td><?php echo $lista->getMaxTurno();?></td>
						<td>
							<a href="../repuestos/listado.php?id_taller=<?php echo $lista->getIdTaller()?>">
								Repuestos
							</a>
						</td>
						<td>
							<a href = "../agenda/listado.php?id_taller=<?php echo $lista->getIdTaller(); ?>">
								Agenda
							</a>
						</td>
						<td>
							<a href = "../contacto_taller/listadoContacto.php?id_taller=<?php echo $lista->getIdTaller(); ?>">
								Contacto
							</a>
						</td>
						</td>
						<td>
							<a href = "../domicilio_taller/listadoDomicilio.php?id_taller=<?php echo $lista->getIdtaller();?>">
								Direccion
							</a>
						<td>
							<a class = "btnImg" href="modificar.php?id_taller=<?php echo $lista->getIdtaller(); ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_taller=<?php echo $lista->getIdtaller(); ?>">
								<img src = "../../img/iconBorrar.png" width = "40px" heigth = "40px">
							</a>
						</td>

					</tr>

					
						<?php endforeach; ?>
					<?php } else { ?>
						<tr class="tr">
						
						<td><?php echo $lista->getIdtaller(); ?></td>
						<td><?php echo $lista->getNombre(); ?></td>
						
						<td>
							<a href="../turno/listado.php?id_taller=<?php echo $lista->getIdTaller(); ?>">Turnos</a>
						</td>
						<td><?php echo $lista->getMaxTurno();?></td>
						<td>
							<a href="../repuestos/listado.php?id_taller=<?php echo $lista->getIdTaller()?>">
								Repuestos
							</a>
						</td>
						<td>
							<a href = "../agenda/listado.php?id_taller=<?php echo $lista->getIdTaller(); ?>">
								Agenda
							</a>
						</td>
						<td>
							<a href = "../contacto_taller/listadoContacto.php?id_taller=<?php echo $lista->getIdTaller(); ?>">
								Contacto
							</a>
						</td>
						</td>
						<td>
							<a href = "../domicilio_taller/listadoDomicilio.php?id_taller=<?php echo $lista->getIdtaller();?>">
								Direccion
							</a>
						<td>
							<a class = "btnImg" href="modificar.php?id_taller=<?php echo $lista->getIdtaller(); ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_taller=<?php echo $lista->getIdtaller(); ?>">
								<img src = "../../img/iconBorrar.png" width = "40px" heigth = "40px">
							</a>
						</td>

					</tr>
					<?php }?>	
				</tbody>
			</table>
		</section>
	</div>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>
