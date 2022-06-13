<?php
require_once "../../class/repuestos.php";

$id = $_GET["id"];

$respuesta = "";
$respuesta .= "<option value='0'>--Seleccionar--</option>";
$idMod = "";
$descripcion = "";


if($id == "varios"){
    $repuestos = repuestos::obtenerTodos();
}else{
    $repuestos = repuestos::obtenerPorIdTipoRepuesto($id);
}

foreach($repuestos as $repuestos):
    $idMod = $repuestos->getIdRepuesto();
    $descripcion = $repuestos->getDescripcion();
    $respuesta .= "<option value='$idMod'>$descripcion</option>";
    
endforeach;
    
echo $respuesta;



?>