<?php

require_once "../../class/taller.php";

$idTaller=$_GET["idTaller"];
$orden = $_GET["orden"];

$respuesta = "";


$lista = taller::obtenerServiciosSolicitadosPorTaller($idTaller, $orden);
if(sizeof($lista) > 0){
    $respuesta .= "
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>	
            <tbody>";
        foreach ($lista as $taller):
            $respuesta.="<tr class='tr'> "
                                
                            ."<td>".$taller->getNombre()."</td> "
                            ."<td>".$taller->getMaxTurno()."</td> "
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