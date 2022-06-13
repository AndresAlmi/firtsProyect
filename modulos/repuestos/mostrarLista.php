<?php
require_once "../../class/repuestos.php";

$id = $_GET["id"];


$respuesta = "";
$respuesta .= "<option value='0'>--Seleccionar--</option>";
$id = "";
$descripcion = "";

if($id == "varios"){
    $repuestos = repuestos::obtenerTodos();


    foreach($repuestos as $repuestos):
        $id = $repuestos->getIdRepuesto();
        $descripcion = $repuestos->getDescripcion();
        $respuesta .= "<option value='$id'>$descripcion</option>";

    endforeach;

    echo $respuesta;

}else{
    
    $repuestos = repuestos::obtenerPorIdModelo($id);

    foreach($repuestos as $repuestos):
        $id = $repuestos->getIdRepuesto();
        $descripcion = $repuestos->getDescripcion();
        $respuesta .= "<option value='$id'>$descripcion</option>";
    
    endforeach;
    
    echo $respuesta;
}


?>