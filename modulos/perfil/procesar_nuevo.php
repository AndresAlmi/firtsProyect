<?php

require_once "../../class/perfil.php";
require_once "../../class/perfilModulo.php";

$descripcion = $_POST['txtDescripcion'];
$modulo = $_POST['cboModulo'];


if (trim($descripcion) == ""){
    header("location: nuevo.php?error=descripcion0");
    exit;
}

if (strLen($descripcion) < 3){
    header("location: nuevo.php?error=descripcion<3");
    exit;
}
if (empty($modulo)){
    header("location: nuevo.php?error=modulo0");
    exit;
}

$perfil  = new Perfil();
$perfil->setDescripcion($descripcion);

$perfil->guardar();
//echo $perfil->getIdPerfil();
$idPerfil = $perfil->getIdPerfil();

foreach($modulo as $moduloId){
    //echo $moduloId . "<br>";
    
    $perfilModulo = new perfilModulo();
    $perfilModulo->setIdPerfil($idPerfil);
    $perfilModulo->setIdModulo($moduloId);
    $perfilModulo->guardar();
}

header("location: listado.php");


?>