<?php

require_once "MySQL.php";

class serviciosRepuesto{

    private $_idServicioRepuesto;
    private $_idRepuesto;
    private $_idServicio;
    private $_cantidad;

    public function getIdServicioRepuesto(){
        return $this->_idServicioRepuesto;
    }

    public function setIdServicioRepuesto($_idServicioRepuesto){
        $this->_idServicioRepuesto = $_idServicioRepuesto;
        return $this;
    }

    public function getIdRepuesto(){
        return $this->_idRepuesto;
    }

    public function setIdRepuesto($_idRepuesto){
        $this->_idRepuesto = $_idRepuesto;
        return $this;
    }

    public function getIdServicio(){
        return $this->_idServicio;
    }

    public function setIdServicio($_idServicio){
        $this->_idServicio = $_idServicio;
        return $this;
    }

    public function getCantidad(){
        return $this->_cantidad;
    }

    public function setCantidad($_cantidad){
        $this->_cantidad = $_cantidad;
        return $this;
    }

    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO servicio_repuesto(id_servicio_repuesto, id_servicio, id_repuesto, cantidad) "
             . "VALUES(NULL, {$this->_idServicio}, {$this->_idRepuesto}, {$this->_cantidad})";

        $database->insertar($sql);
    }

    public function eliminar(){
        $database = new MySQL();
        $sql = "DELETE FROM servicio_repuesto WHERE id_servicio_repuesto = {$this->_idServicioRepuesto}";
        $database->eliminar($sql);
    }
    public static function obtenerPorIdServicioRepuesto($IdServicioRepuesto){
        $database = new MySQL();
        $sql = "SELECT * FROM servicio_repuesto WHERE id_servicio_repuesto ={$IdServicioRepuesto}";
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$servicioRepuesto = self::_crearservicioRepuesto($registro);
		return $servicioRepuesto;
    }

    private static function _crearservicioRepuesto($datos) {
        $servicioRepuesto = new serviciosRepuesto();
        $servicioRepuesto->_idServicioRepuesto = $datos["id_servicio_repuesto"];
        $servicioRepuesto->_idServicio = $datos["id_servicio"];
        $servicioRepuesto->_idRepuesto = $datos["id_repuesto"];
        $servicioRepuesto->_cantidad = $datos["cantidad"];

		return $servicioRepuesto;
    }
    public static function obtenerPorIdServicio($IdServicio){
        $database = new MySQL();
        $sql = "SELECT id_servicio_repuesto, id_servicio, id_repuesto, sum(cantidad) as cantidad FROM servicio_repuesto WHERE id_servicio ={$IdServicio} GROUP BY id_repuesto";
        $datos = $database->consultar($sql);

        $listadoServicioRepuesto = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$servicioRepuesto = new serviciosRepuesto();
			$servicioRepuesto->_idServicioRepuesto = $registro["id_servicio_repuesto"];
			$servicioRepuesto->_idServicio = $registro["id_servicio"];
			$servicioRepuesto->_idRepuesto = $registro["id_repuesto"];
            $servicioRepuesto->_cantidad = $registro["cantidad"];
    		$listadoServicioRepuesto[] = $servicioRepuesto;
    	}


    	return $listadoServicioRepuesto;
    }
}


?>