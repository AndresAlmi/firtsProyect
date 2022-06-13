<?php
/*$agenda = agenda::obtenerPorId($idAgenda);
		$fechaInicio = new DateTime($fechaInicio = $agenda->getfechainicio());
		$fechaFin = new DateTime($fechaFin = $agenda->getfechafin());

		$intervalo = $fechaInicio->diff($fechaFin);
		$dias = $intervalo->format('%a');

		$interval = new DateInterval("P1D");

		for ($i = 0; $i <= $dias; $i++) {
            $fechaInicio->add($interval);
			$numeroDia = $fechaInicio->format("N");
			echo "numero de dia =";
            if ($numeroDia == 1){
                echo "Lunes";
            }
			echo $numeroDia;
            echo "<br>";
			//echo "<br>";
			//echo "<br>";
			

			if ($diasAtencion[$numeroDia-1] == 1) {
                
				//echo "fecha dia = ";
                
				//echo $fechaInicio->format("Y-m-d");
				//echo "<br>";
				//echo $diasAtencion[$numeroDia-1];
                //echo "<br>";
				if($fecha == $fechaInicio->format("Y-m-d")){
                    echo "buen dia";
                    $turno = new Turno();

                    $turno->setIdTaller($taller);
                    $turno->setIdCliente($cliente);
                    $turno->setIdVehiculo($vehiculo);
                    $turno->setIdAgenda($idAgenda);
                    $turno->setFechaTurno($fecha);
                    $turno->setHoraTurno($hora);
                                    
                    $turno->crearTurno();
                    $idTurno = $turno->getIdTurno();
                                    
                    foreach($servicio as $servicioId){
                    $turnoServicio = new turnoServicio();
                    $turnoServicio->setIdTurno($idTurno);
                    $turnoServicio->setIdServicio($servicioId);
                    $turnoServicio->guardar();
                    }
                
                    
                    $maxTurno +=1; 

                    turno::calcularTurnos($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $maxTurno);
                    exit;
				} else {
                    echo "Mal dia";
                    //header("location:nuevo.php?error=diaNoLaboral");
                    exit;
                }
			}
		}

require_once "class/turno.php";

$lista = [
	array("mes"=>"enero", "total"=>2),
	array("mes"=>"marzo", "total"=>3),
	array("mes"=>"abril", "total"=>4),
	array("mes"=>"mayo", "total"=>10),
];

$datapoint =[];

foreach($lista as $lista):
	$datapoint[] = array("mes"=>$lista["mes"], "total"=>$lista["total"]);
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<link rel= "shortcut icon" href="img/icon.png">
	<link rel="StyleSheet" href = "styles/header.css">
	<link rel="StyleSheet" href = "styles/footer.css">
	<link rel="StyleSheet" href = "styles/inicio.css">
	<script src="js/jquery.3.6.js"></script>
    <script src="js/chart.min.js"></script>

</head>
<body>

<canvas id="myChart" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
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
</body>*/
require_once "class/modelo.php";
$lista = modelo::obtenerPorModeloPorIdVehiculo(32);

    echo $lista->getIdModelo() . ", " . $lista->getDescripcionModelo();
?>
