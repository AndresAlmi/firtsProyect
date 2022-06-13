<?php
require_once "MySQL.php";
require_once "servicio.php";
require_once "turno.php";

class turnoServicio{

    private $_idTurnoServicio;
    private $_idTurno;
    private $_idServicio;
    private $_costo;
    private $_estado;
    private $_idFactura;
    private $_cantidad;

    public function getidTurnoServicio(){
        return $this->_idTurnoServicio;
    }

    public function setidTurnoServicio($_idTurnoServicio){
        $this->_idTurnoServicio = $_idTurnoServicio;
        return $this;
    }
    public function getIdTurno(){
        return $this->_idTurno;
    }

    public function setIdTurno($_idTurno){
        $this->_idTurno = $_idTurno;
        return $this;
    }

    public function getCosto(){
        return $this->_costo;
    }

    public function setCosto($_costo){
        $this->_costo = $_costo;
        return $this;
    }

    public function getIdServicio(){
        return $this->_idServicio;
    }

    public function setIdServicio($_idServicio){
        $this->_idServicio = $_idServicio;
        return $this;
    }

    public function getIdFactura(){
        return $this->_idFactura;
    }

    public function setIdFactura($_idFactura){
        $this->_idFactura = $_idFactura;
        return $this;
    }
    
    public function getCantidad(){
        return $this->_cantidad;
    }

    public function setCantidad($_cantidad){
        $this->_cantidad = $_cantidad;
        return $this;
    }

    public static function eliminar($idTurno, $idServicio){
        $database = new MySQL();
        $sql = "DELETE FROM turno_servicio WHERE id_turno = $idTurno and id_servicio = $idServicio";
        $database->eliminar($sql);
    }

    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO turno_servicio(id_turno_servicio, id_turno, id_servicio, costo) "
             . "VALUES (NULL, '{$this->_idTurno}','{$this->_idServicio}', '{$this->_costo}')";
        $idTurnoServicio = $database->insertar($sql);
        $this->_idTurnoServicio = $idTurnoServicio;
    }

    public function guardarFactura(){
        $database = new MySQL();
        $sql = "UPDATE turno_servicio SET id_factura = {$this->_idFactura} "
             . "WHERE id_turno_servicio = {$this->_idTurnoServicio}";
        $database->actualizar($sql);
    }


    public static function obtenerFactura($idFactura){
        $database = new MySQL();
        $sql = "SELECT id_turno_servicio, id_turno, id_servicio, id_factura, costo FROM turno_servicio WHERE id_factura = $idFactura";
        $datos = $database->consultar($sql);
        //echo $sql;
        $listadoTurnoServicio = [];
        while ($registro = $datos->fetch_assoc()) {
	    	$turnoServicio = new turnoServicio();
            $turnoServicio->_idTurnoServicio = $registro["id_turno_servicio"];
            $turnoServicio->_idTurno = $registro["id_turno"];
            $turnoServicio->_idServicio = $registro["id_servicio"];
            $turnoServicio->_costo = $registro["costo"];
            $turnoServicio->_idFactura = $registro["id_factura"];
            $listadoTurnoServicio[] = $turnoServicio;
    	}

    	return $listadoTurnoServicio;
    }

    public static function obtenerPorIdTurno($idTurno){
        $database = new MySQL();
        $sql = "SELECT * FROM turno_servicio WHERE id_turno = {$idTurno}";
        $datos = $database->consultar($sql);

        $listadoTurnoServicio = [];
        while ($registro = $datos->fetch_assoc()) {
	    	$turnoServicio = new turnoServicio();
            $turnoServicio->_idTurnoServicio = $registro["id_turno_servicio"];
            $turnoServicio->_idTurno = $registro["id_turno"];
            $turnoServicio->_idServicio = $registro["id_servicio"];
            $turnoServicio->_costo = $registro["costo"];
            $turnoServicio->_idFactura = $registro["id_factura"];
            $listadoTurnoServicio[] = $turnoServicio;
    	}

    	return $listadoTurnoServicio;
    }

    public static function obtenerServiciosSolicitados(){
        $database = new MySQL();
        $sql = "SELECT count(id_servicio) as servicios, id_servicio, id_turno FROM turno_servicio GROUP BY id_servicio ORDER BY servicios DESC LIMIT 5";
        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoTurnoServicio = [];
        while ($registro = $datos->fetch_assoc()) {
	    	$turnoServicio = new turnoServicio();
            $turnoServicio->_cantidad = $registro["servicios"];
            $turnoServicio->_idServicio = $registro["id_servicio"];
            $listadoTurnoServicio[] = $turnoServicio;
    	}

        return $listadoTurnoServicio;
    
    }

    public static function obtenerServiciosSolicitadosPorVehiculo(){
        $database = new MySQL();
        $sql = "SELECT count(id_servicio) as servicios, id_servicio, id_turno, id_vehiculo FROM turno_servicio "
             . "INNER JOIN turno ON turno.id_turno = turno_servicio.id_turno "
             . "INNER JOIN vehiculo ON vehiculo.id_vehiculo = turno.id_vehiculo "
             . "GROUP BY id_servicio ORDER BY servicios DESC LIMIT 5";
        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoTurnoServicio = [];
        while ($registro = $datos->fetch_assoc()) {
	    	$turnoServicio = new turnoServicio();
            $turnoServicio->_cantidad = $registro["servicios"];
            $turnoServicio->_idServicio = $registro["id_servicio"];
            $listadoTurnoServicio[] = $turnoServicio;
    	}

        return $listadoTurnoServicio;
    
    }
    public static function obtenerServiciosPorIdModelo($idModelo) {
    	$sql = "SELECT count(turno_servicio.id_servicio) as cantidad, servicio.id_servicio, turno.id_turno, "
             . "vehiculo.id_vehiculo, modelo_vehiculo.id_modelo_vehiculo FROM servicio "
             . "INNER JOIN turno_servicio ON turno_servicio.id_servicio = servicio.id_servicio "
             . "INNER JOIN turno ON turno.id_turno = turno_servicio.id_turno "
             . "INNER JOIN vehiculo ON vehiculo.id_vehiculo = turno.id_vehiculo "
             . "INNER JOIN modelo_vehiculo ON modelo_vehiculo.id_modelo_vehiculo = vehiculo.id_modelo_vehiculo "
             . "WHERE modelo_vehiculo.id_modelo_vehiculo = $idModelo GROUP BY servicio.id_Servicio LIMIT 5";
        //echo $sql;
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoServicio = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$turnoServicio = new turnoServicio();
			$turnoServicio->_idServicio = $registro["id_servicio"];
            $turnoServicio->_cantidad = $registro["cantidad"];

            $listadoServicio[] = $turnoServicio;
    	}


    	return $listadoServicio;
	}
}
?>