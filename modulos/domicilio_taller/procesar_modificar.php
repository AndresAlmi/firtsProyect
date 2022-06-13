<?php
require_once "../../class/domicilioTaller.php";

$idTaller = $_POST["txtIdTaller"];
$idDomicilioTaller = $_POST["txtIdDomicilioTaller"];
$barrio = $_POST["cboBarrio"];
if ($barrio == 0){
    $barrio = "---";
}

$calle = $_POST["txtCalle"];
$altura = $_POST["txtAltura"];
$manzana = $_POST["txtManzana"];
$torre = $_POST["txtTorre"];
$piso = $_POST["txtPiso"];
$NroCasa = $_POST["txtCasa"];

$domicilio = domicilioTaller::obtenerPorIdtallerDomicilio($idDomicilioTaller);

$domicilio->setIdBarrio($barrio);
$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setManzana($manzana);
$domicilio->setTorre($torre);
$domicilio->setPiso($piso);
$domicilio->setNumCasa($NroCasa);

$domicilio->actualizar();


header("location: listadoDomicilio.php?id_taller=" . $idTaller);

?>