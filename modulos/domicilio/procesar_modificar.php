<?php

require_once "../../class/domicilioPersona.php";

$idPersona = $_POST["txtIdPersona"];
$idDomicilioPersona = $_POST["txtIdDomicilioPersona"];
$barrio = $_POST["cboBarrio"];


if (trim($barrio) == ""){
    header("location: nuevo.php?error=barrioNecesario&id_persona=$idPersona");
    exit;
}
if (trim($calle) !== ""){
    if (strLen($calle) < 3){
        $cont+=1;
    }
}
if (trim($altura) !== ""){
    if (strLen($altura) < 3){
        $cont+=1;
    }
}
if (trim($manzana) !== ""){
    if (strLen($manzana) < 3){
        $cont+=1;
    }
}

if (trim($torre) == ""){
    if (strLen($torre) < 3){
        $cont+=1;
    }
}

if (trim($piso) == ""){
    if (strLen($piso) < 3){
        $cont+=1;
    }
}
if($cont < 4){
    header("location: nuevo.php?error=faltanDatos&id_persona=$idPersona");
    exit;
}
$calle = $_POST["txtCalle"];
$altura = $_POST["txtAltura"];
$manzana = $_POST["txtManzana"];
$torre = $_POST["txtTorre"];
$piso = $_POST["txtPiso"];
$NroCasa = $_POST["txtCasa"];

$domicilio = domicilioPersona::obtenerPorIdPersonaDomicilio($idDomicilioPersona);

$domicilio->setIdBarrio($barrio);
$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setManzana($manzana);
$domicilio->setTorre($torre);
$domicilio->setPiso($piso);
$domicilio->setNumCasa($NroCasa);

$domicilio->actualizar();


header("location: listadoDomicilio.php?id_persona=" . $idPersona);

?>