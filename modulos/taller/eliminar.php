<?php

require_once "../../class/taller.php";

$idTaller = $_GET['id_taller'];

$taller = taller::obtenerPorId($idTaller);
$taller->baja();

header("location: listado.php");

?>  