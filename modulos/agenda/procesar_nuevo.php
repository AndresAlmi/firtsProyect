<?php

require_once "../../class/agenda.php";


$fechaInicio = $_POST['txtfechaInicio'];
$fechafin = $_POST['txtfechafin'];
$horaInicio = $_POST['txthorainicio'];
$horaFin = $_POST['txthorafin'];
$estado = $_POST['Cboestado'];
$idTaller = $_POST['cboTaller'];




$agenda  = new Agenda();
$agenda->setfechainicio($fechaInicio);
$agenda->setfechafin($fechafin);
$agenda->sethorainicio($horaInicio);
$agenda->sethorafin($horaFin);
$agenda->setestado($estado);
$agenda->setIdTaller($idTaller);


$agenda->guardar();

header("location: listado.php?id_taller=$idTaller");


?>