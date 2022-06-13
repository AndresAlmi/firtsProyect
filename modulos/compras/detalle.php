<?php
require_once "../../class/repuestoProveedor.php";
require_once "../../class/proveedor.php";
require_once "../../class/repuestos.php";
require_once "../../class/taller.php";

$idProveedor = $_GET["id_proveedor"];
$fecha = $_GET["fecha"];
$listaRepuestoProveedor = repuestoProveedor::obtenerPorIdYFecha($idProveedor,$fecha);
//exit;
$listadoTaller = taller::obtenerTodos();
$button = "submit";
foreach($listaRepuestoProveedor as $prueba):
    if($prueba->getEstado() == 0){
        $button = "buttonn";
    }
endforeach;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles</title>
    <link rel="stylesheet" href="../../styles/header.css">
    <script src="../../js/jquery.3.6.js"></script>
    <script type="text/javascript" src="../../js/compras.js"></script>

    <script>
        $(document).ready(function(){
			$("#button").click(function(){
                alert("Ya se ha realizado la compra");
			});
    	})
    </script>
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
    <header></header>
    <nav></nav>
    <div class="back">
        <a href="javascript:history.back()"><img src="../../img/back.png" height="30px" width="30px"></a>
    </div>
    <div class="contenedorDetalle">

        <div class="cabeceraDetalle">
            <div class="cabeceraDetalleEmpresa">
                <div class="cabeceraDetalleEmpresaImg">
                    <img src="../../img/Logo2.0.png" width="150px" height="150px">
                </div>
                <div class="cabeceraDetalleEmpresaTaller">
                    <H1>ServiceSystem</H1>
                    <?php $idProveedor = 0;?>
                    <?php foreach($listaRepuestoProveedor as $proveedores):?>
                    <?php $proveedor = proveedor::obtenerPorId($proveedores->getIdProveedor());?>
                    <?php $nombre = $proveedor->getNombre(); $fecha = $proveedores->getFecha();?>
                    <?php $idProveedor = $proveedor->getIdProveedor();?>
                    <?php endforeach;?>
                    <h2><?php echo $nombre;?></h2>
                    <h2><?php echo $fecha;?></h2>
                </div>
            </div>
            
        </div>
        <div class="factura">
            <form action="comprar.php" method="POST">
                
                <table>
                    <thead>
                        <tr>
                            <th>Repuestos</th>
                            <th>Cantidad</th>                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaRepuestoProveedor as $listaRepuestos):?>
                            <?php $repuesto = repuestos::obtenerPorIdRepuesto($listaRepuestos->getIdRepuesto())?>
                            <tr>
                                <input type="hidden" value="<?php echo $idProveedor;?>" name="proveedor">
                                <input type="hidden" value="<?php echo $repuesto->getIdRepuesto();?>" name="repuesto[]">
                                <input type="hidden" value="<?php echo $listaRepuestos->getCantidad();?>" name="cantidad[]">
                                <td><?php echo $repuesto->getDescripcion()?></td>
                                <td class="right"><?php echo $listaRepuestos->getCantidad();?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    <tfoot>
                        <td>
                        <select name="cboTaller" id="cboTaller">
                            <option value="">seleccionar</option>
                            <?php
                            foreach($listadoTaller as $listadoTaller):?>
                                <option value="<?php echo $listadoTaller->getIdTaller();?>">
                                    <?php echo $listadoTaller->getNombre();?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        </td>
                        <td>
                            <button type="<?php echo $button?>" id="<?php echo $button?>">Adquirir</button>
                        </td>
                    </tfoot>
                </table>
            </form>
            
        </div>
    </div>
</body>
</html>