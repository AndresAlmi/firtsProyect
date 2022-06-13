<?php

require_once "../../class/localidad.php";

$idProvincia = $_GET['idd'];

$listadolocalidad = Localidad::obtenerPorIdProvincia($idProvincia);

$respuesta = "";

$respuesta .= "<option value='0'>Seleccionar</option>";
$id = "";
$descripcion = "";

foreach ($listadolocalidad as $Localidad):
    $selected = "";

    if ($Localidad->getIdProvincia() == $idProvincia) {
        $selected = "SELECTED";
    }
    
    $id = $Localidad->getIdLocalidad();
    $descripcion = $Localidad->getDescripcion();
    $respuesta .= "<option value='$id'>$descripcion</option>";
endforeach;

echo $respuesta;?>
