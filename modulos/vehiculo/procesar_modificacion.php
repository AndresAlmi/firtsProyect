<?php

require_once "../../class/vehiculo.php";

$idVehiculo = $_POST['txtIdVehiculo'];
$color = $_POST['cboColor'];
$marca = $_POST["cboMarca"];
$matricula = $_POST['txtMatricula'];
$modelo = $_POST['cboModelo'];
$color = $_POST['cboColor'];
$anio = $_POST['cboAnio'];

$vehiculo = vehiculo::obtenerPorId($idVehiculo);

$vehiculo->setMatricula($matricula);
$vehiculo->setIdMarca($marca);
$vehiculo->setColor($color);
$vehiculo->setAnio($anio);
$vehiculo->setIdModelo($modelo);



$vehiculo->actualizar();

header("location: listado.php");


?>