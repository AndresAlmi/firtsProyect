<?php

require_once "../../class/proveedor.php";

$nombre = $_POST['txtNombre'];
$fechaAlta = $_POST['txtFechaAlta'];

if (trim($nombre) == ""){
    header("location: nuevo.php?error=nombre<>0");
    exit;
}

if (strLen($nombre) < 3){
    header("location: nuevo.php?error=nombre<3");
    exit;
}




$proveedor = new proveedor();

$proveedor->setNombre($nombre);
$proveedor->setFechaAlta($fechaAlta);
$proveedor->guardar();

header("location: listado.php");


?>