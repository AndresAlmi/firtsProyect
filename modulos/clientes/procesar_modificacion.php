<?php

require_once "../../class/Cliente.php";

$id_cliente = $_POST["txtIdcliente"];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$fechaAlta = $_POST['txtFechaAlta'];
$sexo = $_POST['cboSexo'];
$dni = $_POST['txtDni'];
$tipoCliente = $_POST["cboTipoCliente"];

if (trim($nombre) == ""){
    header("location: modificar.php?error=nombre<>0&id_cliente={$id_cliente}");
    exit;
}
if (strLen($nombre) < 3){
    header("location: modificar.php?error=nombre<3&id_cliente={$id_cliente}");
    exit;
}

if (trim($apellido) == ""){
    header("location: modificar.php?error=apellido&id_cliente={$id_cliente}");
    exit;
}

if (strLen($apellido) < 3){
    header("location: modificar.php?error=apellido&id_cliente={$id_cliente}");
    exit;
}

if ($fechaAlta < $fechaNacimiento){
    header("location: modificar.php?error=fechaAlta&id_cliente={$id_cliente}");
    exit;
}

if (strLen($dni) > 0){
    if (strLen($dni) > 10 or strLen($dni) < 8){
        header("location: modificar.php?error=dni&id_cliente={$id_cliente}");
        exit;
    }
}


if (strLen($sexo) == ""){
    header("location: modificar.php?error=sexo&id_cliente={$id_cliente}");
    exit;
}

$cliente = cliente::obtenerPorId($id_cliente);

$cliente->setNombre($nombre);
$cliente->setApellido($apellido);
$cliente->setFechaNacimiento($fechaNacimiento);
$cliente->setFechaAlta($fechaAlta);
$cliente->setSexo($sexo);
$cliente->setDni($dni);
$cliente->setTipoCliente($tipoCliente);

$cliente->actualizar();

header("location: listado.php");


?>