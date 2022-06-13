<?php

require_once "../../class/Empleado.php";

$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$numeroLegajo = $_POST['txtLegajo'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$dni = $_POST['txtDni'];
$fechaAlta = $_POST['txtFechaAlta'];
$sexo = $_POST['cboSexo'];
$taller = $_POST["cboTaller"];

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



if (strLen($dni) > 0){
    if (strLen($dni) > 10 or strLen($dni) < 8){
        header("location: nuevo.php?error=dni");
        exit;
    }
}

if (strLen($taller) == ""){
    header("location: nuevo.php?error=sexo");
    exit;
}
if (strLen($sexo) == ""){
    header("location: nuevo.php?error=sexo");
    exit;
}

if (strlen($numeroLegajo) < 1){
    header("location: nuevo.php?error=NumeroLegajo");
    exit;
}
$empleado = new Empleado();

$empleado->setNombre($nombre);
$empleado->setApellido($apellido);
$empleado->setNumeroLegajo($numeroLegajo);
$empleado->setFechaNacimiento($fechaNacimiento);
$empleado->setDni($dni);
$empleado->setSexo($sexo);
$empleado->setIdTaller($taller);
$empleado->setFechaAlta($fechaAlta);

$empleado->guardar();

header("location: listado.php");


?>