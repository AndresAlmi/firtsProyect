<?php

require_once "../../class/perfilModulo.php";
require_once "../../class/perfil.php";

//Obtener datos de formulario//
$idPerfil = $_POST["txtidperfil"];
$descripcion = $_POST['txtdescripcion'];
$modulo = $_POST['cboModulo'];

//Validaciones por lado del servidor//
if (trim($descripcion) == ""){
    header("location: modificar.php?error=descripcion0&id_perfil=".$idPerfil);
    exit;
}

if (strLen($descripcion) < 3){
    header("location: modificar.php?error=descripcion<3&id_perfil=".$idPerfil);
    exit;
}
if (empty($modulo)){
    header("location: modificar.php?error=modulo0&id_perfil=".$idPerfil);
    exit;
}

//Actualizar descripcion perfil//

$perfil = perfil::obtenerPorId($idPerfil);
$perfil->setDescripcion($descripcion);
$perfil->actualizar();

//Eliminamos los datos de la clase perfilModulo//

$perfilModulo = perfilModulo::obtenerPorIdPerfil($idPerfil);
$perfilModulo->eliminar($idPerfil);


//Recargamos los nuevos datos//
foreach($modulo as $moduloId){

    $perfilModulo = new perfilModulo();
    $perfilModulo->setIdPerfil($idPerfil);
    $perfilModulo->setIdModulo($moduloId);
    $perfilModulo->guardar();

}

header("location: listado.php");


?>