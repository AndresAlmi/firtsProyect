<?php

require_once "../../class/pais.php";
require_once "../../class/domicilioPersona.php";
$listadoPais = pais::obtenerTodos();
$idDomicilio = $_GET["id_domicilio"];
$id = $_GET["id_persona"];
$listadoDomicilioPersona = domicilioPersona::obtenerPorIdPersonaIdDomicilio($id, $idDomicilio);

$mensajeBarrio = "";
$mensajeDatos = "";

if (isset($_GET["error"])){

	switch($_GET["error"]){
		case "barrioNecesario":
			$mensajeBarrio = "El barrio es obligatorio.";
			break;
		case "faltanDatos":
			$mensajeDatos = "Requiere Ingresar Mas de 3 datos.";
			break;
	}
}
?>

<!DOCTYPE html>
<html lang = "es">
<head>
    <title>Nuevo Domicilio</title>
    <script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript">
		function cargarProvincias() {
			var cboPais = $("#cboPais");
			var idPais = cboPais.val();
			$.ajax({
				method: "GET",
				url: "cargarProvincias.php",
				data: {id: idPais}
			})
			.done(function(respuesta_prov) {
				$("#cboProvincia").html(respuesta_prov);
			})
			.fail(function() {
					alert("ERROR");
			});
		}
	</script>
    <script type = "text/javascript">
        function cargarLocalidades(){
            var cboProvincia = $("#cboProvincia");
			var idProvincia = cboProvincia.val();
			$.ajax({
				method: "GET",
				url: "cargarLocalidades.php",
				data: {idd: idProvincia}
			})
			.done(function(respuesta) {
				$("#cboLocalidad").html(respuesta);
			})
			.fail(function() {
					alert("ERROR");
			});
        }
    </script>
    <script type = "text/javascript">
        function cargarBarrio(){
            var cboLocalidad = $("#cboLocalidad");
			var idLocalidad = cboLocalidad.val();
			$.ajax({
				method: "GET",
				url: "cargarBarrios.php",
				data: {iddd: idLocalidad}
			})
			.done(function(respuesta) {
				$("#cboBarrio").html(respuesta);
			})
			.fail(function() {
					alert("ERROR");
			});
        }
    </script>
	<link rel="StyleSheet" href = "../../styles/nav.css">
    <link rel="StyleSheet" href = "../../styles/form.css">
</head>
<body>
    <header>
		<?php require_once "../../header.php"?>
	</header>
    <nav>
        <?php require_once "../../menu.php"; ?>
    </nav>
    <section class = "formulario">
        <form method = "POST" action = "procesar_modificar.php">
            <fieldset> 
                <legend>Domicilio</legend>
                <input type = "hidden" name = "txtIdDomicilioPersona" value = "<?php echo $listadoDomicilioPersona->getIdDomicilioPersona();?>">
                <input type = "hidden" name = "txtIdPersona" value = "<?php echo $id ?>">
                <label for = "pais"> Pais: </label>
                <select onchange = "cargarProvincias();" id = "cboPais">
                
                    <option value = "Null">--Seleccionar--</option>
                    <?php foreach ($listadoPais as $pais): ?>

                        <option value="<?php echo $pais->getIdPais(); ?>">
                            <?php echo $pais->getDescripcion(); ?>
                        </option>

                    <?php endforeach ?>
                </select>

                <label for = "provincia"> Provincia: </label>
                <select onchange = "cargarLocalidades();" id = "cboProvincia">
                    <option value = "Null">--Seleccionar--</option>
                </select>

                <label for = "localidad"> Localidad: </label>
                <select  onchange = "cargarBarrio();" id = "cboLocalidad">
                    <option value = "Null">--Seleccionar--</option>
                </select>
                <?php echo $mensajeBarrio;?>
                <label for = "barrio"> Barrio: </label>
                <select id = "cboBarrio" name = "cboBarrio" value = "<?php echo $listadoDomicilioPersona->getIdBarrio(); ?>">
                    <option value = "NULL">--Seleccionar--</option>
                </select>

                <label for = "calle"> Calle: </label>
                <input type = "text" name = "txtCalle" value = "<?php echo $listadoDomicilioPersona->getCalle(); ?>">

                <label for = "altura"> Altura: </label>
                <input type = "number" name = "txtAltura" value = "<?php echo $listadoDomicilioPersona->getAltura(); ?>">

                <label for = "Manzana"> Manzana: </label>
                <input type = "text" name = "txtManzana" value = "<?php echo $listadoDomicilioPersona->getManzana(); ?>">

                <label for = "torre"> Torre: </label>
                <input type = "text" name = "txtTorre" value = "<?php echo $listadoDomicilioPersona->getTorre(); ?>">

                <label for = "piso"> Piso: </label>
                <input type = "number" name = "txtPiso" value = "<?php echo $listadoDomicilioPersona->getPiso(); ?>">

                <label for = "numCasa"> Nroº de Casa: </label>
                <input type = "number" name = "txtCasa" value = "<?php echo $listadoDomicilioPersona->getNumCasa(); ?>">
                
                <?php echo $mensajeDatos;?>
            </fieldset>
			<button onclick = "ValidarDirección()"> Actualizar Domicilio </button>
        </form>
    </section>
    <footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>