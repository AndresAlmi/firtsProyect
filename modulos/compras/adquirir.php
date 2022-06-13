<?php
require_once "../../class/proveedor.php";
require_once "../../class/repuestos.php";
require_once "../../class/tipoRepuesto.php";

$listadoProveedor = proveedor::obtenerTodos();
$listadoRepuestos = repuestos::obtenerTodos();
$listadoTipoRepuesto = tipoRepuesto::ObtenerTodos();
$mensaje = "";
if(isset($_GET["error"])){
    switch($_GET["error"]){
        case "proveedor":
            $mensaje = "Introduzca un Proovedor";
            break;
        case "cantidad":
            $mensaje = "Introduzca una Cantidad Valida";
            break;
        case "repuesto":
            $mensaje = "Introduzca un Repuesto";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <script type="text/javascript" src="../../js/jquery.3.6.js"></script>
    <link rel="stylesheet" href="../../styles/select2.min.css">
    <script src="../../js/select2.full.js "></script>
    <script type="text/javascript" src="../../js/select2funcion.js"></script>
    <script type="text/javascript" src="../../js/compras.js"></script>


    <style>
        .contenedorDetalle{
            background-color: #bcdbe960;
            width: 90%;
            min-height: 700px;
            margin: auto;
            padding: 10px;
            border: 4px solid black;
        }
        table th{
            text-shadow: 2px 2px solid black;
            color: white;
        }
        .cabeceraDetalle{
            height: 200px;
            width: 100%;
        }

        .cabeceraDetalleEmpresa{
            width: 500px;
            height: 200px;
            float: left;
            position: absolute;
        }
        .cabeceraDetalleEmpresa .cabeceraDetalleEmpresaImg{
            float: left;
            padding-top: 25px;
        }
        .cabeceraDetalleEmpresa .cabeceraDetalleEmpresaTaller{
            float: right;
            padding-top: 35px;
            padding-right: 150px;
        }
    
        .cabeceraDetalleFactura{
            width: 700px;
            height: 200px;
            float: right;
        }
        .cabeceraDetalleFactura .clienteDetalle table,.facturaDetalle table{
            margin-top: 10px;
            width: 100%;
            height: 50%;
        }
        .cabeceraDetalleFactura .clienteDetalle table thead th,.facturaDetalle table thead th{
            width: 50%;
            background: linear-gradient(#7d9fad, #4a5858);
        }
        .cabeceraDetalleFactura .facturaDetalle table thead th{
            width: 33%;
        }
        .factura{
            margin-top: 10px;
            padding-top: 20px;
            border-top: 20px solid #4a5858;
            width: 100%;
        }
        table{
            
            text-transform: uppercase;
            margin: auto;
            width: 90%;
            background-color: white;
        }


        .factura table tfoot{
            text-align: right;

        }

        .factura table thead,tbody,tfoot{
            border-collapse: collapse;
        }
        .factura table thead th,tbody th{
            background: linear-gradient(#7d9fad, #4a5858);
        }
        thead th, tbody td, tfoot td{
            border: solid 1px black;
            padding: 10px;
        }
        .styleNone{
            outline: none; 
            border: none;
        }
        .red{
            color: red;
        }
    </style>
</head>
<body>
<div class="contenedorDetalle">
    <form action="procesarAdquirir.php" method="POST">
        <div class="cabeceraDetalle">
            <div class="cabeceraDetalleEmpresa">
                <div class="cabeceraDetalleEmpresaImg">
                    <img src="../../img/Logo2.0.png" width="150px" height="150px">
                </div>
                <div class="cabeceraDetalleEmpresaTaller">
                    <H1>ServiceSystem</H1>
                </div>
            </div>
            <div class="cabeceraDetalleFactura">
                <div class="clienteDetalle">
                    <table>
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <?php if($mensaje != ""){echo "<h1 class='red'>$mensaje</h1>";}?>
                                <th>Fecha</th>
                                <th>Tipo Repuesto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>
                                    <select name="cboProveedor" id="cboProveedor" style="width: 75%">
                                        <option value="0"></option>
                                        <?php
                                        foreach($listadoProveedor as $proveedor):?>
                                            <option value="<?php echo $proveedor->getIdProveedor();?>">
                                                <?php echo $proveedor->getNombre();?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td><?php 
                                    $fechaActual = date("d") . "/". date("m") . "/". date("y");
                                    echo $fechaActual;
                                    $fecha = date("Y").date("m").date("d");
                                    ?>
                                    <input type="hidden" name ="fecha" id="fecha" value="<?php echo $fecha;?>">
                                </td>
                                <td>
                                    <select onchange="mostrarLista();" name="cboModelo" id="cboModelo" style="width: 75%">
                                        <option value="0"></option>
                                        <option value="varios">varios</option>
                                        <?php foreach($listadoTipoRepuesto as $listadoTipoRepuesto):?>
                                            <option value="<?php echo $listadoTipoRepuesto->getIdTipoRepuesto()?>">
                                                <?php echo $listadoTipoRepuesto->getDescripcionM();?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="factura">
            <table id = "factura">
                <thead>
                    <tr>
                        <th>Agregar Repuestos</th>
                        <td colspan="3">
                            <select name="cboRepuestos" id="cboRepuestos" class="cboRepuestos" style="width: 50%">
                                <option value=""></option>
                            </select>
                            <button type="button" onclick="cargarProducto();">Añadir</button>

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
                        
                    </tr>  
                    
                </tbody>
                <tfoot>
                    <td colspan="5"><button type="submit">Guardar</button></td>
                </tfoot>
            </table>
        </div>
        
    </form>
   
</div>

</body>
</html>