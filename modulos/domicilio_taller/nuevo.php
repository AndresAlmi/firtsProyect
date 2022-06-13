<?php

require_once "../../class/pais.php";
$listadoPais = pais::obtenerTodos();
$idTaller = $_GET["id_taller"];
?>

<!DOCTYPE html>
<html lang = "es">
<head>
    <title>Nuevo Domicilio</title>
    <link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<script type="text/javascript" src="../../js/formularios.js"></script>
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script type="text/javascript" src="../../js/maksJquery.js"></script>
    <script type="text/javascript" src="../../js/select2funcion.js"></script>
    <script type="text/javascript" src="../../js/domicilio.js"></script>
    <script src="../../js/select2.full.js "></script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
    <nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
    <section class="contenedorFormularios">
        <h1><a href="listado.php">Domicilio</a></h1>
        <form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioDomicilio">

            <input type = "hidden" name = "txtIdTaller" value = "<?php echo $idTaller ?>">
            
            <div class="formulario_grupo" id="grupo_Pais">
                <label for = "pais" class="formulario_label"> Pais: </label>
                <div class="formulario_grupo-input">
                    <select onchange = "cargarProvincias();" id = "cboPais" style="width:100%">
                            <option value = "Null">--Seleccionar--</option>
                            <?php foreach ($listadoPais as $pais): ?>

                                <option value="<?php echo $pais->getIdPais(); ?>">
                                    <?php echo $pais->getDescripcion(); ?>
                                </option>

                            <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="formulario_grupo" id="grupo_Provincia">
                <label for = "provincia" class="formulario_label"> Provincia: </label>
                <div class="formulario_grupo-input">
                    <select onchange = "cargarLocalidades();" id = "cboProvincia" style="width:100%">
                        <option value = "Null">--Seleccionar--</option>
                    </select>
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Localidad">
                <label for = "Localidad" class="formulario_label"> Localidad: </label>
                <div class="formulario_grupo-input">
                    <select  onchange = "cargarBarrio();" id = "cboLocalidad" style="width:100%">
                        <option value = "Null">--Seleccionar--</option>
                    </select>
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Barrio">
                <label for = "Barrio" class="formulario_label"> Barrio: </label>
                <div class="formulario_grupo-input">
                    <select id = "cboBarrio" name = "cboBarrio"  style="width:100%">
                        <option value = "NULL">--Seleccionar--</option>
                    </select>
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Calle">
                <label for = "Calle" class="formulario_label"> Calle: </label>
                <div class="formulario_grupo-input">
                    <input type = "text" name = "txtCalle" class = "formulario_input">
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Altura">
                <label for = "Altura" class="formulario_label"> Altura: </label>
                <div class="formulario_grupo-input">
                    <input type = "number" name = "txtAltura" class = "formulario_input">
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Manzana">
                <label for = "Manzana" class="formulario_label"> Manzana: </label>
                <div class="formulario_grupo-input">
                    <input type = "text" name = "txtManzana" class = "formulario_input">
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Torre">
                <label for = "Torre" class="formulario_label"> Torre: </label>
                <div class="formulario_grupo-input">
                    <input type = "text" name = "txtTorre" class = "formulario_input">
                </div>
            </div>

                <div class="formulario_grupo" id="grupo_Piso">
                <label for = "Piso" class="formulario_label"> Piso: </label>
                <div class="formulario_grupo-input">
                    <input type = "number" name = "txtPiso" class = "formulario_input">
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_Casa">
                <label for = "Casa" class="formulario_label"> N° Casa: </label>
                <div class="formulario_grupo-input">
                    <input type = "number" name = "txtCasa" class = "formulario_input">
                </div>
            </div>
                        
            <div class="formulario_alerta">
                <p>Por favor rellena el formulario.</p>
            </div>

            <div class = "formulario_grupo-btn-enviar">
                <button type="submit" class="formulario_btn">Guardar</button>
            </div>
    
        </form>
    </section>
  
    <footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>