<?php
require_once "MySQL.php";

class proveedor{
    private $_idProveedor;
    private $_fechaAlta;
    private $_nombre;


    public function getIdProveedor(){
        return $this->_idProveedor;
    }

    public function setIdProveedor($_idProveedor){
		$this->_idProveedor = $_idProveedor;
		return $this;
	}

    public function getNombre(){
        return $this->_nombre;
    }

    public function setNombre($_nombre){
        $this->_nombre = $_nombre;
        return $this;
    }

    public function getFechaAlta(){
		return $this->_fechaAlta;
	}

	public function setFechaAlta($_fechaAlta){
		$this->_fechaAlta = $_fechaAlta;
		return $this;
	}




    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO proveedor(id_proveedor, nombre, fecha_alta) VALUE(NULL, '{$this->_nombre}', '{$this->_fechaAlta}')";
        $idProveedor = $database->insertar($sql);
        $this->_idProveedor = $idProveedor;
    }
    public static function obtenerTodos(){
        $database = new MySQL();
        $sql = "SELECT * FROM proveedor";
        $datos = $database->consultar($sql);

        $listadoProveedores = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$proveedor = new proveedor();
			$proveedor->_idProveedor = $registro["id_proveedor"];
			$proveedor->_fechaAlta = $registro["fecha_alta"];
			$proveedor->_nombre = $registro["nombre"];
    		$listadoProveedores[] = $proveedor;
    	}


    	return $listadoProveedores;
	}

    public static function obtenerPorId($id){
        $database = new MySQL();
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = $id";
        $datos = $database->consultar($sql);
        $registro = $datos->fetch_assoc();
    	$proveedor = self::_crearproveedor($registro);
		return $proveedor;

    }

    private static function _crearproveedor($datos) {
    	$proveedor = new proveedor();
        $proveedor->_idProveedor = $datos["id_proveedor"];
        $proveedor->_fechaAlta = $datos["fecha_alta"];
        $proveedor->_nombre = $datos["nombre"];

		return $proveedor;
    }

    
}

?>