<?php
require_once "../../class/turno.php";
require_once "../../class/turnoServicio.php";
require_once "../../class/cliente.php";
require_once "../../class/tipoPago.php";
require_once "../../class/tipoFactura.php";


$idTurno = $_GET['id_turno'];
$turno = turno::obtenerPorIdTurno($idTurno);

$turnoServicio = turnoServicio::obtenerPorIdTurno($idTurno);

$idCliente = $turno->getIdCliente();
$cliente = cliente::obtenerPorId($idCliente);

$tipoPago = tipoPago::obtenerTodos();

$tipoFactura = tipoFactura::obtenerTodos();

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <script type="text/javascript" src="../../js/jquery.3.6.js"></script>
    <script type="text/javascript" src="../../js/factura.js"></script>
    <style>
            .contenedorDetalle{
            background-color: #bcdbe960;
            width: 90%;
            height: 700px;
            margin: auto;
            padding: 10px;
            border: 4px solid black
        }
        table th{
            color:white;
            text-shadow: 2px 2px solid black;
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

        .factura table tbody td.right{
            text-align: right;
        }
        .factura table tbody td.center{
            text-align: center;
        }

        .factura table tfoot{
            text-align: right;

        }

        .factura table thead,tbody,tfoot{
            border-collapse: collapse;
        }
        .factura table thead th,tbody th,tfoot th{
            background: linear-gradient(#7d9fad, #4a5858);
        }
        thead th, tbody td, tfoot td{
            border: solid 1px black;
            padding: 10px;
        }
    </style>

</head>
<body>
<div class="contenedorDetalle">
    <section class = "detalle">
    <form action="guardarFactura.php" method="POST">
        <input type="hidden" name = "txtIdTurno" value =<?php echo $idTurno;?> >
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
                                <th>Cliente</th>
                                <th>Fecha De Turno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $cliente->getNombre()." ".$cliente->getApellido();?></td>
                                <td><?php echo $turno->getFechaTurno();?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="facturaDetalle">
                    <table>
                        <thead>
                            <tr>
                                <th>Tipo de Factura</th>
                                <th>Fecha De Factura</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><select onchange="calcularIva();" name="cboTipoFactura" id="cboTipoFactura">
                                        <option value="0">seleccionar</option>
                                        <?php foreach($tipoFactura as $tipoFactura):?>
                                            <option value="<?php echo $tipoFactura->getIdTipoFactura();?>">
                                                <?php echo $tipoFactura->getDescripcion();?>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="factura">
            <table>
                <thead>
                    <tr>
                        <th>ID-Servicio</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($turnoServicio as $turnoServicio):
                    ?>
                    <tr class = "facturaCuerpo">
                    <!------------------------------Lista de Servicios---------------------------------------------------------->
                        <td><?php echo $turnoServicio->getIdServicio();?></td>
                        <td>
                            <?php
                                $nombreServicio = Servicio::obtenerPorId($turnoServicio->getIdServicio());
                                echo $nombreServicio->getDescripcion();
                            ?>
                        </td>
                        <td>
                            <?php
                                $precio = $turnoServicio->getCosto();
                                $total +=$precio;
                                echo $precio;
                            ?>
                        </td>
                    <!-------------------------------Input de CANTIDADES--------------------------------------------------------->
                        
                    <!-------------------------------JS Para Ver Subtotal-------------------------------------------------------->
                    </tr>
                    <?php
                        endforeach;
                    ?>
                    <tr>
                        <td></td>
                        <td>Total</td> 
                        <td>
                            <input type="number" value ="<?php echo $total?>" name="total" id="total" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Metodo de Pago:</td>
                        <td>
                            <select onchange="calcularPrecioFinal();" name="cboTipoPago" id="cboTipoPago">
                                <option value=0>--Metodo de Pago--</option>
                                <?php foreach($tipoPago as $tipoPago):?>
                                    <option value = "<?php echo $tipoPago->getIdTipoPago() ?>">
                                        <?php echo $tipoPago->getDescripcion();?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Precio a Pagar</td>
                        <td>
                            <input type="number" value ="<?php echo $total?>" name="subTotal" id="subTotal" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>IVA</td>
                        <td id="iva"></td>
                    </tr>
                </tbody>
                <tfoot>
                    <td colspan="3"><button type="submit">Guardar</button></td>
                </tfoot>
            </table>
        </div> 
    </form>
   
</div>

</body>
</html>