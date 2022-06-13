<?php
require_once "../../class/turnoServicio.php";
$id = $_GET["id"];
$modelo = modelo::obtenerPorModeloPorIdVehiculo($id);
$idModelo = $modelo->getIdModelo();

$lista = turnoServicio::obtenerServiciosPorIdModelo($idModelo);
$respuesta = "";
$respuesta .= "<dl>";

foreach($lista as $lista):
    $servicio = Servicio::obtenerPorId($lista->getIdServicio());
    $respuesta .= "<dt>" . $servicio->getDescripcion();
    $respuesta .= "    <dd>" . "Cantidad: " . $lista->getCantidad() . "<br>";
endforeach;
$respuesta .= "</dl>";

echo $respuesta;?>