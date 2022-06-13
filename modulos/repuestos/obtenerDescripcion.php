<?php

require_once "../../class/repuestos.php";
$id = $_GET["codigo"];
$descripcion = "";
$repuesto = repuestos::obtenerPorId($id);
$descripcion = $repuesto->getDescripcion();
echo $descripcion;
?>