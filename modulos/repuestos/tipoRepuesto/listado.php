<?php

require_once "../../../class/tipoRepuesto.php";
require_once "../../../class/marcaRepuesto.php";
$tipoRepuesto = tipoRepuesto::obtenerTodos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tipo Repuesto</title>
	<link rel= "shortcut icon" href="../../../img/icon.png">
	<link rel="StyleSheet" href = "../../../styles/header.css">
	<link rel="StyleSheet" href = "../../../styles/table.css">
	<link rel= "StyleSheet" href = "../../../styles/button.css">
	<link rel= "StyleSheet" href = "../../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
			
		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../../img/mas.png" height="20px" width="20px"></a>
		</div>
			
		<section id="tabla_busqueda">

			<table>
                <caption></caption>
                <thead>
                    <tr>
                        <th>Id Tipo Repuesto</th>
                        <th>Tipo Repuesto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tipoRepuesto as $tipoRepuesto):?>
                    <tr>
                        <td><?php echo $tipoRepuesto->getIdTipoRepuesto();?></td>
                        <td><?php echo $tipoRepuesto->getDescripcionM();?></td>
                        <td>
                            <a class = "btnImg" href="modificar.php?id_tipo_repuesto=<?php echo $tipoRepuesto->getIdTipoRepuesto();?>"> 
                                <img src = "../../../img/iconModificar.png" width = "40px" heigth = "40px"> 
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            
            </table>
        </section>
    </div>
	<footer>
		<?php require_once "../../../footer.php";?>
	</footer>
</body>
</html>