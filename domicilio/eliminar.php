<?php

require_once "../../class/domicilioPersona.php";

$idDomicilio = $_GET['id_domicilio'];
$idPersona = $_GET['id_persona'];

$domicilioPersona = domicilioPersona::obtenerPorIdPersonaIdDomicilio($idPersona, $idDomicilio);

$domicilioPersona->baja();

header("location:  listadoDomicilio.php?id_persona=" . $idPersona);

?>  