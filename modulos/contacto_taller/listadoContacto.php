<?php

require_once "../../class/tallerContacto.php";
require_once "../../class/tipoContacto.php";
require_once "../../class/taller.php";


$idTaller = $_GET["id_taller"];

$listadocontacto = tallerContacto::obtenerPorIdTaller($idTaller);

$listadoTipoContacto = tipoContacto::obtenerTodos();
$tallerLocal = taller::obtenerPorId($idTaller);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/table.css">
	<link rel= "StyleSheet" href = "../../styles/button.css">
	<link rel= "StyleSheet" href = "../../styles/footer.css">
	<style>
		.contenedorFormularios{
			text-align: center;
		}
		.contenedorFormularios select{
			text-align: center;
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
		<h1><a href="javascript:history.back()"><?php echo $tallerLocal->getNombre()?></a></h1>

		<section class="contenedorFormularios">
			<form action="procesar_alta.php" method="POST" class="formulario" id="formularioContactoTaller">
				
					<input type="hidden" name="txtIdTaller" value="<?php echo $idTaller; ?>">


					<div class="formulario_grupo" id="grupo_tipoContacto:">
						<label for = "tipoContacto" class = "formulario_label"> Tipo Contacto: </label>
						<div class="formulario_grupo-input">
							<select class="cboTipoContacto" name="cboTipoContacto" id = "cboTipoContacto" style="width: 100%">
								<option value=0>Seleccionar</option>

								<?php foreach ($listadoTipoContacto as $tipocontacto): ?>

									<option value="<?php echo $tipocontacto->getIdTipoContacto(); ?>">
										<?php echo $tipocontacto->getDescripcion(); ?>
									</option>
										
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="formulario_grupo" id="grupo_txtValor">
						<label for = "Valor" class = "formulario_label"> Valor: </label>
						<div class="formulario_grupo-input">
							<input class = "formulario_input" type="text" style="width: 100%" name="txtValor" id="txtValor">
						</div>
					</div>

						
					&nbsp;&nbsp;&nbsp;

					<input type="submit" value="Agregar">
					<br><br>
				
				</fieldset>
				
			</form>
		</section>
		<section class = "tabla">
			<table>
				<thead>
					<tr>
						<th>Descripcion</th>
						<th>Valor</th>
						<th>Borrar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($listadocontacto as $contacto): ?>

					<tr>
						<td><?php echo $contacto->getDescripcion(); ?></td>
						<td><?php echo $contacto->getValor(); ?></td>
						<td>
							<a class = "btnImg" href="eliminar.php?id_contacto_taller=<?php echo $contacto->getIdTallerContacto();?>&id_taller=<?php echo $idTaller; ?>">
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