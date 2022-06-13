<?php

require_once "../../class/vehiculo.php";

$idMarca = $_GET['id'];

$listadoModelo = modelo::obtenerPorIdMarca($idMarca);
$respuesta = "";


$respuesta .= "<option value='0'>Seleccionar</option>";

$id = "";
$descripcion = "";

foreach ($listadoModelo as $Modelo): 
    $selected = "";
    $id = $Modelo->getIdModelo();
    $descripcion = $Modelo->getDescripcionModelo();

    if ($idMarca == $Modelo->getIdMarca()) {
        $selected = "SELECTED";
    }
    $respuesta .= "<option value='$id'>$descripcion</option>";

endforeach;

echo $respuesta;?>
