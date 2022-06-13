<?php

require_once "../../../class/marca.php";

$idMarca = $_GET['id_marca'];

$marca = marca::obtenerPorId($idMarca);
$marca->eliminar();

header("location: listado.php");

?>  