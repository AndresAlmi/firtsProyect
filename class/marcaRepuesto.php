<?php

require_once "MySQL.php";


class MarcaRepuesto {

	private $_idMarca;
    private $_descripcionMa;

	public function getIdMarca() {
		return $this->_idMarca;
	}


	public function getDescripcionMa(){
		return $this->_descripcionMa;
	}

    public function setDescripcionMa($_descripcionMa){
        $this->_descripcionMa = $_descripcionMa;
        return $this;
    }

	public static function getMarcaByID($_idMarca){
		$sql = "SELECT * FROM marca Where id_marca = {$_idMarca}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$registro = $datos->fetch_assoc();
    	$marca = self::_crearMarca($registro);
		return $marca;
	}

	public function guardar(){
		$database = new MySQL();
		$sql = "INSERT INTO marca(id_marca, descripcion) VALUES(NULL, '{$this->_descripcionMa}')";

		$database->insertar($sql);
	}

	public function actualizar(){
		$database = new MySQL();
		$sql = "UPDATE marca SET descripcion = '{$this->_descripcionMa}' WHERE id_marca = {$this->_idMarca}";
		$database->actualizar($sql);
	}

	public static function obtenerTodos() {
    	$sql = "SELECT id_marca, descripcion FROM marca";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoMarca = [];

    	while ($registro = $datos->fetch_assoc()) {
			$marcaRepuesto = new MarcaRepuesto();
	    	$marcaRepuesto->_idMarca = $registro["id_marca"];
			$marcaRepuesto->_descripcionMa = $registro["descripcion"];
			$listadoMarca[] = $marcaRepuesto;
    	}


    	return $listadoMarca;
	}
	public static function obtenerPorIdMarca($idMarca) {
    	$sql = "SELECT id_marca, descripcion FROM marca WHERE id_marca = {$idMarca}";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$marcaRepuesto = self::_crearMarca($registro);
		return $marcaRepuesto;

    }

	private static function _crearMarca($datos) {
    	$marcaRepuesto = new MarcaRepuesto();
		$marcaRepuesto->_idMarca = $datos["id_marca"];
		$marcaRepuesto->_descripcionMa = $datos["descripcion"];
	
		return $marcaRepuesto;
    }
}
?>