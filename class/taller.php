<?php

require_once "MySQL.php";
require_once "Empleado.php";
class taller{
    private $_idTaller;
    private $_nombre;
    private $_estado;
    private $_maxTurno;
    
    public function getEmpleados(){
        return $this->_empleados;
    }

    public function getIdTaller(){
        return $this->_idTaller;
    }

    public function getRepuestos(){
        return $this->_listaRepuesto;
    }

    public function getNombre(){
        return $this->_nombre;
    }

    public function setNombre($_nombre){
        $this->_nombre = $_nombre;
        return $this;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }
    
    public function getMaxTurno(){
        return $this->_maxTurno;
    }

    public function setMaxTurno($_maxTurno){
        $this->_maxTurno = $_maxTurno;
        return $this;
    }

    public function guardar(){
    
		$database = new MySQL();

		$sql = "INSERT INTO taller "
             . "(id_taller, nombre, maxTurno) "
             . "VALUES(NULL, '{$this->_nombre}', '{$this->_maxTurno}')";
        
		$database->insertar($sql);
    }

    
    
    public function actualizar(){
        $database = new MySQL();

		$sql = "UPDATE taller SET nombre = '{$this->_nombre}', maxTurno =  '{$this->_maxTurno}' "
             . "WHERE id_taller = {$this->_idTaller}";


        $database->actualizar($sql);
    }

    public function baja() {
    	$sql = "UPDATE taller SET estado = '0' "
			 . "WHERE id_taller = '{$this->_idTaller}'";

    	$database = new MySQL();
        $database->baja($sql);
    }
    
    public static function obtenerTodos(){
        $sql = "SELECT * FROM taller where estado = 1";
        $database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoTaller = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$taller = new taller();
			$taller->_idTaller = $registro["id_taller"];
			$taller->_nombre = $registro["nombre"];
            $taller->_estado = $registro["estado"];
            $taller->_maxTurno = $registro["maxTurno"];
    		$listadoTaller[] = $taller;
    	}


    	return $listadoTaller;
    }

    public static function obtenerPorId($id) {
    	$sql = "SELECT * from taller "
             . "WHERE id_taller = " . $id;
        //echo $sql;
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$taller = self::_crearTaller($registro);
		return $taller;
    }


    private static function _crearTaller($datos) {
    	$taller = new taller();
		$taller->_idTaller = $datos["id_taller"];
		$taller->_nombre = $datos["nombre"];
        $taller->_estado = $datos["estado"];
        $taller->_maxTurno = $datos["maxTurno"];
		return $taller;
    }

    public static function obtenerServiciosSolicitadosPorTaller($idTaller, $orden){
        $sql = "SELECT servicio.descripcion, count(servicio.id_servicio) as id_servicio, taller.id_taller, taller.nombre FROM servicio "
             . "INNER JOIN turno_servicio ON servicio.id_servicio = turno_servicio.id_servicio "
             . "INNER JOIN turno on turno_servicio.id_turno = turno.id_turno "
             . "INNER JOIN agenda on turno.id_agenda = agenda.id_agenda "
             . "INNER JOIN taller on agenda.id_taller = taller.id_taller "
             . "where taller.id_taller = $idTaller GROUP BY servicio.descripcion ORDER BY id_servicio $orden ";
        //echo $sql;
        $database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoTaller = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$taller = new taller();
			$taller->_maxTurno = $registro["id_servicio"];
			$taller->_nombre = $registro["descripcion"];
    		$listadoTaller[] = $taller;
    	}


    	return $listadoTaller;
    }
    
}


?>