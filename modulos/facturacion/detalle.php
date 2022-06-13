<?php
require_once "../../class/turnoServicio.php";
require_once "../../class/turno.php";
require_once "../../class/cliente.php";
require_once "../../class/factura.php";
require_once "../../class/tipoFactura.php";
require_once "../../class/tipoPago.php";

$idFactura = $_GET['id_factura'];
$estado = $_GET["estado"];
$div = "";
if($estado != 1){
    $estado = "pagado";
    $div = "<div class='$estado'>"
         . "    <p>PAGADO///PAGADO</p>"
         . "</div>";
}
$turnoServicio = turnoServicio::obtenerFactura($idFactura);
$idTurno = 0;
foreach($turnoServicio as $turno):
    $idTurno = $turno->getIdTurno();
endforeach;

$turno = turno::obtenerPorIdTurno($idTurno);
//$turnos = turno::obtenerPorIdTurnoParaCliente($idTurno);
$idCliente = $turno->getIdCliente();
$clientee = cliente::obtenerPorId($idCliente);

$factura = factura::obtenerPorIdFactura($idFactura);
$idTipoFactura = $factura->getIdTipoFactura();
$facturaTipo = tipoFactura::obtenerPorId($idTipoFactura);

$taller = taller::obtenerPorId($turno->getIdTaller());
$nombreTaller = $taller->getNombre();

$tipoPago = tipoPago::obtenerPorIdFactura($idFactura);
$total = 0;
$nuevoTotal =0;
$iva = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado Factura</title>
    <link rel="stylesheet" href="../../styles/header.css">
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


        .pagado p{ 
            left: 200px;

            transform: rotate(45deg); 
            
            transform-origin: 50% 50%; 
            
            font-size: 100px; 
            width: 250px; 
            position: absolute  ;
            color: red;
            text-shadow: 5px 5px black;
            opacity: 0.2;
        } 
        p{
            margin-top: 250px;
            padding-right: 1000px;
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="back">
        <a href="javascript:history.back()"><img src="../../img/back.png" height="30px" width="30px"></a>
    </div>
    
    <div class="contenedorDetalle">
        <?php echo $div;?>
        <section class = "detalle">
            <div class="cabeceraDetalle">
                <div class="cabeceraDetalleEmpresa">
                    <div class="cabeceraDetalleEmpresaImg">
                        <img src="../../img/Logo2.0.png" width="150px" height="150px">
                    </div>
                    <div class="cabeceraDetalleEmpresaTaller">
                        <H1>ServiceSystem</H1>
                        <h2><?php echo $taller->getNombre();?></h2>
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
                                    <td><?php echo $clientee->getNombre() . ", " . $clientee->getApellido()?></td>
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
                                    <th>Numeración</th>
                                    <th>Fecha De Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $facturaTipo->getDescripcion();?></td>
                                    <td><?php echo $factura->getNumeracion();?></td>
                                    <td><?php echo $factura->getFecha();?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="factura">
                <table>
                    <thead>
                        <tr class="descripcion">
                            <th>ID-Servicio</th>
                            <th>Descripción</th>
                            <th>Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($turnoServicio as $turnoServicio):?>
                            <?php $servicio = servicio::obtenerPorId($turnoServicio->getIdServicio())?>
                            <tr>
                                <td class="center"><?php echo $turnoServicio->getIdServicio()?></td>
                                <td class="center"><?php echo $servicio->getDescripcion()?></td>
                                <td class="right"><?php echo $turnoServicio->getCosto();?></td>
                                <?php $total += $turnoServicio->getCosto();?>
                                <?php if($facturaTipo->getDescripcion() == "A"){?>
                                <?php $iva = $total * 0.21;?>
                                <?php $iva = "<tr> <td> </td><td> IVA </td> " . "<td> $$iva </td> </tr>";?>
                                <?php }?>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    <tfoot>
                        
                        <?php echo $iva;?>
                        
                        <tr>
                            <td></td>
                            <td>TOTAL</td>
                            <td><?php echo "$".$total;?></td>
                        </tr>
                        
                    </tfoot>
                </table>
                
            </div>
            
        </section> 
    </div>
</body>
</html>