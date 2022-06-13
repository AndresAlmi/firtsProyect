<?php
require_once "../../class/taller.php";
require_once "../../class/turno.php";
require_once "../../class/turnoServicio.php";
require_once "../../class/agenda.php";
require_once "../../class/cliente.php";

$mostrarBotones = "enable";
if(isset($_GET["id_cliente"])){
	$turno = turno::obtenerTurnosPorIdcliente($_GET["id_cliente"]);
	$idCliente = $_GET["id_cliente"];
	$mostrarBotones = "disable";

}else{
	$idTaller = $_GET["id_taller"];
	$tallerLocal = taller::obtenerPorId($idTaller);
	//echo $tallerLocal->getNombre();
	$agenda = Agenda::obtenerPorIdTaller($idTaller);
	$idAgenda = 0;
	foreach($agenda as $agenda):
		$idAgenda = $agenda->getIdAgenda();
	endforeach;
	$turno = turno::obtenerTurnosPorAgenda($idAgenda);
}
$servicios = "";
$index= 0;
$mensaje = "";
if(isset($_GET["e_error"])){
	switch($_GET["e_error"]){
		case "finalizado":
			$mensaje = "El Turno Ya Finalizó.";
			break;
		case "cancelado":
			$mensaje = "El Turno Ya Fue Cancelado.";
			break;
	}
}
$class = "";
$classF = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Taller</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel="stylesheet" href="../../styles/datatables.min.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script type = "text/javascript">
		function consulta($idTurno, $estado){
			var estado = $estado;
			
			if(estado == 1 || estado == 2){
				var idTurno = $idTurno;
				var respuesta;
				var opcion = confirm("¿Se han realizado todos los servicios solicitados?");
				if(opcion == true){
					respuesta = 1;
				} else{
					respuesta = 0;
				}

				if (respuesta == 1){
					window.location.replace("../facturacion/factura.php?id_turno="+idTurno);
				} else if (respuesta == 0){
					window.location.replace("../turno/modificar.php?id_turno="+idTurno);
				}
			}
			else{
				alert("Ya Se Emitio Una Factura Para Este Turno");
			}
		}
		
	</script>
	<script>
		$(document).ready( function () {
			$('#tablaTurnos').DataTable();
		} );
	</script>
	<style>
		td.list ul{
            list-style-type: none;
            overflow: auto;
        }
		h1.mensaje{
			text-align: center;
			font-size: 25px;
			color: black;
			padding: 5px;
		}
		.enCurso a{
			color: rgb(0, 202, 0);
		}

		.enCurso button{
			background-color: rgba(0, 202, 0, 0.300);
		}
		.finalizado a{
			color: red;
		}

		.finalizado button{
			background-color: rgba(200, 20, 20, 0.300);
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
		<h2>TURNOS</h2>	
		<?php if($mostrarBotones == "enable"){?>
		<h1><a href="javascript:history.back()"><?php echo $tallerLocal->getNombre()?></a></h1>
		<?php }?>
		<div class="agregarNuevo">
			<label for="">NUEVO TURNO</label>
			<a href="nuevo.php<?php if($mostrarBotones == "disable"){ echo "?id_cliente=". $idCliente;}?>"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>


		<section id="tabla_busqueda">
			<?php 
			if($mensaje != ""){
				echo "<h1 class='mensaje'>$mensaje</h1>";
			}	
			?>
			<table id="tablaTurnos">
				<thead>
					<tr>
						<th>Cliente</th>
						<th>Vehiculo</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Servicios</th>
						<th>Precio</th>
						<th>Estado</th>
						<?php if($mostrarBotones == "enable"){?>
						<th>Finalizar Turno</th>
						<th>Finalizado</th>
						<?php } ?>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($turno as $turno): ?>
						<?php $turnoServicio = turnoServicio::obtenerPorIdTurno($turno->getIdTurno()); ?>
						<?php $cliente = cliente::obtenerPorId($turno->getIdCliente())?>
					<tr>
						<td><?php echo $cliente->getNombre() . ", " . $cliente->getApellido();?></td>
						<td><?php echo $turno->getIdVehiculo(); ?></td>
						<td><?php echo $turno->getFechaTurno(); ?></td>
						<td><?php echo $turno->getHoraTurno(); ?></td>
						<td class = "list">
							<ul>
								<?php foreach($turnoServicio as $Servicio):?>
									<li>
										<?php 
										$obtenerServicios = servicio::obtenerPorId($Servicio->getIdServicio());
										echo $obtenerServicios->getDescripcion();
										?>
									</li>
								<?php endforeach;?>
							</ul>
						</td>
						<td class = "list">
							<ul>
								<?php foreach($turnoServicio as $costo):?>
									<li>
										<?php echo $costo->getCosto(); ?>
									</li>
								<?php endforeach;?>
							</ul>
						</td>
						<td>
							<input type="hidden" value="<?php $turno->getEstado()?>" id="estado" name="estado">
							<?php 
							if($turno->getEstado() == 1){
								echo "En curso";
							}else if($turno->getEstado() == 2){
								echo "Finalizado";
							}else if($turno->getEstado()==3){
								echo "En Curso <br> Facturado";
							}else if($turno->getEstado() == 4){
								echo "Finalizado <br> Facturado";
							}else{
								echo "Cancelado";
							}
							?>
						</td>
						<?php if($mostrarBotones == "enable"){?>

						<td class="<?php if($turno->getEstado() == 1 or $turno->getEstado() == 3){echo "enCurso";}elseif($turno->getEstado()==2 or $turno->getEstado() == 4){echo "finalizado";};?>">
							<a href="finalizarTurno.php?id_turno=<?php echo $turno->getIdTurno()?>&id_taller=<?php echo $idTaller;?>&estado=<?php echo $turno->getEstado()?>">
								Finalizar
							</a>
						</td>

						<td class="<?php if($turno->getEstado()==3 or $turno->getEstado() == 4){echo "finalizado";}elseif($turno->getEstado()==1 or $turno->getEstado() == 2){echo "enCurso";}; ?>">
							<?php $idTurno = $turno->getIdTurno();?>
							<button onclick="consulta(<?php echo $idTurno;?>, <?php echo $turno->getEstado()?>);">Enviar Factura</button>
						</td>
						<?php }?>
						<td>
							<a class = "btnImg" href="eliminar.php?id_turno=<?php echo $turno->getIdTurno();?>&id_taller=<?php echo $idTaller?>&id_estado=<?php echo $turno->getEstado();?>">
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
