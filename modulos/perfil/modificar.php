<?php

require_once "../../class/perfil.php";
require_once "../../class/perfilModulo.php";
require_once "../../class/modulo.php";


$id_perfil = $_GET["id_perfil"];
$perfil = Perfil::obtenerPorId($id_perfil);
$listadoModulo = Modulo::obtenerTodos();

$mensaje = "";
if (isset($_GET["error"])){

	switch($_GET["error"]){
		case "descripcion0":
			$mensaje = "Ingrese una descripcion.";
			break;
		case "descripcion<3":
			$mensaje = "Requiere más de 3 caracteres.";
			break;
		case "modulo0":
			$mensaje = "Ingrese al menos un modulo.";
			break;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Perfil</title>
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/nav.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">	
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<script type="text/javascript" src="../../js/jquery.3.6.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script>
		$(document).ready(function() {
			$(".cboModulo").select2({
				tags: true
			});
			$('.cboModulo').select2({
				createTag: function (params) {
				// Don't offset to create a tag if there is no @ symbol
				if (params.term.indexOf('@') === -1) {
				// Return null to disable tag creation
				return null;
				}

				return {
				id: params.term,
				text: params.term
					}
				}
				});
			});
	</script>
</head>
<body>
	<header>
		<?php require_once "../../header.php"?>
	</header>
	<nav>
		<?php require_once "../../menu.php"; ?>
	</nav>
	<section class="contenedorFormularios">
		<?php echo $mensaje; ?>
		<form action="procesar_modificacion.php" method="POST" class="formulario" id="formularioPerfil">
			
			<input type="hidden" name="txtidperfil" value="<?php echo $id_perfil; ?>">

			<div class="formulario_grupo" id="grupo_descripcion">
				<label for = "descripcion" class = "formulario_label"> Descripcion: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="txtdescripcion" class = "formulario_input" value="<?php echo $perfil->getdescripcion(); ?> ">
				</div>
			</div>

			<div class="formulario_grupo" id="grupo_modulo">
				<label for = "modulo" class = "formulario_label"> Modulo: </label>
				<div class="formulario_grupo-input">
					<select multiple name = "cboModulo[]" id="cboModulo" class="cboModulo" style="width: 100%;">
						<option value = "">--Seleccionar--</option>
						<?php foreach ($listadoModulo as $modulo): ?>
							
							<?php

							$selected = '';

							foreach ($perfil->getModulos() as $perfilModulo) {
								if ($modulo->getIdModulo() == $perfilModulo->getIdModulo()) {
									$selected = "SELECTED";
								}
							}

							?>
								<option <?php echo $selected; ?> value="<?php echo $modulo->GetIdModulo(); ?>">
									<?php echo $modulo->getDescripcion(); ?>
								</option>

						<?php endforeach ?>
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
		<?php require_once "../../footer.php";?>
	</footer>
</body>
</html>