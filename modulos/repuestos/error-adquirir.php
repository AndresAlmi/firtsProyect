<?php
require_once "../../class/proveedor.php";
require_once "../../class/repuestos.php";
require_once "../../class/tipoRepuesto.php";


$listadoProveedor = proveedor::obtenerTodos();
$listadoRepuestos = repuestos::obtenerTodos();
$tipoRepuesto = tipoRepuesto::ObtenerTodos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <script type="text/javascript" src="../../js/jquery.3.6.js"></script>
    <script>
        function mostrarLista() {
			var cboModelo = $("#cboModelo");
			var tipo = cboModelo.val();
            
            if(tipo != "varios"){
                $.ajax({
                    method: "GET",
                    url: "mostrarLista.php",
                    data: {id: tipo}
                })
                .done(function(respuesta) {
                    $("#cboRepuestos").html(respuesta);
                })
                .fail(function() {
                    alert("ERROR");
                });
            }
        }
        var name = 0;
        function cargarProducto() {

			var codigo = $("#cboRepuestos");
            name = parseInt(name) + 1;
			$.ajax({
				method: "GET",
				url: "obtenerDescripcion.php",
				data: {codigo: codigo.val()}
			})
            .done(function(respuesta) {
                // variables para generacion de tabla
                var td_id = "<td><input type='number' name = 'idProducto[]' value = '" + codigo.val() + "'readonly></td>";
                var td_descripcion = "<td><input type='text' value = '"+ respuesta +"' readonly></td>";
                var td_cantidad = "<td><input type='number' name = 'cantidad[]' value = '1'></td>";

                $("#tablaProductos tr:last").after(
                    "<tr>" + td_id + td_descripcion + td_cantidad + "</tr>"
                );
            })
            .fail(function() {
                    alert("ERROR");
            });
		}
    </script>

</head>
<body>
<div>
    <form action="procesarAdquirir.php" method="POST">
        <table id = "tablaProductos">
            <caption>Adquirir Productos</caption>
            <thead>
                <tr>
                    <th>
                        Proovedor
                    </th>
                    <td>
                        <select name="cboProveedor" id="cboProveedor">
                            <option value="0">seleccionar</option>
                            <?php
                            foreach($listadoProveedor as $proveedor):?>
                                <option value="<?php echo $proveedor->getIdProveedor();?>">
                                    <?php echo $proveedor->getNombre();?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <th>Tipo Repuesto</th>
                    <td>
                        <select onchange="mostrarLista();"name="cboModelo" id="cboModelo">
                            <option value="0">--Seleccionar--</option>
                            <option value="varios">varios</option>
                            <?php foreach($tipoRepuesto as $tipoRepuesto):?>
                                <option value="<?php echo $tipoRepuesto->getIdTipoRepuesto()?>">
                                    <?php echo $tipoRepuesto->getDescripcionM();?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Fecha de Adquisicion</th>
                    <td><?php 
                        $fechaActual = date("d") . "/". date("m") . "/". date("y");
                        echo $fechaActual;
                        $fecha = date("Y").date("m").date("d");
                        ?>
                        <input type="hidden" name ="fecha" id="fecha" value="<?php echo $fecha;?>">
                    </td>
                </tr>
                <tr>
                    <th>Agregar Repuestos</th>
                    <td>
                        <select onchange="cargarProducto();" name="cboRepuestos" id="cboRepuestos">
                            <option value="">--Seleccionar--</option>
                            <?php foreach($listadoRepuestos as $listadoRepuestos):?>
                                <option value="<?php echo $listadoRepuestos->getIdRepuesto();?>">
                                    <?php echo $listadoRepuestos->getDescripcion()?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>ID-Repuesto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                </tr>  
                
            </tbody>
        </table>
        <button type="submit">Guardar</button>
    </form>
   
</div>

</body>
</html>