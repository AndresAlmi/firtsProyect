<?php

require_once "../../../class/modelo.php";

$idModelo = $_GET['id_modelo'];

$modelo = modelo::obtenerPorId($idModelo);
$modelo->eliminar();

header("location: listado.php");

?>  