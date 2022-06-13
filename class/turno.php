<?php

require_once "MySQL.php";
require_once "agenda.php";
require_once "vehiculo.php";
require_once "servicio.php";
require_once "repuestos.php";
require_once "serviciosRepuestos.php";

require_once "taller.php";

class turno{
    private $_idTurno;
    private $_fechaTurno;
    private $_horaTurno;
    private $_idCliente;
    private $_idVehiculo;
    private $_idAgenda;
    private $_idTaller;
    private $_estado;
    private $_cantidad;

    public function getCantidadTurno(){
        return $this->_cantidad;
    }

    public function getIdTurno(){
        return $this->_idTurno;
    }

    public function getFechaTurno(){
        return $this->_fechaTurno;
    }

    public function setFechaTurno($_fechaTurno){
        $this->_fechaTurno = $_fechaTurno;
        return $this;
    }

    public function getHoraTurno(){
        return $this->_horaTurno;
    }

    public function setHoraTurno($_horaTurno){
        $this->_horaTurno = $_horaTurno;
        return $this;
    }

    public function getIdCliente(){
        return $this->_idCliente;
    }

    public function setIdCliente($_idCliente){
        $this->_idCliente = $_idCliente;
        return $this;
    }

    public function getIdVehiculo(){
        return $this->_idVehiculo;
    }

    public function setIdVehiculo($_idVehiculo){
        $this->_idVehiculo = $_idVehiculo;
        return $this;
    }

    public function getIdAgenda(){
        return $this->_idAgenda;
    }

    public function setIdAgenda($_idAgenda){
        $this->_idAgenda = $_idAgenda;
        return $this;
    }

    public function getIdTaller(){
        return $this->_idTaller;
    }

    public function setIdTaller($_idTaller){
        $this->_idTaller = $_idTaller;
        return $this;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }

    public static function eliminar($id, $taller){
        $database = new MySQL();
        $sql = "UPDATE turno SET estado = 5 WHERE id_turno = $id";
        $database->actualizar($sql);

        $sql = "SELECT servicio_repuesto.cantidad, repuesto.id_repuesto "
             . "FROM turno INNER JOIN turno_servicio ON turno.id_turno = turno_servicio.id_turno "
             . "INNER JOIN servicio ON servicio.id_servicio = turno_servicio.id_servicio "
             . "INNER JOIN servicio_repuesto ON servicio.id_servicio = servicio_repuesto.id_servicio "
             . "INNER JOIN repuesto ON servicio_repuesto.id_repuesto = repuesto.id_repuesto "
             . "INNER JOIN repuesto_taller ON repuesto.id_repuesto = repuesto_taller.id_repuesto "
             . "WHERE turno.id_turno = $id and repuesto_taller.id_taller = $taller";
        //echo $sql . "<br>";
        $datos = $database->consultar($sql);

        $idRepuesto = 0;
        $cantidad = 0;
        while ($registro = $datos->fetch_assoc()) {
            $idRepuesto = new repuestos();
			$idRepuesto = $registro["id_repuesto"];
            $cantidad = $registro["cantidad"];
            repuestos::sumarStock($idRepuesto, $cantidad, $taller);
    	}
    }

    public function cambiarEstado(){
        $database = new MySQL();
        $sql = "UPDATE turno SET estado = {$this->_estado} WHERE id_turno = {$this->_idTurno}";
        $database->actualizar($sql);
    }
    public function crearTurno(){
        $database = new MySQL();
        $sql = "INSERT INTO turno(id_turno, id_cliente, id_vehiculo, id_agenda, fecha_turno, hora_turno) "
             . "VALUES(NULL, {$this->_idCliente}, {$this->_idVehiculo}, {$this->_idAgenda}, '{$this->_fechaTurno}', '{$this->_horaTurno}')";
        $idTurno = $database->insertar($sql);
        $this->_idTurno = $idTurno;     
    }

    public static function obtenerPorIdTurno($idTurno){
        $database = new MySQL();
        $sql = "SELECT * FROM Turno "
             . "INNER JOIN Agenda ON turno.id_agenda = agenda.id_agenda "
             . "INNER JOIN Taller ON taller.id_taller = agenda.id_taller "
             . "WHERE turno.id_turno = {$idTurno}";
        //echo $sql;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$turno = self::_crearTurno($registro);
		return $turno;

    }


    private static function _crearTurno($datos) {
    	$turno = new turno();
        $vehiculo = new vehiculo();
		$turno->_idTurno = $datos["id_turno"];
        $turno->_idTaller = $datos["id_taller"];
		$turno->_idCliente = $datos["id_cliente"];
        $turno->_idVehiculo = $vehiculo->obtenerNombrePorId($datos["id_vehiculo"]);
        $turno->_idAgenda = $datos["id_agenda"];
        $turno->_fechaTurno = $datos["fecha_turno"];
        $turno->_horaTurno = $datos["hora_turno"];
        $turno->_estado = $datos["estado"];

		return $turno;
    }
    public static function obtenerTurnosUltimaSemana($fecha, $fechaMenor){
        $database = new MySQL();
        $sql = "SELECT fecha_turno, count(fecha_turno) as cantidad FROM turno "
             . "WHERE fecha_turno BETWEEN '$fechaMenor' AND '$fecha' GROUP BY fecha_turno";

        $datos = $database->consultar($sql);

        $listadoTurnos = [];
        //echo $sql;
        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $turno->_fechaTurno = $registro["fecha_turno"];
            $turno->_cantidad = $registro["cantidad"];
            $listadoTurnos[] = $turno;
    	}

    	return $listadoTurnos;
    }
    
    public static function obtenerEstadoTurnos(){
        $database = new MySQL();
        $sql = "Select estado, (Count(estado)* 100 / (Select Count(*) From turno)) as porcentaje From turno Group By estado";
        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoTurnos = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $turno->_estado = $registro["estado"];
            $turno->_cantidad = $registro["porcentaje"];
            $listadoTurnos[] = $turno;
    	}

    	return $listadoTurnos;
    }
    public static function obtenerTurnosPorAgenda($idAgenda){
        $database = new MySQL();
        $sql = "SELECT * FROM Turno WHERE id_agenda = {$idAgenda}";
        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoTurnos = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $vehiculo = new vehiculo();
			$turno->_idTurno = $registro["id_turno"];
			$turno->_idCliente = $registro["id_cliente"];
            $turno->_idVehiculo = $vehiculo->obtenerNombrePorId($registro["id_vehiculo"]);
            $turno->_idAgenda = $registro["id_agenda"];
            $turno->_fechaTurno = $registro["fecha_turno"];
            $turno->_horaTurno = $registro["hora_turno"];
            $turno->_estado = $registro["estado"];
            $listadoTurnos[] = $turno;
    	}

    	return $listadoTurnos;
    }
    public static function obtenerTurnosTotalesPorTaller(){
        $database = new MySQL();
        $sql = "SELECT count(id_turno) as turno, taller.id_taller FROM `turno` "
             . "INNER JOIN agenda on agenda.id_agenda = turno.id_agenda "
             . "INNER JOIN taller ON taller.id_taller = agenda.id_taller WHERE taller.estado != 0 GROUP BY id_taller ";

        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoTurnos = [];
        //echo $sql;
        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $turno->_cantidad = $registro["turno"];
            $turno->_idTaller = $registro["id_taller"];
            $listadoTurnos[] = $turno;
    	}

    	return $listadoTurnos;
    }
    public static function obtenerClientesConMasTurnos($idTaller){
        $database = new MySQL();
        $sql = "SELECT count(cliente.id_cliente) as cantidad, cliente.id_cliente, taller.id_taller FROM cliente "
             . "INNER JOIN turno ON turno.id_cliente = cliente.id_cliente "
             . "INNER JOIN agenda ON turno.id_agenda = agenda.id_agenda "
             . "INNER JOIN taller on agenda.id_taller = taller.id_taller "
             . "WHERE taller.id_taller = {$idTaller} GROUP BY cliente.id_cliente ORDER BY cantidad DESC";

        $datos = $database->consultar($sql);

        $listadoTurnos = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $turno->_idCliente = $registro["id_cliente"];
            $turno->_cantidad = $registro["cantidad"];
            $listadoTurnos[] = $turno;
    	}

    	return $listadoTurnos;
    }

    public static function obtenerTurnosPorIdcliente($idCliente){
        $database = new MySQL();
        $sql = "SELECT * FROM Turno WHERE id_cliente = {$idCliente} ORDER BY id_turno DESC";

        $datos = $database->consultar($sql);

        $listadoTurnos = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$turno = new turno();
            $vehiculo = new vehiculo();
			$turno->_idTurno = $registro["id_turno"];
			$turno->_idCliente = $registro["id_cliente"];
            $turno->_idVehiculo = $vehiculo->obtenerNombrePorId($registro["id_vehiculo"]);
            $turno->_idAgenda = $registro["id_agenda"];
            $turno->_fechaTurno = $registro["fecha_turno"];
            $turno->_horaTurno = $registro["hora_turno"];
            $turno->_estado = $registro["estado"];
            $listadoTurnos[] = $turno;
    	}
    	return $listadoTurnos;
    }


    public static function contarTurno($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente){
        $database = new MySQL();
        $sql = "SELECT * FROM turno Where fecha_turno = '{$fecha}'";
        
        
        $datos = $database->consultar($sql);
        $idTaller = $taller;
        $taller = taller::obtenerPorId($taller);

        if ($datos->num_rows < $taller->getMaxTurno()){
        
            $turno = new Turno();

            $turno->setIdTaller($taller);
            $turno->setIdCliente($cliente);
            $turno->setIdVehiculo($vehiculo);
            $turno->setIdAgenda($idAgenda);
            $turno->setFechaTurno($fecha);
            $turno->setHoraTurno($hora);
                                
            $turno->crearTurno();
            $idTurno = $turno->getIdTurno();

           
            foreach($servicio as $servicioId){
                $Precio = Servicio::obtenerPorId($servicioId);
                $Precio = $Precio->getPrecio();
                //echo $costo;
                $turnoServicio = new turnoServicio();
                $turnoServicio->setIdTurno($idTurno);
                $turnoServicio->setIdServicio($servicioId);
                $turnoServicio->setCosto($Precio);
                $turnoServicio->getCosto();
                $turnoServicio->guardar();
                
                $servicioTurnoRepuesto = serviciosRepuesto::obtenerPorIdServicio($servicioId);
                foreach($servicioTurnoRepuesto as $servicioTurnoRepuesto):
                    $repuestos = repuestos::descontarStock($servicioTurnoRepuesto->getIdRepuesto(), $servicioTurnoRepuesto->getCantidad(), $idTaller);
                endforeach;
            }
            
            if($mostrarCliente == 1){
                header("location: misTurnos.php");
                exit;
            }
            header("location: /xampp/proyectoPPI/inicio.php?mensaje=completado");
            exit;
        } else{
            if($mostrarCliente == 1){
                header("location: misTurnos.php?error=maxTurnosPorDia");
                exit;
            }
            header("location: ../taller/listado.php?error=maxTurnosPorDia");
            exit;
        }
    }




    public static function recorrerFecha($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente){
        $dias = dia::obtenerPorIdAgenda($idAgenda);
        $nombresDias = [$dias->getDomingo(),$dias->getLunes(), $dias->getMartes(), $dias->getMiercoles(), $dias->getJueves(), $dias->getViernes(), $dias->getSabado()];
        
        // establecemos la fecha de inicio
        $agenda = agenda::obtenerPorId($idAgenda);
        //$fecha = DateTime::createFromFormat('Y-m-d', $fecha, new DateTimeZone('America/Argentina/Cordoba'));

        $inicio =  DateTime::createFromFormat('Y-m-d', $fecha, new DateTimeZone('America/Argentina/Cordoba'));
        // establecemos la fecha final (fecha de inicio + dias que queramos)
        $fin =  DateTime::createFromFormat('Y-m-d', $agenda->getfechainicio(), new DateTimeZone('America/Argentina/Cordoba'));
        $fin->modify( '+31 day' );
        
        // creamos el periodo de fechas
        $periodo = new DatePeriod($inicio, new DateInterval('P1D') ,$fin);
        
        // recorremos las fechas del periodo
        foreach($periodo as $date):
            // definimos la variables para verlo mejor
            $nombreDia = $nombresDias[$date->format("w")];
            $numeroDia = $date->format("j");
            $anyo = $date->format("Y");
            // mostramos los datos
            //echo $nombreDia.' '.$numeroDia.' de '.$anyo.'<br>';

            if ($nombreDia == 1){
                turno::contarTurno($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente);
                exit;
            } else{
                if($mostrarCliente == 1){
                    header("location: misTurnos.php?error=diaNoLaboral");
                    exit;
                }
                header("location: nuevo.php?error=diaNoLaboral");
                exit;
            }
        endforeach;
    }  
}

?>