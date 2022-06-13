<?php

require_once '../../class/agenda.php';
require_once '../../class/dia.php';

$idAgenda = $_GET['id'];
$dia = dia::obtenerPorIdAgenda($idAgenda);
$lunes = "";
$martes = "";
$miercoles = "";
$jueves = "";
$viernes = "";
$sabado = "";
$domingo = "";
if($dia->getlunes()=='1'){$lunes = 'checked';}
if($dia->getMartes()=='1'){$martes = 'checked';}
if($dia->getMiercoles()=='1'){$miercoles = 'checked';}
if($dia->getJueves()=='1'){$jueves = 'checked';}
if($dia->getViernes()=='1'){$viernes = 'checked';}
if($dia->getSabado()=='1'){$sabado = 'checked';}
if($dia->getDomingo()=='1'){$domingo = 'checked';}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='../../styles/square/grey.css'>
    <script src='../../js/jquery.3.6.js'></script>
    <script src='../../js/icheck.min.js'></script>
    <script type="text/javascript" src="../../js/Diachecks.js"></script>

    <style>
        form{
            text-align: center;
        }
        fieldset{
            line-height: 30px;
            font-size: 30px;
            border: 1px solid #7d9fad;
            font-weight: lighter
        }
    </style>
</head>
<body>
    <?php
        $respuesta =    "<form method='POST' action= '../dia/procesar_nuevo.php'> "
        ."    <fieldset >"
        ."        <legend>-Dias-</legend>"
        ."          <input type='hidden' name='txtIdAgenda' value='$idAgenda'>"
        ."          <label for = lunes> Lunes: </label><br>"
        ."          <input type='checkbox' name='chklunes' value='1' " . $lunes ."><br>"
        ."          <label for = martes> Martes: </label><br>"
        ."          <input type='checkbox' name='chkMartes' value='1' ". $martes ."><br>"
        ."          <label for = miercoles> Miercoles: </label><br>"
        ."          <input type='checkbox' name='chkMiercoles' value='1' ". $miercoles."><br>"
        ."          <label for = jueves> Jueves: </label><br>"
        ."          <input type='checkbox' name='chkJueves' value='1' ".$jueves."><br>"
        ."          <label for = viernes> Viernes: </label><br>"
        ."          <input type='checkbox' name='chkViernes' value='1' ".$viernes."><br>"
        ."          <label for = sabado> Sabado: </label><br>"
        ."          <input type='checkbox' name='chkSabado' value='1' " .$sabado. "><br>"
        ."          <label for = Domingo> Domingo: </label><br>"
        ."          <input type='checkbox' name='chkDomingo' value='1' " . $domingo ."><br>"
        ."  </fieldset>"
        ."  <button>Guardar</button>"
        ."</form>";
        
        echo $respuesta;
    ?>



</body>
</html>


        