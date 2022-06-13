<?php

require_once "../../class/personaContacto.php";

$idPersona = $_POST["txtIdPersona"];
$idTipoContacto  = $_POST["cboTipoContacto"];
$valor = $_POST["txtValor"];

$contacto = new personaContacto();

$contacto ->setIdPersona($idPersona); 
$contacto ->setIdTipoContacto($idTipoContacto); 
$contacto ->setValor($valor); 

$contacto ->guardar();

header("location: listadoContacto.php?id_persona=". $idPersona);






?>