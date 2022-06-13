<?php

require_once "../../class/repuestos.php";

$idRepuesto = $_GET['id_Repuesto'];

$repuestos = repuestos::obtenerPorIdRepuesto($idRepuesto);
$repuestos->baja();

header("location: listado.php");

?>  