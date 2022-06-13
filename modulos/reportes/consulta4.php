<?php
require_once "../../class/turnoServicio.php";
$idModelo = $_GET["idModelo"];

$lista = turnoServicio::obtenerServiciosPorIdModelo($idModelo);
$respuesta = "";

if(sizeof($lista) > 0){
    $respuesta .= "
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                </tr>
            </thead>	
            <tbody>";
        foreach ($lista as $modelo):
            $servicio = Servicio::obtenerPorId($modelo->getIdServicio());
            $respuesta.="<tr class='tr'> "
                                
                            ."<td>". $servicio->getDescripcion() ."</td> "
                            ."<td>". $modelo->getCantidad() ."</td> "
                        ."</tr>";
                    
        endforeach;
        $respuesta.="
                </tbody>
            </table>";
}
else{
    $respuesta = "No hay coincidencias";
}




echo $respuesta;

?>
