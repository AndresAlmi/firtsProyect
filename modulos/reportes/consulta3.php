<?php

require_once "../../class/turno.php";
require_once "../../class/cliente.php";

$idTaller=$_GET["idTaller"];

$respuesta = "";

$numero = 0;
$lista = turno::obtenerClientesConMasTurnos($idTaller);
if(sizeof($lista) > 0){
    $respuesta .= "
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Cantidad De Turnos Solicitados</th>
                </tr>
            </thead>	
            <tbody>";
        foreach ($lista as $turno):
            $numero +=1;
            $cliente = cliente::obtenerPorId($turno->getIdCliente());
            $respuesta.="<tr class='tr'> "
                                
                            ."<td>". "Nro " . $numero . ": " .$cliente->getNombre() . ", " . $cliente->getApellido()."</td> "
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