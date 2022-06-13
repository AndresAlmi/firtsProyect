<?php

require_once "../../class/barrio.php";

$idLocalidad = $_GET['iddd'];

$listadoBarrio = barrio::obtenerPorIdLocalidad($idLocalidad);

$respuesta = "";

$respuesta .= "<option value='0'>--Seleccionar--</option>";

$id = "";
$descripcion = "";

foreach ($listadoBarrio as $barrio):

    $selected = "";

    if ($barrio->getIdLocalidad() == $idLocalidad) {
        $selected = "SELECTED";
    }

    $id = $barrio->getIdbarrio();
    $descripcion = $barrio->getDescripcion();
    $respuesta .= "<option value='$id'>$descripcion</option>";

endforeach;

echo $respuesta;?>

