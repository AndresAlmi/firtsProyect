<?php

require_once "../../class/factura.php";
require_once "../../class/tipoFactura.php";

require_once "../../class/turnoServicio.php";

$factura = factura::obtenerTodos();
$idTurno = 0;
$class="";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Taller</title>
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
			$('#tablaFactura').DataTable();
		} );
	</script>
	<style>
		p.NoPagada{
			background-color: rgb(28, 83, 28, 0.100);
		}
		a.NoPagada{
			color: rgba(0, 202, 0, 0.800);
		}
		p.Pagada{
			background-color: rgba(200, 20, 20, 0.100);
		}
		a.Pagada{
			color: rgba(200, 20, 20, 0.800);
		}
	</style>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>FACTURA</h2>	

		<section id="tabla_busqueda">

			<table id="tablaFactura">
				<thead>
					<tr>
						<th>Numeracion</th>
						<th>Fecha de Emision</th>
						<th>Tipo Factura</th>
						<th>Numero de Turno</th>
						<th>Cliente</th>
						<th>Estado</th>
						<th>Finalizar</th>
						<th>Detalles</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($factura as $factura): ?>
						<?php
						$idFactura = $factura->getIdFactura();
						$turnoServicio = turnoServicio::obtenerFactura($idFactura);

						foreach($turnoServicio as $turnoServicio):
							$idTurno = $turnoServicio->getIdTurno();
						endforeach;
						
						$turno = turno::obtenerPorIdTurno($idTurno);
						
						$idCliente = $turno->getIdCliente();
						$cliente = cliente::obtenerPorId($idCliente);

						$TipoFactura = tipoFactura::obtenerPorId($factura->getIdTipoFactura());
						
						?>
					<tr>
						<td><?php echo $factura->getNumeracion(); ?></td>
						<td><?php echo $factura->getFecha(); ?></td>
						<td><?php echo $TipoFactura->getDescripcion(); ?></td>
						<td><?php echo $idTurno ?></td>
						<td><?php echo $cliente->getNombre() .", ". $cliente->getApellido(); ?></td>
						<td>
							<?php 
							$mensaje = "";
							if($factura->getEstado() == 1){
								$class = "NoPagada";
								echo "<p class='$class'>No Pagada</p>";
								$mensaje = "Realizar Pago";
							}else{
								$class = "Pagada";
								echo "<p class='$class'>Pagada</p>";
								$mensaje = "Rechazar Pago";
							}
							?>
						</td>
						<td>
							<a class="<?php echo $class; ?>"href="cambiarEstado.php?id_factura=<?php echo $idFactura?>&estado=<?php echo $factura->getEstado()?>">
								<?php echo $mensaje;?>
							</a>
						</td>
                        <td>
                            <a href="detalle.php?id_factura=<?php echo $factura->getIdFactura();?>&estado=<?php echo $factura->getEstado()?>">VER</a>
                        </td>
						<td>
							<a class = "btnImg" href="eliminar.php?&id_factura=<?php echo $idFactura?>">
								<img src = "../../img/iconBorrar.png" width = "40px" heigth = "40px">
							</a>
						</td>
					</tr>

					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>
	<footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>
