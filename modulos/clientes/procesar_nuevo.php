<?php

require_once "../../class/cliente.php";

$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$dni = $_POST['txtDni'];
$fechaAlta = $_POST['txtFechaAlta'];
$sexo = $_POST['cboSexo'];

if (trim($nombre) == ""){
    header("location: nuevo.php?error=nombre<>0");
    exit;
}

if (strLen($nombre) < 3){
    header("location: nuevo.php?error=nombre<3");
    exit;
}

if (trim($apellido) == ""){
    header("location: nuevo.php?error=apellido");
    exit;
}

if (strLen($apellido) < 3){
    header("location: nuevo.php?error=apellido");
    exit;
}



if (strLen($sexo) == ""){
    header("location: nuevo.php?error=sexo");
    exit;
}



$cliente = new Cliente();

$cliente->setNombre($nombre);
$cliente->setApellido($apellido);
$cliente->setFechaNacimiento($fechaNacimiento);
$cliente->setFechaAlta($fechaAlta);
$cliente->setSexo($sexo);
$cliente->setDni($dni);

$cliente->guardar();

header("location: listado.php");


?>