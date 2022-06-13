<?php
require_once "../../class/taller.php";
require_once "../../class/modelo.php";

$listadoTaller = taller::obtenerTodos();
$listadoVehiculo = modelo::obtenerTodos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <link rel= "shortcut icon" href="../../img/icon.png">
	<link rel="StyleSheet" href = "../../styles/header.css">
	<link rel="StyleSheet" href = "../../styles/inicio.css">
    <link rel="StyleSheet" href = "../../styles/table.css">
    <link rel="StyleSheet" href = "../../styles/footer.css">
    <link rel="stylesheet" href="../../styles/select2.min.css">
    <script src="../../js/jquery.3.6.js"></script>
    <script src="../../js/select2.full.min.js"></script>
    <script>
        function consulta1(){
            var fechaInicio = $("#fecha1Consulta1").val();
            var fechaFin = $("#fecha2Consulta2").val();

			$.ajax({
				url:'consulta1.php',
				type:'GET',
				dataType:'html',
				data :{fechaInicio:fechaInicio, fechaFin:fechaFin},
			})
			.done(function(resultado){
				$("#tabla_busqueda").html(resultado);
			})
		}

        function consulta2(){
            var taller = $("#cboTaller").val();
            var orden = $("#cboOrden").val();

			$.ajax({
				url:'consulta2.php',
				type:'GET',
				dataType:'html',
				data :{idTaller:taller, orden:orden},
			})
			.done(function(resultado){
				$("#tabla_busqueda2").html(resultado);
			})
		}
        function consulta3(){
            var taller = $("#cboTaller1").val();

			$.ajax({
				url:'consulta3.php',
				type:'GET',
				dataType:'html',
				data :{idTaller:taller},
			})
			.done(function(resultado){
				$("#tabla_busqueda3").html(resultado);
			})
		}
        function consulta4(){
            var modelo = $("#cboModelo").val();

			$.ajax({
				url:'consulta4.php',
				type:'GET',
				dataType:'html',
				data :{idModelo:modelo},
			})
			.done(function(resultado){
				$("#tabla_busqueda4").html(resultado);
			})
		}
        $(document).ready(function() {
            $("#cboModelo").select2({
                placeholder: 'Seleccionar',
                width: 'resolve',
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
    <div class="contenedorTablaConsulta">
		<h2>TURNOS</h2>	
        <form>
            <legend>TURNOS POR FECHA, DESDE FECHA INICIO A FIN</legend>
            <div class="left">
                <label for="fecha">Fecha Inicio</label>
                <div >
                    <input type="date" id="fecha1Consulta1">

                </div>
            </div>
            <div class="right">
                <label for="fecha2">Fecha Fin</label>

                <div>
                    <input type="date" id="fecha2Consulta2">

                </div>
            </div>
           
            <button type="button" onclick="consulta1();">BUSCAR</button>
        </form>
		<section id="tabla_busqueda">
       
			<table id="tablaRepuesto">
				<thead>
					<tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
					</tr>
				</thead>

				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
					</tr>
				</tbody>
			</table>
		</section>
	</div>
    <div class="contenedorTablaConsulta">
        <h2>SERVICIOS</h2>

        <form action="">
            <legend>SERVICIOS SOLICITADOS POR TALLER</legend>
            <div class="left">
                <label for="taller">Taller</label>
                <div >
                    
                    <select name="cboTaller" id="cboTaller">
                        <option value="">--Seleccione--</option>
                        <?php foreach($listadoTaller as $taller):?>
                            <option value="<?php echo $taller->getIdTaller()?>">
                                <?php echo $taller->getNombre();?>
                            </option>
                        <?php endforeach;?>
                    </select>

                </div>
            </div>
            <div class="right">
                <label for="fecha2">Orden</label>

                <div>
                    <select name="cboOrden" id="cboOrden">
                        <option value="DESC">MAS SOLICITADOS</option>
                        <option value="ASC">MENOS SOLICITADOS</option>

                    </select>
                </div>
            </div>
           
            <button type="button" onclick="consulta2();">BUSCAR</button>
        </form>
		<section id="tabla_busqueda2">
       
			<table id="tablaRepuesto">
				<thead>
					<tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
					</tr>
				</thead>

				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
					</tr>
				</tbody>
			</table>
		</section>
	</div>
    <div class="contenedorTablaConsulta">
        <h2>CLIENTES</h2>

        <form action="">
            <legend>CLIENTES FRECUENTES POR TALLER</legend>
            <div class="center">
                <label for="taller">Taller</label>
                <div >
                    
                    <select name="cboTaller1" id="cboTaller1">
                        <option value="">--Seleccione--</option>
                        <?php foreach($listadoTaller as $taller):?>
                            <option value="<?php echo $taller->getIdTaller()?>">
                                <?php echo $taller->getNombre();?>
                            </option>
                        <?php endforeach;?>
                    </select>

                </div>
            </div>
           
            <button type="button" onclick="consulta3();">BUSCAR</button>
        </form>
		<section id="tabla_busqueda3">
       
			<table id="tablaRepuesto">
				<thead>
					<tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
					</tr>
				</thead>

				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
					</tr>
				</tbody>
			</table>
		</section>
	</div>
    <div class="contenedorTablaConsulta">
        <h2>SERVICIOS POR VEHICULOS</h2>

        <form action="">
            <legend>Servicios Más Solicitados Por Vehiculo</legend>
            <div class="center">
                <label for="Modelo">Modelo</label>
                <div>
                    <select name="cboModelo" id="cboModelo">
                        <option value="">--Seleccione--</option>
                        <?php foreach($listadoVehiculo as $vehiculo):?>
                            <option value="<?php echo $vehiculo->getIdModelo()?>">
                                <?php echo $vehiculo->getDescripcionModelo();?>
                            </option>
                        <?php endforeach;?>
                    </select>

                </div>
            </div>
           
            <button type="button" onclick="consulta4();">BUSCAR</button>
        </form>
		<section id="tabla_busqueda4">
       
			<table id="tablaRepuesto">
				<thead>
					<tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
					</tr>
				</thead>

				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
					</tr>
				</tbody>
			</table>
		</section>
	</div>
    <footer>
        <?php require_once "../../footer.php";?>
    </footer>
</body>
</html>