<?php

require_once "../../class/Usuario.php";

//var_dump ($_POST);
$id_usuario = $_POST["txtUsuario"];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$dni = $_POST['txtDni'];
$sexo = $_POST['cboSexo'];
$perfil = $_POST['cboPerfil'];

$usuario = Usuario::obtenerPorId($id_usuario);
if(isset($_POST['txtPassword'])){
    if($_POST['txtPassword'] != ""){
        $password = $_POST['txtPassword'];
        $usuario->setPassword($password);
    }else{
        $password = $usuario->getPassword();
        
        $usuario->setPassword($password);
    }
}

//echo $usuario->getPassword();


$usuario->setNombre($nombre);
$usuario->setApellido($apellido);
$usuario->setFechaNacimiento($fechaNacimiento);
$usuario->setSexo($sexo);
$usuario->setDni($dni);
$usuario->setIdPerfil($perfil);


$usuario->actualizar();


header("location: listado.php");


?>