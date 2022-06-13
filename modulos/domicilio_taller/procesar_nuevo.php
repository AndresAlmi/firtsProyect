<?php

require_once "../../class/domicilioTaller.php";

$idTaller = $_POST["txtIdTaller"];
//echo $idTaller;
$barrio = $_POST["cboBarrio"];
if ($barrio == 0){
    $barrio = "---";
}
$calle = $_POST["txtCalle"];
$altura = $_POST["txtAltura"];
$manzana = $_POST["txtManzana"];
$torre = $_POST["txtTorre"];
$piso = $_POST["txtTorre"];
$NroCasa = $_POST["txtCasa"];

$domicilio = new domicilioTaller();

$domicilio->setIdTaller($idTaller);
$domicilio->setIdBarrio($barrio);
$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setManzana($manzana);
$domicilio->setTorre($torre);
$domicilio->setPiso($piso);
$domicilio->setNumCasa($NroCasa);

$domicilio->guardar();


header("location: /xampp/proyectoPPI/modulos/taller/listado.php");

?>