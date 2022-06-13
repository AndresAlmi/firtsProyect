<?php

require_once "../../class/taller.php";

$idtaller = $_POST['txtIdTaller'];
$nombre = $_POST['txtNombre'];
$maxturno = $_POST["txtMaxTurno"];

$taller = taller::obtenerPorId($idtaller);

$taller->setMaxTurno($maxturno);
$taller->setNombre($nombre);


$taller->actualizar();

header("location: listado.php");


?>