<?php
require_once "MySQL.php";
class factura{
    private $_idFactura;
    private $_numeracion;
    private $_fecha;
    private $_idTipoFactura;
    private $_estado;

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }

    public function getIdFactura(){
        return $this->_idFactura;
    }
    public function getIdTipoFactura(){
        return $this->_idTipoFactura;
    }
    public function setIdTipoFactura($_idTipoFactura){
        $this->_idTipoFactura = $_idTipoFactura;
        return $this;
    }

    public function setNumeracion($_numeracion){
        $this->_numeracion = $_numeracion;
        return $this;
    }

    public function getNumeracion(){
        return $this->_numeracion;
    }

    public function setFecha($_fecha){
        $this->_fecha = $_fecha;
        return $this;
    }

    public function getFecha(){
        return $this->_fecha;
    }

    public function cambiarEstado(){
        $database = new MySQL();
        $sql = "UPDATE factura SET estado = {$this->_estado} WHERE id_factura = {$this->_idFactura}";

        $database->actualizar($sql);
    }

    public static function eliminar($id){
        $database = new MySQL();
        $sql = "UPDATE factura SET estado = 0 WHERE id_factura = $id";

        $database->actualizar($sql);
    }
    public function guardar(){
        $database = new MySQL();
        $sql = "SELECT numeracion FROM factura";
        $datos = $database->consultar($sql);

        $numero = 0;
        while ($registro = $datos->fetch_assoc()) {
	    	$factura = new factura();
			$numero = $factura->_numeracion = $registro["numeracion"] + 1;
    	}
        

        $sql = "INSERT INTO factura(id_factura,fecha_emision,numeracion,id_tipo_factura) VALUES "
             . "(NULL, '{$this->_fecha}', $numero, {$this->_idTipoFactura})";

        $idFactura = $database->insertar($sql);
        $this->_idFactura = $idFactura;
    }

    public static function obtenerTodos(){
        $database = new MySQL();
        $sql = "SELECT * FROM factura WHERE estado != 0";
        //echo $sql;
        //exit;
    	$datos = $database->consultar($sql);

    	$listadoFactura = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$factura = new factura();
			$factura->_idFactura = $registro["id_factura"];
			$factura->_numeracion = $registro["numeracion"];
			$factura->_fecha = $registro["fecha_emision"];
			$factura->_idTipoFactura = $registro["id_tipo_factura"];
            $factura->_estado = $registro["estado"];

    		$listadoFactura[] = $factura;
    	}


    	return $listadoFactura;
	}

    public static function obtenerPorIdFactura($idFactura){
        $database = new MySQL();
        $sql = "SELECT * FROM factura WHERE id_factura = $idFactura";
    	$datos = $database->consultar($sql);

    	$registro = $datos->fetch_assoc();
    	$factura = self::_crearFactura($registro);
		return $factura;

    }
    private static function _crearFactura($datos) {
    	$factura = new factura();
		$factura->_idFactura = $datos["id_factura"];
		$factura->_numeracion = $datos["numeracion"];
		$factura->_fecha = $datos["fecha_emision"];
		$factura->_idTipoFactura = $datos["id_tipo_factura"];

		return $factura;
    }
}

?>