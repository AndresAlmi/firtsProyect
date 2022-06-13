<?php

require_once "../../class/tallerContacto.php";

$idTaller = $_GET['id_taller'];
$idContactoTaller = $_GET['id_contacto_taller'];


$tallerContacto = tallerContacto::obtenerPorIdTallerCont($idContactoTaller);

$tallerContacto->eliminar($idContactoTaller);

header("location: listadoContacto.php?id_taller={$idTaller}"); 


?>