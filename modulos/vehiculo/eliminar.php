<?php

require_once "../../class/Vehiculo.php";

$idVehiculo = $_GET['id_vehiculo'];

$vehiculo = Vehiculo::obtenerPorId($idVehiculo);
$vehiculo->baja();
if(isset($_GET["id_cliente"])){
    $idCliente = $_GET["id_cliente"];
    header("location: listado.php?id_cliente=$idCliente");
}else{
    header("location: listado.php");

}

?>  