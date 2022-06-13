<?php

require_once "../../class/turno.php";

$fechaInicio=$_GET["fechaInicio"];
$fechaFin = $_GET["fechaFin"];

$respuesta = "";

$lista = turno::obtenerTurnosUltimaSemana($fechaFin, $fechaInicio);
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
        foreach ($lista as $turno):
            $respuesta.="<tr class='tr'> "
                                
                            ."<td>".$turno->getFechaTurno()."</td> "
                            ."<td>".$turno->getCantidadTurno()."</td> "
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