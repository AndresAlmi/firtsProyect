<?php

require_once "../../class/Usuario.php";


$lista = Usuario::obtenerTodos();

?>
<!DOCTYPE html>
<html lang = "es">
<head>
	<title>USUARIOS</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<div class="contenedorTabla">
		<h2>USUARIOS</h2>	

		<div class="agregarNuevo">
			<label for="">AGREGAR NUEVO</label>
			<a href="nuevo.php"><img src="../../img/mas.png" height="20px" width="20px"></a>
		</div>

		<section id="tabla_busqueda">

			<table>
				<thead>
					<tr>
						<th>ID Usuario</th>
						<th>Username</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Dni</th>
						<th>Fecha Nacimiento</th>
						<th>Sexo</th>
						<th colspan = "2">Acciones</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach  ($lista as $usuario): ?>
					<tr class="tr">
						
						<td><?php echo $usuario->getIdUsuario(); ?></td>
						<td><?php echo $usuario->getUsername(); ?></td>
						<td><?php echo $usuario->getNombre(); ?></td>
						<td><?php echo $usuario->getApellido(); ?></td>
						<td><?php echo $usuario->getDni(); ?></td>
						<td><?php echo $usuario->getFechaNacimiento(); ?></td>
						<td><?php echo $usuario->getIdSexo();?></td>
						<td>
							<a class = "btnImg" href="modificar.php?id_usuario=<?php echo $usuario->getidusuario(); ?>">
								<img src = "../../img/iconModificar.png" width = "40px" heigth = "40px">
							</a>
						</td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_usuario=<?php echo $usuario->getIdPersona(); ?>"> 
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
