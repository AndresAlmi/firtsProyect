<?php

require_once "../../class/agenda.php";

//var_dump ($_POST);
$id_agenda = $_POST["txtidagenda"];
$idTaller = $_POST["txtidtaller"];
$fechaInicio = $_POST['txtfechaInicio'];
$fechaFin = $_POST['txtfechafin'];
$horaInicio = $_POST['txthorainicio'];
$horaFin = $_POST['txthorafin'];
$estado = $_POST['Cboestado'];




$agenda = Agenda::obtenerPorId($id_agenda);

$agenda->setfechainicio($fechaInicio);
$agenda->setfechafin($fechaFin);
$agenda->sethorainicio($horaInicio);
$agenda->sethorafin($horaFin);
$agenda->setestado($estado);


$agenda->actualizar();

header("location: listado.php?id_taller=$idTaller");


?>  