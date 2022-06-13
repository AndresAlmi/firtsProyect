<?php

require_once "../../class/tipoServicio.php";


$nombre = $_POST['txtNombre'];


$tipoServicio = new tipoServicio();

$tipoServicio->setDescripcion($nombre);


$tipoServicio->guardar();

header("location: ../servicios/listado.php");


?>