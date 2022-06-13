<?php
require_once "../../class/repuestoProveedor.php";
require_once "../../class/proveedor.php";

$listadoRepuestoProveedor = repuestoProveedor::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Repuesto Proveedor</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
    <link rel="stylesheet" href="../../styles/datatables.min.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/datatables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tablaCompra').DataTable();
		} );
	</script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
    <div class="contenedorTabla">
        <h2>COMPRAS</h2>

        <div class="agregarNuevo">
			<label for="">ADQUIRIR</label>
			<a href="adquirir.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>
        <section id="tabla_busqueda">
            <table id="tablaCompra">
                <caption></caption>
                <thead>
                    <tr>
                        <th>Id Proveedor</th>
                        <th>Nombre Proveedor</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
						<th>Estado</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listadoRepuestoProveedor as $lista):?>
                    <?php $proveedor = proveedor::obtenerPorId($lista->getIdProveedor()); $nombre = $proveedor->getNombre(); ?>
                    <tr class="tr"> 
                        
                        <td><?php echo $lista->getIdProveedor();?></td>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $lista->getCantidad();?></td>
                        <td><?php echo $lista->getFecha();?></td>
						<td>
							<?php if($lista->getEstado() == 1){echo "Pendiente";}else{ echo "Adquirido";}?>
						</td>
                        <td>
                            <a href="detalle.php?id_proveedor=<?php echo $lista->getIdProveedor();?>&fecha=<?php echo $lista->getFecha()?>">Ver Detalle</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
    
        </section>
    </div>
    <footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>