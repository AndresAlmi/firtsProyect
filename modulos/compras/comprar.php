<?php
require_once "../../class/repuestos.php";
require_once "../../class/repuestoProveedor.php";

$repuesto = $_POST["repuesto"];
$cantidad = $_POST["cantidad"];
$Taller = $_POST["cboTaller"];
$proveedor = $_POST["proveedor"];

echo $Taller;
/*
$i = 0;
$nuevaCantidad = 0;

foreach($repuesto as $repuesto):
    $nuevaCantidad = $cantidad[$i];
    echo $repuesto . $nuevaCantidad . "<br>";
    repuestos::sumarStock($repuesto, $nuevaCantidad);

    $i += 1;
endforeach;*/

for($i = 0; $i<count($repuesto); $i++){
    $nuevaCantidad = $cantidad[$i];
    repuestos::sumarStock($repuesto[$i], $nuevaCantidad, $Taller);
    repuestoProveedor::cambiarEstado(0, $proveedor, $repuesto[$i], $nuevaCantidad);
}
header("location:listado.php");
?>