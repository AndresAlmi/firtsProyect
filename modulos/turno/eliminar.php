<?php

require_once "../../class/turno.php";
$estado = $_GET["id_estado"];


$id = $_GET["id_turno"];
$taller = $_GET["id_taller"];
if($estado == 5){
    header("location: ../turno/listado.php?id_taller=$taller&e_error=cancelado");
    exit;
}
turno::eliminar($id, $taller);
header("location: ../turno/listado.php?id_taller=$taller");

?>