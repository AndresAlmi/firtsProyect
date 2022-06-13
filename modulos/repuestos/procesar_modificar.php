<?php
require_once "../../class/repuestos.php";
$idRepuesto = $_POST["txtIdRepuesto"];
$descripcion = $_POST["txtDescripcion"];
$existencia = $_POST["txtExistencia"];
$existenciaMin = $_POST["txtExistenciaMinima"];
$marca = $_POST["cboMarca"];
$tipoRepuesto = $_POST['cbotipoRepuesto'];
if(isset($_POST["txtIdTaller"])){
    $repuesto = repuestos::obtenerPorIdRepuestoYIdTaller($idRepuesto,$_POST["txtIdTaller"]);
    $idTaller=$_POST["txtIdTaller"];
    $repuesto->setDescripcion($descripcion);
    $repuesto->setExistencia($existencia);
    $repuesto->setExistenciaMin($existenciaMin);
    $repuesto->setIdTipoRepuesto($tipoRepuesto);
    $repuesto->setIdMarca($marca);
    $repuesto->actualizarPorTaller($_POST["txtIdTaller"]);
    header("location: listado.php?id_taller=$idTaller");

}else{
    $repuesto = repuestos::obtenerPorIdRepuesto($idRepuesto);
    
    $repuesto->setDescripcion($descripcion);
    $repuesto->setExistencia($existencia);
    $repuesto->setExistenciaMin($existenciaMin);
    $repuesto->setIdTipoRepuesto($tipoRepuesto);
    $repuesto->setIdMarca($marca);
    $repuesto->actualizar();
    header("location: listado.php");

}








?>