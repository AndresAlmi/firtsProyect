<?php

require_once "../../../class/repuestos.php";

$idMarca = $_GET['idMarca'];
$idTipo = $_GET['idTipo'];

$listaRepuesto = repuestos::obtenerPorIdMarcaYTipoRepuesto($idMarca, $idTipo);

$respuesta = "";


$respuesta .= "<option value='0'>Seleccionar</option>";

$id = "";
$descripcion = "";

foreach ($listaRepuesto as $repuesto):

    $id = $repuesto->getIdRepuesto();
    $descripcion = $repuesto->getDescripcion();

    $respuesta .= "<option value='$id'>$descripcion</option>";

endforeach;

echo $respuesta;?>