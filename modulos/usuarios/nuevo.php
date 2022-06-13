<?php
	require_once "../../class/Sexo.php";
	require_once "../../class/perfil.php";
	require_once "../../class/Usuario.php";
	require_once "../../class/cliente.php";
	require_once "../../class/empleado.php";
	session_start();

	if (isset($_SESSION['usuario'])) {
		$usuario = $_SESSION['usuario'];
	} else {
		header("location: /xampp/proyectoppi/gestion_usuarios/index.php?error=" . MENSAJE_CODE);
		exit;
	}

	$perfiles = $usuario->perfil->getIdPerfil();
	$listadoModulos = $usuario->perfil->getModulos();
	$id = $usuario->getIdPersona();

	if($perfiles != 1){
		if($perfiles == 2){
			$cliente = cliente::obtenerPorIdPersona($id);
			$GET = "?id_cliente=$cliente";
		}else{
			$empleado = empleado::obtenerPorIdPersona($id);
			$taller = Empleado::obtenerPorIdTallerPorEmpleado($empleado);
			$GET = "?id_taller=$taller";
		}
	}else{
		$GET="";
	}

	$listadoSexo = Sexo::obtenerTodos();
	$listadoPerfil = perfil::obtenerTodos();
	$fecha = date("Y")."-".date("m")."-".date("d");

	$mensaje = "";
	if (isset($_GET["error"])){

		switch($_GET["error"]){
			case "nombre<>0":
				$mensaje = "Datos obligatorios.";
				break;
			case "nombre<3":
				$mensaje = "Requiere más de 3 caracteres.";
				break;
			case "dni":
				$mensaje = "Ingrese un numero valido.";
				break;
			case "sexo":
				$mensaje = "Seleccione una opción.";
				break;
			case "fechaAlta":
				$mensaje = "Fecha no valida.";
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang = "es">
<head>
	<title>Nuevo Usuario</title>
	<meta charset="UTF-8">
    <meta name = "author" content="Andres Almiron">
	<link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="stylesheet" href="../../styles/header.css">
	<link rel="stylesheet" href="../../styles/menu.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="stylesheet" href="../../styles/table.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="stylesheet" href="../../styles/formularioPorPasosUsuario.css">
	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/formularios.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script src="../../js/select2funcion.js"></script>
	<script src="../../js/formularioPorPasosUsuario.js"></script>

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
		<nav class="horizontal">
			<ul>
				<?php foreach ($listadoModulos as $modulo): ?>
					<?php if($modulo->getNivel() == 0){?>
						<?php if($modulo->getDirectorio() == "#"){?>
							<li class="dropdown">
								<a href="#"><?php echo $modulo->getDescripcion()?></a>
								<div class="dropdown-content">
									<ul>
										<?php foreach($listadoModulos as $padre):?>
											<?php if($modulo->getDescripcion() == $padre->getHijoDe()){?>
												<?php if($padre->getDirectorio() == "#"){?>
													<li class="dropdown1">
														<a href="#"><?php echo $padre->getDescripcion()?></a>
														<div class="dropdown-content1">
															<ul>
																<?php foreach($listadoModulos as $abuelo):?>
																	<?php if($padre->getDescripcion() == $abuelo->getHijoDe()){?>
																		<?php if($abuelo->getDirectorio() == "#"){?>
																			<li>
																				<a href="#"><?php echo $abuelo->getDescripcion()?></a>
																			</li>
																		<?php } else {?> 
																		<li>
																			<a href="/xampp/proyectoPPI/modulos/<?php echo $abuelo->getDirectorio(); ?>/listado.php">
																				<?php echo $abuelo->getDescripcion(); ?>
																			</a>
																		</li>
																		<?php }?>
																	<?php }?>
																<?php endforeach;?>
															</ul>
														</div>
													</li>
												<?php } else {?> 
													<li>
														<a href="/xampp/proyectoPPI/modulos/<?php echo $padre->getDirectorio(); ?>/listado.php">
															<?php echo $padre->getDescripcion(); ?>
														</a>
													</li>
												<?php }?>
											<?php }?>
										<?php endforeach;?>
									</ul>
								</div>
							</li>
						<?php }else{?>
							<li class = "nav-menu-item">
								<a class = "nav-menu-link" href="/xampp/proyectoPPI/modulos/<?php echo $modulo->getDirectorio(); ?>/listado.php<?php echo $GET?>">
									<?php echo $modulo->getDescripcion(); ?>
								</a>
							</li>
						<?php } ?>
					<?php }?>
				<?php endforeach ?>
			</ul>
		</nav>
		<section class="contenedorFormularios">
			<form action="procesar_nuevo.php" method="POST" class="formulario" id="formularioUsuario">
				<div class="cabecera">
					<h2 id="paso1">Paso 1</h2>
					<h2 id="paso2">Paso 2</h2>
					<h2 id="paso3">Paso 3</h2>
				</div>
				<div id="page1">
					<div class="formulario_grupo" id="grupo_usuario">
						<label for = "usuario" class = "formulario_label"> Nombre de Usuario: </label>
						<div class="formulario_grupo-input">
							<input onkeyup = "validarUsuario()" class = "formulario_input" type="text" name="txtUsername" id="txtUsername" placeholder="Usuario">
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error">Solo puede contener letras, guiones o numeros, debe ser mayor a 4 y menor a 16</p>
					</div>

					<div class="formulario_grupo" id="grupo_password">
						<label for = "password" class="formulario_label"> Contraseña:</label>
						<div class="formulario_grupo-input">
							<input onkeyup = "validarPassword()" class = "formulario_input" type="password" name="txtPassword" id="txtPassword" placeholder="Contraseña">
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error">Solo puede contener letras, guiones o numeros, debe ser mayor a 6 y menor a 12</p>
					</div>
								
					<div class="formulario_grupo" id="grupo_nombre">
						<label for = "nombre" class = "formulario_label"> Nombre: </label>
						<div class="formulario_grupo-input">
							<input onkeyup = "validarNombre()" class = "formulario_input" type="text" name="txtNombre" id="txtNombre" placeholder= "Ej. Jorge">
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error"> Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
					</div>
					
					<div class="formulario_grupo" id="grupo_apellido">
						<label for = "apellido" class = "formulario_label"> Apellido: </label>
						<div class="formulario_grupo-input">
							<input onkeyup = "validarApellido()" class = "formulario_input" type="text" name="txtApellido" id="txtApellido" placeholder= "Ej. Ramirez">
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error"> Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
					</div>

					<div class="btn-next-prev">
						<button class="formulario_btn" type="button" onclick="mostrarSiguiente1()">Siguiente</button>
					</div>
				</div>
				<div id="page2">
					<div class="formulario_grupo" id="grupo_dni">
						<label for = "dni" class = "formulario_label"> Dni: </label>
						<div class="formulario_grupo-input">
							<input onkeyup = "validarDni()" class = "formulario_input" type="number" name="txtDni" id="txtDni" placeholder= "Ej. 32541326">
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error">Numero no valido.</p>
					</div>

					<div class="formulario_grupo" id="grupo_sexo">
						<label for = "sexo" class = "formulario_label"> Sexo: </label>
						<div class="formulario_grupo-input">
							<select onchange="validarSexo();" name="cboSexo" id = "cboSexo" class="cboSexo" style="width:100%">
								<option value="">-------Seleccionar------</option>
									<?php foreach ($listadoSexo as $sexo): ?>
										<option value="<?php echo $sexo->getIdSexo(); ?>">
											<?php echo $sexo->getDescripcion(); ?>
										</option>
									<?php endforeach ?>
							</select>
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error">Debe Seleccionar Una Opcion.</p>
					</div>

					<div class="formulario_grupo" id="grupo_perfil">
						<label for = "perfil" class = "formulario_label"> Perfil: </label>
						<div class="formulario_grupo-input">
							<select onchange="validarPerfil();" name="cboPerfil" id="cboPerfil" class="cboPerfil" style="width:100%">

								<option value="">-------Seleccionar------</option>

								<?php foreach ($listadoPerfil as $perfil): ?>

									<option value="<?php echo $perfil->getIdPerfil(); ?>">
										<?php echo $perfil->getDescripcion(); ?>
									</option>

								<?php endforeach ?>

							</select>
							<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
						</div>
						<p class="formulario_input-error">Debe Seleccionar Una Opcion.</p>

					</div>

					<div class="formulario_grupo" id="grupo_fechaNacimiento">
						<label for = "fechaNacimiento" class = "formulario_label"> Fecha de Nacimiento: </label>
						<div class="formulario_grupo-input">
							<input class = "formulario_input" type="date" name="txtFechaNacimiento" id="txtFechaNacimiento">
							
						</div>
					</div>

					<div class="formulario_grupo" id="grupo_fechaAlta">
						<label for = "fechaAlta" class = "formulario_label"> Fecha de Alta: </label>
						<div class="formulario_grupo-input">
							<input class = "formulario_input" type="date" name="txtFechaAlta" id="txtFechaAlta" value="<?php echo $fecha?>" readonly>
						</div>
					</div>
					
					<div class="btn-next-prev-2">
						<button class="formulario_btn" type="button" onclick="mostrarAnterior1()">Anterior</button>
					</div>
					<div class="btn-next-prev-2">
						<button class="formulario_btn" type="button" onclick="mostrarValidar()">Siguientes</button>
					</div>
					
				</div>
				<div id="tablaVerificar">
					<table>
						<caption>Compruebe Sus Datos</caption>
						<tr>
							<th>Usuario</th>
							<td><span id="tablaVerificar-usuario"></span></td>
							<th>Contraseña</th>
							<td><span id="tablaVerificar-password"></span></td>
						</tr>
						<tr>
							<th>Nombre</th>
							<td><span id="tablaVerificar-nombre"></span></td>
							<th>Apellido</th>
							<td><span id="tablaVerificar-apellido"></span></td>
						</tr>
						<tr>
							<th>DNI</th>
							<td><span id="tablaVerificar-dni"></span></td>
							<th>Sexo</th>
							<td><span id="tablaVerificar-sexo"></span></td>
						</tr>
						<tr>
							<th>Perfil</th>
							<td><span id="tablaVerificar-perfil"></span></td>
							<th>Fecha Nacimiento</th>
							<td><span id="tablaVerificar-fechaNacimiento"></span></td>
						</tr>
					</table>
					<div class="formulario_alerta">
						<p>Por favor rellena el formulario.</p>
					</div>

					<div class="btn-next-prev-2">
						<button class="formulario_btn" type="button" onclick="mostrarAnterior2()">Anterior</button>
					</div>
					<div class="btn-next-prev-2">
						<button class="formulario_btn"  type="submit">Guardar</button>
					</div>
					
				</div>		
			</form>
		</section>
		<footer>
			<div class="contenedor">
				<ul>
					<li>
						<div>
							<h1> Año 2021</h1>
						</div>
					</li>
					<li>
						<div>
							<h1>Contacto</h1>  
							<p>andres1almiron@gmail.com</p>
						</div>
					</li>  
					<li>
						<div>
							<h1>Informacion</h1>
							<p>Este sitio forma parte de las practicas profesionalizantes</p> 
						</div>
					</li>  
					<li>
						<div>
							<h1>ServiceSystem</h1>     
							<p> Servicio de AutoGestion De Turnos, Control De Stock 
							y Facturacion. </p>
						</div>
					</li> 
				</ul>
			</div>
		</footer>
	</body>
</html>