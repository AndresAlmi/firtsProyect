<?php

require_once "../../class/Vehiculo.php";

$marca = $_POST["cboMarca"];
$matricula = $_POST['txtMatricula'];
$modelo = $_POST['cboModelo'];
$color = $_POST['cboColor'];
$anio = $_POST['cboAnio'];
$idCliente = $_POST['cboCliente'];

//echo $idCliente;
$matricula = strtoupper($matricula);

$Vehiculo = new Vehiculo();
$Vehiculo->setMatricula($matricula);
$Vehiculo->setIdMarca($marca);
$Vehiculo->setColor($color);
$Vehiculo->setAnio($anio);
$Vehiculo->setIdModelo($modelo);
$Vehiculo->setIdCliente($idCliente);

$Vehiculo->guardar();
if(isset($_POST["mostrar"])){
    header("location: listado.php?id_cliente=$idCliente");
    exit;
}else{
    header("location: listado.php");

}


?>