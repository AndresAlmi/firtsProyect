<?php

require_once "../../class/cliente.php";

$idCliente = $_GET['id_cliente'];

$cliente = Cliente::obtenerPorId($idCliente);
$cliente->baja();

header("location: listado.php");

?>  