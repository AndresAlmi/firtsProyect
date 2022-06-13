<?php
require_once "../../class/repuestoProveedor.php";
require_once "../../class/repuestos.php";
if(isset($_POST["idProducto"])){
    $repuesto = $_POST["idProducto"];
}else{
    header("location: adquirir.php?error=repuesto");
    exit;
    
}

if(isset($_POST["cantidad"])){
    $cantidad = $_POST["cantidad"];
}else{
    header("location: adquirir.php?error=cantidad");
    exit;

}
if($_POST["cboProveedor"] != "0"){
    $proveedor = $_POST["cboProveedor"];
}else{
    header("location: adquirir.php?error=proveedor");
    exit;
}
$fecha = $_POST["fecha"];

//$precio = $_POST["precio"];

$i = 0;
$total = 0;
$nuevaCantidad = 0;

foreach($repuesto as $repuesto):
    $nuevaCantidad = $cantidad[$i];
    //$nuevoPrecio = $precio[$i];
    $repuestoProveedor = new repuestoProveedor();
    $repuestoProveedor->setIdRepuesto($repuesto);
    //$repuestoProveedor->setPrecio($nuevoPrecio);
    $repuestoProveedor->setCantidad($nuevaCantidad);
    $repuestoProveedor->setIdProveedor($proveedor);
    $repuestoProveedor->setFecha($fecha);
    $repuestoProveedor->guardar();
    //$total += $nuevoPrecio;
    $i += 1;
endforeach;

header("location: listado.php")

?>