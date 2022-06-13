<?php
require_once "MySQL.php";

class repuestoProveedor{
    private $_idRepuestoProveedor;
    private $_cantidad;
    private $_fecha;
    private $_idRepuesto;
    private $_idProveedor;
    private $_precio;
    private $_total;
    private $_estado; 

    public function getEstado (){
        return $this->_estado;
    }
	
    public function setEstado($_estado){
        $this->_estado = $_estado;
    }
    public function getIdRepuestoProveedor(){
        return $this->_idRepuestoProveedor;
    }
    public function getCantidad(){
        return $this->_cantidad;
    }

    public function setCantidad($_cantidad){
        $this->_cantidad = $_cantidad;
        return $this;
    }

    public function getPrecio(){
        return $this->_precio;
    }

    public function setPrecio($_precio){
        $this->_precio = $_precio;
        return $this;
    }

    public function getFecha(){
		return $this->_fecha;
	}

	public function setFecha($_fecha){
		$this->_fecha = $_fecha;
		return $this;
	}
    public function getIdRepuesto(){
        return $this->_idRepuesto;
    }

    public function setIdRepuesto($_idRepuesto){
		$this->_idRepuesto = $_idRepuesto;
		return $this;
	}

    public function getIdProveedor(){
        return $this->_idProveedor;
    }

    public function setIdProveedor($_idProveedor){
		$this->_idProveedor = $_idProveedor;
		return $this;
	}


    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO repuesto_proveedor(id_repuesto_proveedor, id_repuesto, id_proveedor, cantidad, fecha) "
             . "VALUES(NULL, {$this->_idRepuesto}, {$this->_idProveedor}, {$this->_cantidad}, '{$this->_fecha}')";
        echo $sql;
        $idRepuestoProveedor = $database->insertar($sql);
        $this->_idRepuestoProveedor = $idRepuestoProveedor;
    }
    
    public static function cambiarEstado($estado, $idProveedor, $idRepuesto, $cantidad){
        $database = new MySQL();
        $sql = "UPDATE repuesto_proveedor SET estado = $estado "
             . "WHERE id_proveedor = $idProveedor AND cantidad=$cantidad AND id_repuesto = $idRepuesto";
        $database->actualizar($sql);
    }

    public static function obtenerPorIdYFecha($id, $fecha){
        $database = new MySQL();
        $sql = "SELECT * FROM repuesto_proveedor WHERE id_proveedor = $id and fecha = '$fecha'";
        $datos = $database->consultar($sql);
        $listadoRepuestoProveedor = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$repuestoProveedor = new repuestoProveedor();
            $repuestoProveedor->_idRepuestoProveedor = $registro["id_repuesto_proveedor"];
            $repuestoProveedor->_idRepuesto = $registro["id_repuesto"];
            $repuestoProveedor->_idProveedor = $registro["id_proveedor"];
            $repuestoProveedor->_cantidad = $registro["cantidad"];
            $repuestoProveedor->_fecha = $registro["fecha"];
            $repuestoProveedor->_estado = $registro["estado"];
    		$listadoRepuestoProveedor[] = $repuestoProveedor;
    	}


    	return $listadoRepuestoProveedor;
	}

    public static function obtenerTodos(){
        $database = new MySQL();
        $sql = "SELECT id_repuesto_proveedor, id_proveedor, estado, sum(cantidad) as cantidad, fecha "
             . "FROM repuesto_proveedor GROUP BY id_proveedor, fecha";
        //echo $sql;
        $datos = $database->consultar($sql);
        $listadoRepuestoProveedor = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$repuestoProveedor = new repuestoProveedor();
            $repuestoProveedor->_idRepuestoProveedor = $registro["id_repuesto_proveedor"];
            $repuestoProveedor->_idProveedor = $registro["id_proveedor"];
            $repuestoProveedor->_cantidad = $registro["cantidad"];
            $repuestoProveedor->_fecha = $registro["fecha"];
            $repuestoProveedor->_estado = $registro["estado"];
    		$listadoRepuestoProveedor[] = $repuestoProveedor;
    	}


    	return $listadoRepuestoProveedor;
	}
}
?>