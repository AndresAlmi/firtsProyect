<?php

require_once "../../class/personaContacto.php";
require_once "../../class/tipoContacto.php";


$idPersona = $_GET["id_persona"];

$listadocontacto = personaContacto::obtenerPorIdPersona($idPersona);

$listadoTipoContacto = tipoContacto::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
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
		<section class="contenedorFormularios">
			<form action="procesar_alta.php" method="POST" class="formulario" id="formularioContactoTaller">
				
				<input type="hidden" name="txtIdPersona" value="<?php echo $idPersona; ?>">


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
							<input onkeyup = "validarApellido()" class = "formulario_input" type="text" style="width: 100%" name="txtValor" id="txtValor">
						</div>
					</div>

						
					&nbsp;&nbsp;&nbsp;

					<input type="submit" value="Agregar">
					<br><br>
				
				</fieldset>
				
			</form>
		</section>

	</section>
	<div class="contenedorTabla">	
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
							<a class = "btnImg" href="eliminar.php?id_contacto_persona=<?php echo $contacto->getIdPersonaContacto();?>&id_persona=<?php echo $idPersona; ?>">
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