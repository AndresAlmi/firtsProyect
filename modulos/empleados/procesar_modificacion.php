<?php

require_once "../../class/Empleado.php";

$id_empleado = $_POST["txtIdEmpleado"];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$numeroLegajo = $_POST['txtNumeroLegajo'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$fechaAlta = $_POST['txtFechaAlta'];
$sexo = $_POST['cboSexo'];
$dni = $_POST['txtDni'];
echo $fechaAlta;

if (trim($nombre) == ""){
    header("location: modificar.php?error=nombre<>0&id_empleado={$id_empleado}");
    exit;
}
if (strLen($nombre) < 3){
    header("location: modificar.php?error=nombre<3&id_empleado={$id_empleado}");
    exit;
}

if (trim($apellido) == ""){
    header("location: modificar.php?error=apellido&id_empleado={$id_empleado}");
    exit;
}

if (strLen($apellido) < 3){
    header("location: modificar.php?error=apellido&id_empleado={$id_empleado}");
    exit;
}

if ($fechaAlta < $fechaNacimiento){
    header("location: modificar.php?error=fechaAlta&id_empleado={$id_empleado}");
    exit;
}

if (strLen($dni) > 0){
    if (strLen($dni) > 10 or strLen($dni) < 8){
        header("location: modificar.php?error=dni&id_empleado={$id_empleado}");
        exit;
    }
}


if ($sexo == 0){
    header("location: modificar.php?error=sexo&id_empleado={$id_empleado}");
    exit;
}

$empleado = Empleado::obtenerPorId($id_empleado);

$empleado->setNombre($nombre);
$empleado->setApellido($apellido);
$empleado->setNumeroLegajo($numeroLegajo);
$empleado->setFechaNacimiento($fechaNacimiento);
$empleado->setFechaAlta($fechaAlta);
$empleado->setSexo($sexo);
$empleado->setDni($dni);

$empleado->actualizar();
header("location: listado.php");


?>