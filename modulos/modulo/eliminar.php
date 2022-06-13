<?php

require_once "../../class/modulo.php";

$idModulo = $_GET['id_modulo'];

$Modulo = Modulo::obtenerPorId($idModulo);
$Modulo->baja();

header("location: listado.php");

?>  