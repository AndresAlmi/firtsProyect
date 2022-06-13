<?php

require_once "../../class/personaContacto.php";

$idPersona = $_GET['id_persona'];
$idContactoPersona = $_GET['id_contacto_persona'];

$personaContacto = personaContacto::obtenerPorIdPersonaCont($idContactoPersona);
$personaContacto->eliminar($idContactoPersona);
header("location: listadoContacto.php?id_persona={$idPersona}"); 


?>