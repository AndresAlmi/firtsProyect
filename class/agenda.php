<?php

require_once "MySQL.php";
require_once "turno.php";

class Agenda {

	private $_idAgenda;
	private $_fechaInicio;
    private $_fechaFin;
    private $_horaInicio;
    private $_horaFin;
    private $_estado;
	private $_idTaller;
	private $_turnoPorDia;

	public function getidAgenda() {
		return $this->_idAgenda;
	}

	public function getfechainicio() {
		return $this->_fechaInicio;
	}

	public function setfechainicio($_fechaInicio) {
		$this->_fechaInicio = $_fechaInicio;
	}
    
    public function getfechafin() {
		return $this->_fechaFin;
	}

	public function setfechafin($_fechaFin) {
		$this->_fechaFin = $_fechaFin;
	}

    public function gethorafin() {
		return $this->_horaFin;
	}

	public function sethorafin($_horaFin) {
		$this->_horaFin = $_horaFin;
	}

    public function gethorainicio() {
		return $this->_horaInicio;
	}

	public function sethorainicio($_horaInicio) {
		$this->_horaInicio = $_horaInicio;
	}
	
    public function getestado (){
        return $this->_estado;
    }
	
    public function setestado($_estado){
        $this->_estado = $_estado;
    }

	public function getIdTaller() {
		return $this->_idTaller;
	}

	public function setIdTaller($_idTaller){
		$this->_idTaller = $_idTaller;

	}

	public function getTurnoPorDia(){
		return $this->_turnoPorDia;
	}

	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO agenda "
		     . "(id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller) "
		     . "VALUES (NULL, '{$this->_fechaInicio}', '{$this->_fechaFin}', '{$this->_horaInicio}', '{$this->_horaFin}', "
			 . "'{$this->_estado}', '{$this->_idTaller}')";
		$_idAgenda = $database->insertar($sql);

		$this->_idAgenda = $_idAgenda;

	}

	public function actualizar() {
		$database = new mysql();

		$sql = "UPDATE agenda  SET fecha_inicio = '{$this->_fechaInicio}', "
			 . "fecha_fin = '{$this->_fechaFin}', hora_inicio = '{$this->_horaInicio}', hora_fin = '{$this->_horaFin}', "
			 . "estado = '{$this->_estado}' "
             . "WHERE id_agenda = {$this->_idAgenda}";

        $database->actualizar($sql);

	}

	public function eliminar (){
		$sql = "UPDATE agenda SET estado = 'ocupado' WHERE id_agenda ={$this->_idAgenda}";
	
		$database = new MySQL();
		$database->baja($sql);

	}

	public static function obtenerTodos() {
    	$sql = "SELECT id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller FROM agenda";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoagenda = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$agenda = new Agenda();
			$agenda->_idAgenda = $registro["id_agenda"];
			$agenda->_fechaInicio = $registro["fecha_inicio"];
			$agenda->_fechaFin = $registro["fecha_fin"];
			$agenda->_horaInicio = $registro["hora_inicio"];
			$agenda->_horaFin = $registro["hora_fin"];
            $agenda->_estado = $registro["estado"];
			$agenda->_idTaller = $registro["id_taller"];
    		$listadoagenda[] = $agenda;
    	}


    	return $listadoagenda;
	}

    public static function obtenerPorId($id) {
    	$sql = "SELECT  id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller FROM agenda WHERE id_agenda= " . $id;

		$database = new mysql();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

		$registro = $datos->fetch_assoc();
    	$agenda = self::_crearagenda($registro);
		return $agenda;
    }
 
    private static function _crearagenda($datos) {
    	$agenda = new Agenda();
		$agenda->_idAgenda = $datos["id_agenda"];
        $agenda->_fechaInicio = $datos["fecha_inicio"];
        $agenda->_fechaFin = $datos["fecha_fin"];
		$agenda->_horaInicio = $datos["hora_inicio"];
		$agenda->_horaFin = $datos["hora_fin"];
        $agenda->_estado = $datos["estado"];
		$agenda->_idTaller = $datos["id_taller"];


		return $agenda;
    }

	
    public static function obtenerPorIdTaller($id) {
    	$sql = "SELECT  id_agenda, fecha_inicio, fecha_fin, hora_inicio, "
			 . "hora_fin, estado, id_taller FROM agenda WHERE id_taller= " . $id;
		//echo $sql;
    	$database = new MySQL();
		//echo $sql;
    	$datos = $database->consultar($sql);

    	$listadoagenda = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$agenda = new Agenda();
			$agenda->_idAgenda = $registro["id_agenda"];
			$agenda->_fechaInicio = $registro["fecha_inicio"];
			$agenda->_fechaFin = $registro["fecha_fin"];
			$agenda->_horaInicio = $registro["hora_inicio"];
			$agenda->_horaFin = $registro["hora_fin"];
			$agenda->_estado = $registro["estado"];
			$agenda->_idTaller = $registro["id_taller"];
    		$listadoagenda[] = $agenda;
    	}

    	return $listadoagenda;
	}
	public static function obtenerPorIdTallerEstado($id) {
    	$sql = "SELECT  id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller "
			 . "FROM agenda WHERE id_taller= " . $id . " AND estado = 'Disponible'";
		
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

		if ($datos->num_rows == 0) {
        	return false;
        }

		$registro = $datos->fetch_assoc();
    	$agenda = self::_crearagenda2($registro);
		return $agenda;
    }
	public static function obtenerPorIdAgendaEstado($id) {
    	$sql = "SELECT  id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller "
			 . "FROM agenda WHERE id_agenda= " . $id . " AND estado = 'Disponible'";
		
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

		if ($datos->num_rows == 0) {
        	return false;
        }

		$registro = $datos->fetch_assoc();
    	$agenda = self::_crearagenda2($registro);
		return $agenda;
    }
 
    private static function _crearagenda2($datos) {
    	$agenda = new Agenda();
		$agenda->_idAgenda = $datos["id_agenda"];
        $agenda->_fechaInicio = $datos["fecha_inicio"];
        $agenda->_fechaFin = $datos["fecha_fin"];
		$agenda->_horaInicio = $datos["hora_inicio"];
		$agenda->_horaFin = $datos["hora_fin"];
        $agenda->_estado = $datos["estado"];
		$agenda->_idTaller = $datos["id_taller"];

		return $agenda;
    }

	public static function compararFechas($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente) {
    	$sql = "SELECT id_agenda, fecha_inicio, fecha_fin, estado, id_taller "
			 . "FROM agenda WHERE id_agenda = $idAgenda AND '$fecha' between fecha_inicio and fecha_fin";

		
		
		$database = new mysql();
        $datos = $database->consultar($sql);

        if ($datos->num_rows > 0) {
			agenda::compararHoras($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente);
			exit;
        }
		if($mostrarCliente == 1){
			header("location: misTurnos.php?error=fechainvalida");
			exit;
		}
		header("location: ../turno/nuevo.php?error=fechaInvalida");
		exit;
	}

	public static function compararHoras($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente){
		$sql = "SELECT id_agenda, fecha_inicio, fecha_fin, hora_inicio, hora_fin, estado, id_taller "
			 . "FROM agenda WHERE id_agenda = $idAgenda AND '$hora' between hora_inicio and hora_fin"; 

		$database = new mysql();
        $datos = $database->consultar($sql);
		if ($datos->num_rows > 0) {
			turno::recorrerFecha($taller, $cliente, $vehiculo, $idAgenda, $fecha, $hora, $servicio, $mostrarCliente);
			exit;
        }
		if($mostrarCliente == 1){
			header("location: misTurnos.php?error=horaInvalida");
			exit;
		}
		header("location: ../turno/nuevo.php?error=horaInvalida");
		exit;
	}

//sos un capo

}

?>