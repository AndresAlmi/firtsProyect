<?php

require_once "../../class/modulo.php";

$idModulo = $_POST['txtIdModulo'];
$descripcion = $_POST['txtDescripcion'];
$directorio = $_POST['txtDirectorio'];


$modulo = modulo::obtenerPorId($idModulo);

$modulo->setdescripcion($descripcion);
$modulo->setdirectorio($directorio);


$modulo->actualizar();

header("location: listado.php");


?>