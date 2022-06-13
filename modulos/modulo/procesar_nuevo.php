<?php

require_once "../../class/modulo.php";

$descripcion = $_POST['txtDescripcion'];
$directorio = $_POST['txtDirectorio'];


$modulo = new modulo();

$modulo->setdescripcion($descripcion);
$modulo->setdirectorio($directorio);


$modulo->guardar();

header("location: listado.php");


?>