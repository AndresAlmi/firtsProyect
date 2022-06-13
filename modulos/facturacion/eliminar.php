<?php
require_once "../../class/factura.php";
$id = $_GET["id_factura"];

$factura = factura::eliminar($id);
?>