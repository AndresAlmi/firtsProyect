<?php

require_once "../../class/usuario.php";
require_once "../../class/cliente.php";
require_once "../../class/empleado.php";

$username = $_POST['txtUsername'];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$fechaAlta = $_POST['txtFechaAlta'];
$dni = $_POST['txtDni'];
$sexo = $_POST['cboSexo'];
$perfil = $_POST['cboPerfil'];
$password = $_POST['txtPassword'];
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

if($usuario=Usuario::comprobarNuevoUsuario($username) == true){
    $usuario = new usuario();

    $usuario->setUsername($username);
    $usuario->setNombre($nombre);
    $usuario->setApellido($apellido);
    $usuario->setFechaNacimiento($fechaNacimiento);
    $usuario->setSexo($sexo);
    $usuario->setDni($dni);
    $usuario->setIdPerfil($perfil);
    $usuario->setPassword($password);
    $usuario->guardar();

    if ($usuario->getIdPerfil() == 2){
        $idPersona = $usuario->getIdPersona();
        $cliente = new Cliente();
        $cliente->setIdPersona($idPersona);
        $cliente->setFechaAlta($fechaAlta);
        $cliente->guardarUsuario();
    } else if($usuario->getIdPerfil() == 52){
        $idPersona = $usuario->getIdPersona();
        $empleado = new Empleado();
        $empleado->setIdPersona($idPersona);
        $empleado->setFechaAlta($fechaAlta);
        $empleado->guardarUsuario();
    }

    header("location: listado.php");

}else{
    header("location: nuevo.php?error=nombreEnUso");
}

exit;



?>