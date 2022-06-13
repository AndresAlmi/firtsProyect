<?php
require_once "../../class/repuestoProveedor.php";
require_once "../../class/repuestos.php";
$repuesto = $_POST["idProducto"];
$cantidad = $_POST["cantidad"];
$proveedor = $_POST["cboProveedor"];
$fecha = $_POST["fecha"];

$i = 0;
$nuevaCantidad = 0;

foreach($repuesto as $repuesto):
    $nuevaCantidad = $cantidad[$i];
    
    $repuestoProveedor = new repuestoProveedor();
    $repuestoProveedor->setIdRepuesto($repuesto);
    $repuestoProveedor->setCantidad($nuevaCantidad);
    $repuestoProveedor->setIdProveedor($proveedor);
    $repuestoProveedor->setFecha($fecha);
    $repuestoProveedor->guardar();

    $i += 1;
endforeach;

?>