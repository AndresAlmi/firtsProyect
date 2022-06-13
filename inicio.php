<?php

require_once "class/turno.php";
require_once "class/turnoServicio.php";
require_once "class/servicio.php";
require_once "class/taller.php";
$mensaj="";
if(isset($_GET["mensaje"])){
	$mensaj = "Solicitud Completada";
}
$fechaActual = date('Ymd');
$fechaMenosSemana = date("Ymd",strtotime($fechaActual."- 1 week")); 
$lista = turno::obtenerTurnosUltimaSemana($fechaActual, $fechaMenosSemana);

foreach($lista as $lista):
	$mes[] = $lista->getFechaTurno();
	$total[] = $lista->getCantidadTurno();
endforeach;
//highlight_string(var_export($lista, true));
$lista = turno::obtenerEstadoTurnos();
foreach($lista as $lista):
	if($lista->getEstado() == 1){
		$estado[] = "Porcentaje en Curso";
	}else if($lista->getEstado() == 2){
		$estado[] = "Porcentaje Finalizado";

	}else if($lista->getEstado() == 3){
		$estado[] = "Porcentaje en Curso y Facturado";
	}else if($lista->getEstado() == 4){
		$estado[] = "Porcentaje Finalizado y Facturado";
	}else{
		$estado[] = "Porcentaje Cancelado";
	}
	$porcentaje[]=$lista->getCantidadTurno();
endforeach;

$lista = turno::obtenerTurnosTotalesPorTaller();
foreach($lista as $lista):
	$tallerNombre = taller::obtenerPorId($lista->getIdTaller());
	$taller[] = $tallerNombre->getNombre();
	$totalTaller[]=$lista->getCantidadTurno();
endforeach;

$lista = turnoServicio::obtenerServiciosSolicitados();
foreach($lista as $lista):
	$servicios = Servicio::obtenerPorId($lista->getIdServicio());
	$servicio[]= $servicios->getDescripcion();
	$cantidad[]= $lista->getCantidad();

endforeach;


?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<link rel= "shortcut icon" href="img/icon.png">
	<link rel="StyleSheet" href = "styles/header.css">
	<link rel="StyleSheet" href = "styles/inicio.css">
	<link rel="StyleSheet" href = "styles/dashboard.css">
	<link rel="StyleSheet" href = "styles/footer.css">
	<style>
		textarea{
			resize: none;
		}
	</style>
	<script src="js/chart.min.js"></script>

</head>
	<body>
		<header>
			<?php require_once "header.php"?>
		</header>
		<nav>
			<?php require_once "menu.php"; ?>
		</nav>
		<?php if($perfiles == 1){?>
			<div class= "contenedor1">
				<div class="dashboard">
					<div class="bienvenida"><h1>Bienvenido <?php echo $usuario . $mensaj;?></h1></div>

					<div class="statTurnos">
						<canvas id="myChart" width="100%" height="100%"></canvas>
					</div>
					<div class="statAcces">
						<canvas id="myPie" width="100%" height="80%"></canvas>
					</div>

					<div class="statStock">
						<canvas id="turnosTaller" width="100%" height="100%"></canvas>
					</div>
					
					<div class="statServicios">
						<canvas id="servicio" width="100%" height="50%"></canvas>
					</div>
					<div class="statNoticias">
						<form action="modulos/noticia/guardar.php" method="POST">
							<legend>Generar Noticia</legend>
							<div class="left">
								<label for="fecha"></label>
								<div >

									<textarea name="noticias" rows="15" cols="40" placeholder="Ingrese Una Noticia Para los Empleado"></textarea>

								</div>
							</div>
							<button type="submit">Subir</button>
						</form>
					</div>

				</div>
			</div>
		<?php }else if($perfiles == 2){?>
			<?php require_once "inicioCliente.php";?>
		<?php }else{?>
			<?php require_once "inicioEmpleado.php";?>
		<?php }?>
		<footer>
			<?php require_once "footer.php";?>
		</footer>
		<script>
			const table = document.getElementById('myChart').getContext('2d');
			const myChart = new Chart(table, {
				type: 'line',
				data: {
					labels: <?php echo json_encode($mes)?>,
					datasets: [{
						label: 'Turnos de la ultima Semana',
						data: <?php echo json_encode($total)?>,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)',
							'rgba(153, 102, 255, 0.2)',
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)',
							'rgba(255, 206, 86, 1)',
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});

			const pie = document.getElementById('myPie').getContext('2d');
			const myChart1 = new Chart(pie, {
				type: 'pie',
				data:{
					labels: <?php echo json_encode($estado)?>,
					datasets: [{
						data: <?php echo json_encode($porcentaje)?>,
						backgroundColor: [
						'rgb(100, 255, 86)',
						'rgb(54, 162, 235)',
						'rgb(255, 205, 86)',
						'rgb(255, 99, 132)',
						'rgb(49, 49, 49)',

						],
						hoverOffset: 4
					}]
				},
				options: {
					responsive: true,
					legend:{
						position: 'botton'
					},
					plugins:{
						datalabels:{
							color:'#fff',
							anchor:'end',
							aling:'start',
							offset:-10,
							borderWidth: 2,
							borderColor: '#fff',
							backgroundColor: (context)=>{
								return context.dataset.backgroundColor;
							},
							font:{
								weight: 'bold',
								size: '10',
							},
							formatter:(value)=>{
								return value +"3";
							}
						}
					}
				}
			});
			
			const table1 = document.getElementById('turnosTaller').getContext('2d');
			const myChart2 = new Chart(table1, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode($taller)?>,
					datasets: [{
						label: 'Turnos Por Taller',
						data: <?php echo json_encode($totalTaller)?>,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
			const table2 = document.getElementById('servicio').getContext('2d');
			const myChart3 = new Chart(table2, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode($servicio)?>,
					datasets: [{
						label: 'Servicios Más Solicitados',
						data: <?php echo json_encode($cantidad)?>,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
		</script>
	</body>
</html>