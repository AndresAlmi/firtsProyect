<?php

require_once "../../class/factura.php";

$factura = factura::obtenerTodos();

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
</head>
<body>
	<header class = "horizontal">
		<ul>
			<li class = "logoInicio">
				<a href = "/xampp/proyectoPPI/inicio.php">
					<img src = "/xampp/proyectoPPI/img/Logo2.0.png" width = "40px"  height = "40px">
				</a>
			</li>
			<li>
				<h1>ServiceSystem</h1>
			</li>
			<li class="perfil">
				<a href="#"><img src = "/xampp/proyectoPPI/img/perfil.png" width = "25px"  height = "25px"></a>
				<div class="dropdown-content">
					<ul>
						<li class="cerrarSesion">
							<a href="/xampp/proyectoppi/cerrar_sesion.php">
								<img src = "/xampp/proyectoPPI/img/cerrarSesion.png" width = "15px"  height = "15px">
							</a>
						</li>
					</ul>
				</div>
			</li>	
		</ul>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>
			
		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>ID Factura</th>
						<th>Fecha de Emision</th>
						<th>Numeracion</th>
						<th>Tipo Factura</th>
                        <th>Detalles</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($factura as $factura): ?>

					<tr class="tr">
						
						<td><?php echo $factura->getIdFactura(); ?></td>
						<td><?php echo $factura->getFecha(); ?></td>
						<td><?php echo $factura->getNumeracion(); ?></td>
						<td><?php echo $factura->getIdTipoFactura(); ?></td>
                        <td>
                            <a href="listado.php?id_factura=<?php echo $factura->getIdFactura();?>">VER</a>
                        </td>
					</tr>

					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>
	<footer>
		<div class = "horizontal">
			<ul>
				<li>
					<a class = "null" href="">Año 2021</a>
				</li>
				<li class= "dropDown">
					<a href="">Contacto</a>
					<div class="desplegable">
						<dl class="listaDesplegable">
							<dt>Correo</dt>
							<dd>andres1almiron@gmail.com</dd>
						</dl>
					</div>
				</li>
				<li class= "dropDown">
					<a href=""> Informacion</a>
					<div class="desplegable1">
						<p class="listaDesplegable">
							Este Sitio Forma Parte De Las Practicas Profesionalizantes	
						</p>
					</div>
				</li>
				<li class= "dropDown">
					<a href="">Sobre ServiceSystem</a>
					<div class="desplegable2">
						<p class="listaDesplegable">
							Servicio de AutoGestion De Turnos, Control De Stock y Facturacion.
						</p>
					</div>
				</li>
				
			</ul>
		</div>
	</footer>
</body>
</html>
