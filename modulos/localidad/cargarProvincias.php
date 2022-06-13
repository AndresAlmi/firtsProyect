<?php

require_once "../../class/provincia.php";

$idPais = $_GET['id'];

$listadoProvincia = provincia::obtenerPorIdPais($idPais);

$respuesta = "";
$respuesta .= "<option value='0'>--Seleccionar--</option>";
$id = "";
$descripcion = "";

foreach ($listadoProvincia as $Provincia):
    $selected = "";

    if ($Provincia->getIdPais() == $idPais) {
        $selected = "SELECTED";
    }
    $id = $Provincia->getIdProvincia();
    $descripcion = $Provincia->getDescripcion();
    $respuesta .= "<option value='$id'>$descripcion</option>";

endforeach;




echo $respuesta;?>
