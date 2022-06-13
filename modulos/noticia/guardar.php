<?php
require_once "../../class/noticias.php";

$noticia = $_POST["noticias"];

noticias::guardar($noticia);
header("location: /xampp/proyectoppi/inicio.php")
?>