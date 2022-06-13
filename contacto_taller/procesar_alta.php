<?php

require_once "../../class/tallerContacto.php";

$idTaller = $_POST["txtIdTaller"];
$idTipoContacto  = $_POST["cboTipoContacto"];
$valor = $_POST["txtValor"];

$contacto = new tallerContacto();

$contacto ->setIdTaller($idTaller); 
$contacto ->setIdTipoContacto($idTipoContacto); 
$contacto ->setValor($valor); 

$contacto ->guardar();

header("location: listadoContacto.php?id_taller=". $idTaller);






?>