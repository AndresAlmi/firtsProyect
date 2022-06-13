<?php

require_once "../../class/repuestos.php";
$id = $_GET["codigo"];
$descripcion = "";
$repuesto = repuestos::obtenerPorIdRepuesto($id);
$descripcion = $repuesto->getDescripcion();
echo $descripcion;
?>