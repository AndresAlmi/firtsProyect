<?php
require_once "../../class/repuestos.php";
require_once "../../class/taller.php";

$descripcion = $_POST["txtDescripcion"];
$marca = $_POST["cboMarca"];
$tipoRepuesto = $_POST['cboTipoRepuesto'];


$repuesto = new repuestos();

$repuesto->setDescripcion($descripcion);
$repuesto->setIdTipoRepuesto($tipoRepuesto);
$repuesto->setIdMarca($marca);

$repuesto->guardar();

$taller = taller::obtenerTodos();
foreach($taller as $taller):

    repuestos::cargarRepuestosATalleres($taller->getIdTaller(), $repuesto->getIdRepuesto(), 0, 0);
    
endforeach;





header("location: listado.php");


?>