<?php
require_once "MySQL.php";

class tipoFactura{
    private $_idTipoFactura;
    private $_descripcion;
    
    public function getIdTipoFactura(){
        return $this->_idTipoFactura;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setDescripcion($_descripcion){
        $this->_descripcion = $_descripcion;
        return $this;
    }

    public static function obtenerTodos(){
        $database = new MySQL();
        $sql = "SELECT * FROM tipo_factura";
        $datos = $database->consultar($sql);

        $listadoTipoFactura = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$tipoFactura = new tipoFactura();
			$tipoFactura->_idTipoFactura = $registro["id_tipo_factura"];
			$tipoFactura->_descripcion = $registro["descripcion"];
            $listadoTipoFactura[] = $tipoFactura;
    	}

    	return $listadoTipoFactura;
    }
    public static function obtenerPorId($idTipoFactura){
        $database = new MySQL();
        $sql = "SELECT * FROM tipo_factura WHERE id_tipo_factura = $idTipoFactura";
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();
    	$tipoFactura = self::_crearTipoFactura($registro);
		return $tipoFactura;

    }
    private static function _crearTipoFactura($datos) {
    	$factura = new tipoFactura();
		$factura->_idTipoFactura = $datos["id_tipo_factura"];
		$factura->_descripcion = $datos["descripcion"];

		return $factura;
    }
}
?>