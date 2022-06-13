<?php

require_once "../../class/vehiculo.php";

$idCliente = $_GET["id"];

$listadoVehiculo = vehiculo::obtenerPorIdCliente($idCliente);

$respuesta = "";

$id = "";
$descripcion = "";

$respuesta .= "<option value='0'>--Seleccionar--</option>";


foreach ($listadoVehiculo as $vehiculo): 
    $id = $vehiculo->getIdVehiculo();
    $descripcion = $vehiculo->getDescripcionModelo();
    
    $respuesta .= "<option value='$id'>$descripcion</option>";

endforeach;

echo $respuesta;?>

