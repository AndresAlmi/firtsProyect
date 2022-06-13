<?php
require_once "../../class/dia.php";
require_once "../../class/agenda.php";
$id = $_POST["txtIdAgenda"];
echo $id;

$idAgenda = agenda::obtenerPorIdAgendaEstado($id);
$idTaller = $idAgenda->getIdTaller();

$eliminarDia = dia::obtenerPorIdAgenda($id);
$eliminarDia->eliminar();

if (isset($_POST["chklunes"]) ){
    $chkLunes = $_POST["chklunes"];
} else {
    $chkLunes = "0";
}

if (isset($_POST["chkMartes"]) ){
    $chkMartes = $_POST["chkMartes"];
} else {
    $chkMartes = "0";
}

if (isset($_POST["chkMiercoles"]) ){
    $chkMiercoles = $_POST["chkMiercoles"];
} else {
    $chkMiercoles = "0";
}

if (isset($_POST["chkJueves"]) ){
    $chkJueves = $_POST["chkJueves"];
} else {
    $chkJueves = "0";
}

if (isset($_POST["chkViernes"]) ){
    $chkViernes = $_POST["chkViernes"];
} else {
    $chkViernes = "0";
}

if (isset($_POST["chkSabado"]) ){
    $chkSabado = $_POST["chkSabado"];
} else {
    $chkSabado = "0";
}

if (isset($_POST["chkDomingo"]) ){
    $chkDomingo = $_POST["chkDomingo"];
} else {
    $chkDomingo = "0";
}

$dia = new Dia();

$dia ->setIdAgenda($id);
$dia->setLunes($chkLunes);
$dia->setMartes($chkMartes);
$dia->setMiercoles($chkMiercoles);
$dia->setJueves($chkJueves);
$dia->setViernes($chkViernes);
$dia->setSabado($chkSabado);
$dia->setDomingo($chkDomingo);


$dia->guardar();
header("location: ../agenda/listado.php?id_taller=$idTaller");
?>