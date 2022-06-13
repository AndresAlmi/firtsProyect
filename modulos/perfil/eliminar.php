<?php

require_once "../../class/perfil.php";
require_once "../../class/perfilModulo.php";


$idPerfil = $_GET['id_perfil'];

$perfilModulo = perfilModulo::obtenerPorIdPerfil($idPerfil);
$perfilModulo->eliminar($idPerfil);
$perfil = Perfil::obtenerPorId($idPerfil);
$perfil->eliminar();

header("location: listado.php");

?>