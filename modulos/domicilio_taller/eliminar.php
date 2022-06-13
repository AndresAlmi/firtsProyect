<?php

require_once "../../class/domicilioTaller.php";

$idDomicilio = $_GET['id_domicilio'];
$idTaller = $_GET['id_taller'];

$domicilioTaller = domicilioTaller::obtenerPorIdTallerIdDomicilio($idTaller, $idDomicilio);

$domicilioTaller->baja();

header("location:  listadoDomicilio.php?id_taller=" . $idTaller);

?>  