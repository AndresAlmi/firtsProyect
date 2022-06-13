<?php

require_once "../../../class/modelo.php";

$modelo = modelo::obtenerTodos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modelo</title>
	<link rel= "shortcut icon" href="../../../img/icon.png">
	<link rel="stylesheet" href="../../../styles/header.css">
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
                <thead>
                    <tr>
                        <th>ID Marca</th>
                        <th>Marca</th>
                        <th>ID Modelo</th>
                        <th>Modelo</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($modelo as $modelo):?>
                    <tr>
                        <td><?php echo $modelo->getIdMarca();?></td>
                        <td><?php echo $modelo->getDescripcionMarca();?></td>
                        <td><?php echo $modelo->getIdModelo();?></td>
                        <td><?php echo $modelo->getDescripcionModelo();?></td>
                        <td>
                            <a class = "btnImg" href="modificar.php?id_modelo=<?php echo $modelo->getIdModelo();?>"> 
                                <img src = "../../../img/iconModificar.png" width = "40px" heigth = "40px"> 
                            </a>
                        </td>
                        <td>
                            <a class = "btnImg" href="eliminar.php?id_modelo=<?php echo $modelo->getIdModelo();?>">
                                <img src = "../../../img/iconBorrar.png" width = "40px" heigth = "40px"> 
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