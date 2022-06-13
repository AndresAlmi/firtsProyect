<?php
require_once "../../class/agenda.php";
require_once "../../class/dia.php";
require_once "../../class/turno.php";
require_once "../../class/turnoServicio.php";

$taller = $_POST["cboTaller"];
$servicio = $_POST['cboServicio'];
$cliente = $_POST["cboCliente"];
$vehiculo = $_POST["cboVehiculo"];
$fecha = $_POST["txtFecha"];
$hora = $_POST["txtHora"];
$mostrarCliente = "";
if (isset($_POST["mostrar"])){
    $mostrarCliente = $_POST["mostrar"];
}



$agenda = agenda::obtenerPorIdTallerEstado($taller);
$idAgenda = $agenda->getidAgenda();

$agenda = agenda::compararFechas($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente);


?>