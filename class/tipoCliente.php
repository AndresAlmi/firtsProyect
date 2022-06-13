<?php

require_once "MySQL.php";

class tipoCliente{
    private $_idTipoCliente;
    private $_descripcion;

    public function getTipoCliente(){
        return $this->_idTipoCliente; 
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM tipo_cliente ";
        $database = new MySQL();
    	$datos = $database->consultar($sql);
        
        $listadoTipoCliente = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$tipoCliente = new tipoCliente();
			$tipoCliente->_idTipoCliente = $registro["id_tipo_cliente"];
			$tipoCliente->_descripcion = $registro["descripcion"];
            $listadoTipoCliente[] = $tipoCliente;
    	}


    	return $listadoTipoCliente;
    }


}

?>