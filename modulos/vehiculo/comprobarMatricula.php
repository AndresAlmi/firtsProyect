<?php
require_once "../../class/vehiculo.php";

$matricula = $_GET["matricula"];
$respuesta = "";
if(vehiculo::obtenerPorMatricula($matricula) == true){
    $respuesta = "disponible";
}else{
    $respuesta = "ocupada";
}
echo $respuesta;

?>