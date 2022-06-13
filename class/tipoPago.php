<?php
require_once "MySQL.php";
require_once "factura.php";
class tipoPago{
    private $_idTipoPago;
    private $_descripcion;
    private $_porcentaje;
    private $_idFactura;
        
    public function getIdTipoPago(){
        return $this->_idTipoPago;
    }
    public function setIdTipoPago($_idTipoPago){
        $this->_idTipoPago = $_idTipoPago;
        return $this;
    }
    public function getIdFactura(){
        return $this->_idFactura;
    }
    public function setIdFactura($_idFactura){
        $this->_idFactura = $_idFactura;
        return $this;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setDescripcion($_descripcion){
        $this->_descripcion = $_descripcion;
        return $this;
    }

    public function getPorcentaje(){
        return $this->_porcentaje;
    }

    public function setPorcentaje($_porcentaje){
        $this->_porcentaje = $_porcentaje;
        return $this;
    }

    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO factura_pago(id_factura_pago, id_factura, id_tipo_pago) VALUES "
             . "(NULL, {$this->_idFactura}, {$this->_idTipoPago})";
        //echo $sql;
        $database->insertar($sql);
    }
    public static function obtenerTodos(){
        $database = new MySQL();
        $sql = "SELECT * FROM tipo_pago";
        $datos = $database->consultar($sql);

        $listadoTipoPago = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$tipoPago = new tipoPago();
			$tipoPago->_idTipoPago = $registro["id_tipo_pago"];
			$tipoPago->_descripcion = $registro["descripcion"];
            $tipoPago->_porcentaje = $registro["porcentaje"];
            $listadoTipoPago[] = $tipoPago;
    	}

    	return $listadoTipoPago;
    }
    public static function obtenerPorIdFactura($idFactura){
        $database = new MySQL();
        $sql = "SELECT * FROM tipo_pago INNER JOIN factura_pago ON tipo_pago.id_tipo_pago = factura_pago.id_tipo_pago "
             . "JOIN factura ON factura.id_factura = factura_pago.id_factura WHERE factura.id_factura = $idFactura";
        //echo $sql;
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();
    	$tipoPago = self::_tipoPago($registro);
		return $tipoPago;

    }
    private static function _tipoPago($datos) {
    	$tipoPago = new tipoPago();
        $tipoPago->_idTipoPago = $datos["id_tipo_pago"];
        $tipoPago->_descripcion = $datos["descripcion"];
        $tipoPago->_porcentaje = $datos["porcentaje"];

		return $tipoPago;
    }
}
?>