<?php
require_once "../../class/turno.php";
require_once "../../class/turnoServicio.php";
require_once "../../class/cliente.php";
require_once "../../class/tipoPago.php";
require_once "../../class/tipoFactura.php";
require_once "../../class/factura.php";




$fecha=$_POST["fecha"];
$tipoFactura = $_POST["cboTipoFactura"];
$tipoPago = $_POST["cboTipoPago"];
$idTurno = $_POST['txtIdTurno'];
$cantidad = ["cantidad"];
echo $idTurno . "<br>";

$turno = turno::obtenerPorIdTurno($idTurno);
echo $turno->getEstado();
if($turno->getEstado() == 1){
    $turno->setEstado(3);
    $turno->cambiarEstado();
}else if($turno->getEstado() == 2){
    $turno->setEstado(4);
    $turno->cambiarEstado();
    exit;
}


$factura = new factura();
$factura->setIdTipoFactura($tipoFactura);
$factura->setFecha($fecha);
$factura->guardar();

$idFactura = $factura->getIdFactura();

$facturaPago = new tipoPago();
$facturaPago->setIdTipoPago($tipoPago);
$facturaPago->setIdFactura($idFactura);
$facturaPago->guardar();

$turnoServi = turnoServicio::obtenerPorIdTurno($idTurno);
foreach($turnoServi as $turnoServi):
    $turnoServi->setIdFactura($idFactura);
    $turnoServi->guardarFactura();
endforeach;

header("location:listado.php?id_factura=$idFactura");
?>