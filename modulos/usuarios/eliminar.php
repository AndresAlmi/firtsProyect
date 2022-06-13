<?php

require_once "../../class/Usuario.php";

$idPersona = $_GET["id_usuario"];

Usuario::eliminar($idPersona);
exit;
header("location: listado.php");

?>