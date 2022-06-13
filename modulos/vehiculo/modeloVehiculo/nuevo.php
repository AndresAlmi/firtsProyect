<?php 
require_once "../../../class/agenda.php";
require_once "../../../class/taller.php";


$listadoTaller = taller::obtenerTodos();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Modelo Vehiculo</title>
    <script type="text/javascript" src="../../../js/formularios.js"></script>
    <script type="text/javascript" src="../../../js/jquery.3.6.js"></script>
    <link rel="stylesheet" href="../../../styles/select2.min.css">
    <link rel="StyleSheet" href = "../../../styles/nav.css">
    <link rel="stylesheet" href="../../../styles/header.css">
    <link rel="StyleSheet" href = "../../../styles/form.css">
    <link rel="StyleSheet" href = "../../../styles/footer.css">
    <script src="../../../js/select2.full.js "></script>
	<script type="text/javascript" src="../../../js/select2funcion.js"></script>

</head>
<body>
	<header>
		<?php require_once "../../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
        <h1><a href="listado.php">Modelo Vehiculo</a></h1>
        <form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioModeloVehiculo">

            <div class="formulario_grupo" id="grupo_modelo">
                <label for = "descripcion" class = "formulario_label"> Nombre del Modelo:</label>
                <div class="formulario_grupo-input">
                    <input type="text" name = "txtModelo" class = "formulario_input">
                </div>
            </div>

            <div class="formulario_grupo" id="grupo_marca">
                <label for = "marca" class = "formulario_label"> Marca:</label>
                <div class="formulario_grupo-input">
                    <select name="cboMarca" id="cboMarca" class = "cboMarca" style="width:100%">
                        <option value="">--Seleccionar--</option>
                        <?php foreach($marca as $marca):?>
                            <option value="<?php echo $marca->getIdMarca();?>">
                                <?php echo $marca->getDescripcionMarca();?>
                            </option>
                        <?php endforeach;?>
                    </select>
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
        <?php require_once "../../../footer.php";?>
    </footer>
</body>
</html>