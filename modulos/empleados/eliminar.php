<?php

require_once "../../class/Empleado.php";

$idEmpleado = $_GET['id_empleado'];

$empleado = Empleado::obtenerPorId($idEmpleado);
$empleado->baja();

header("location: listado.php");

?>