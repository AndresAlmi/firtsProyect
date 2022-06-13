<?php

require_once "../../class/factura.php";

$id = $_GET["id_factura"];
$estado = $_GET["estado"];
echo $estado . "<br>";
$estado= $estado * -1;
echo $estado;


$factura = factura::obtenerPorIdFactura($id);

$factura->setEstado($estado);
$factura->cambiarEstado();

header("location: listado.php");

?>