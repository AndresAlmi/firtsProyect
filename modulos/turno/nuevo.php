<?php

require_once "../../class/taller.php";
require_once "../../class/vehiculo.php";
require_once "../../class/servicio.php";
require_once "../../class/cliente.php";

$listadoTaller = taller::obtenerTodos();
$listadoServicio = servicio::obtenerTodos();
$listadoCliente = cliente::obtenerTodos();
$fecha = date("Y")."-".date("m")."-".date("d");
$mostrar = "disable";
if (isset($_GET["id_cliente"])){
    $idCliente = $_GET["id_cliente"];
    $lista = vehiculo::obtenerPorIdCliente($idCliente);
	$listadoCliente = cliente::obtenerPorId($idCliente);
    $mostrar = "enable";
}else{
	$listadoCliente = cliente::obtenerTodos();

}

const CLIENTE = " // ID Cliente: ";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Turno</title>
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/form.css">
	<link rel="stylesheet" href="../../styles/jbox.min.css">
	<link rel="stylesheet" href="../../styles/select2.min.css">
	<link rel="StyleSheet" href = "../../styles/footer.css">

	<script src="../../js/jquery.3.6.js"></script>
	<script src="../../js/formularios.js"></script>
	<script src="../../js/select2.full.js "></script>
	<script src="../../js/jbox.min.js"></script>
	<script type="text/javascript" src="../../js/modalTurno.js"></script>
	<script type="text/javascript" src="../../js/select2funcion.js"></script>


	<style>
		.formulario{
			height: 77vh;
		}
		.modal{
			text-align: center;
			display: none;
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
	<section class="contenedorFormularios">
		<h2>NUEVO TURNO</h2>
        <form method="POST" action="procesar_nuevo.php" class="formulario" id="formularioTurno">

			<div class="formulario_grupo" id="grupo_taller">
				<label for = "taller" class = "formulario_label"> Taller: </label>
				<div class="formulario_grupo-input">
					<select name="cboTaller" id="cboTaller" class= "cboTaller" style="width:100%">
						<option value="">--Seleccione--</option>
						<?php foreach ($listadoTaller as $taller): ?>

							<option value="<?php echo $taller->GetIdTaller(); ?>">
								<?php echo $taller->getNombre(); ?>
							</option>

						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_servicio">
				<label for = "servicio" class = "formulario_label"> Servicio: </label>
				<div class="formulario_grupo-input">
					<select multiple name="cboServicio[]" id="cboServicio" class="cboServicio" style="width:100%">
						<option value="">--Seleccione--</option>
						<?php foreach ($listadoServicio as $servicio): ?>

							<option value="<?php echo $servicio->GetIdServicio(); ?>">
								<?php echo $servicio->getDescripcion(); ?>
							</option>

						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<?php if($mostrar == "disable"){?>
			<div class="formulario_grupo" id="grupo_cliente">
				<label for = "cliente" class = "formulario_label"> Cliente: </label>
				<div class="formulario_grupo-input">
					<select onchange = "cargarVehiculo();" name="cboCliente" id="cboCliente" class="cboCliente" style="width:100%">
						<option value="">--Seleccione--</option>
						<?php foreach ($listadoCliente as $cliente): ?>

                            <option value="<?php echo $cliente->GetIdCliente(); ?>">
                                <?php 
                                    echo $cliente->getNombre();
                                    echo CLIENTE;
                                    echo $cliente->GetIdCliente(); 
                                ?>
                            </option>


                        <?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="formulario_grupo" id="grupo_vehiculo">
				<label for = "vehiculo" class = "formulario_label"> Vehiculo: </label>
				<div class="formulario_grupo-input">
					<select onchange = "modalFunciones();" name="cboVehiculo" id="cboVehiculo" class="cboVehiculo" style="width:100%">
                        <option value="">--Seleccione--</option>
                    </select>
				</div>
				<div class="modal">
					<button type="button" id="myModal" >Ver Servicios Más Solicitados del Vehiculo</button>
				</div>

				
			</div>
			<?php } else { ?>
			<div class="formulario_grupo" id="grupo_cliente">
				<label for = "Cliente" class = "formulario_label"> Cliente: </label>
				<div class="formulario_grupo-input">
					<input type="text" name="" class="formulario_input" placeholder= "<?php echo $listadoCliente->getNombre() . ", " . $listadoCliente->getApellido()?>" style="width: 100%" readonly>
					<input type="hidden" name ="cboCliente" value="<?php echo $idCliente;?>">
					<input type="hidden" name ="mostrar" value="<?php echo $mostrar;?>">

					<img class ="formulario_validacion-estado" src="../../img/error.png" height="15px" width="15px">
				</div>
				<p class="formulario_input-error">Solo puede contener letras, debe ser mayor a 3 y menor a 15</p>
			</div>	
			<div class="formulario_grupo" id="grupo_vehiculo">
				<label for = "vehiculo" class = "formulario_label"> Vehiculo: </label>
				<div class="formulario_grupo-input">
					<select onchange = "modalFunciones();" name="cboVehiculo" id="cboVehiculo" class="cboVehiculo" style="width:100%">
                        <option value="">--Seleccione--</option>
						<?php foreach($lista as $lista):?>
							<option value="<?php echo $lista->getIdVehiculo();?>">
								<?php echo $lista->getDescripcionModelo();?>
							</option>
						<?php endforeach;?>
                    </select>
				</div>
				<div class="modal">
					<button type="button" id="myModal" >Ver Servicios Más Solicitados del Vehiculo</button>
				</div>

				
			</div>
			<?php }?>
            <div class="formulario_grupo" id="grupo_fecha">
				<label for = "fecha" class = "formulario_label"> Fecha: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="date" name="txtFecha" id="txtFecha">
					
				</div>
			</div>
            <div class="formulario_grupo" id="grupo_hora">
				<label for = "hora" class = "formulario_label"> Hora: </label>
				<div class="formulario_grupo-input">
					<input class = "formulario_input" type="time" name="txtHora" id="txtHora">
					
				</div>
			</div>
			<input type="hidden" id="fechaActual" value="<?php echo $fecha?>">
			<div class="formulario_alerta">
				<p>Por favor rellena el formulario.</p>
			</div>
			<div class = "formulario_grupo-btn-enviar">
				<button type="submit" class="formulario_btn">Guardar</button>
			</div>
        </form>
		<script>
			var myJBox = new jBox();

			
			function modal(){
				var cboVehiculo = $("#cboVehiculo").val();
				myJBox =  new jBox ('Modal', 
				{attach: '#myModal',
				ajax: {
					method: "GET",
					url: 'serviciosVehiculo.php',
					data: {id: cboVehiculo},
					setContent: false,
					success: function (respuesta) {
						this.setContent(respuesta);
					},
					error: function () {
					this.setContent('<b style="color: #d33">Error.</b>');
					}
				},
				animation: 'pulse',
				title: 'Servicios',
				width: 350,});
			}
			
		</script>
    </section>
    <footer>
		<?php require_once "../../footer.php";?>
	</footer>
</body>


</html>