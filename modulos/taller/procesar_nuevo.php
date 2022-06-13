<?php

require_once "../../class/taller.php";

$nombre = $_POST['txtNombre'];
$maxturno = $_POST["txtMaxTurno"];

$taller = new taller();
$taller->setMaxTurno($maxturno);
$taller->setNombre($nombre);

$taller->guardar();



header("location: listado.php");


?>