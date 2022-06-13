<?php

require_once "MySQL.php";


class tipoServicio {

	private $_idTipoServicio; 
	private $_descripcion;

    public function getIdTipoServicio()
    {
        return $this->_idTipoServicio;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

	public function setDescripcion($_descripcion){
		$this->_descripcion = $_descripcion;
	}
	public function getDescripcionById($_idTipoServicio){
		$sql = "SELECT * FROM tipo_servicio Where id_tipo_servicio = {$_idTipoServicio}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoTipoServicio = [];
    	$registro = $datos->fetch_assoc();


		return $registro["descripcion"];

	}

	public function guardar(){
		$database = new MySQL();
		$sql = "INSERT INTO tipo_servicio(descripcion) VALUE ('{$this->_descripcion}')";

		$database->insertar($sql);
	}
	public static function obtenerTodos() {

    	$sql = "SELECT * FROM tipo_servicio ";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);
		//echo $sql;
    	$listadoTipoServicio = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$TipoServicio = new tipoServicio();
			$TipoServicio->_idTipoServicio = $registro["id_tipo_servicio"];
			$TipoServicio->_descripcion = $registro["descripcion"];
    		$listadoTipoServicio[] = $TipoServicio;
    	}


    	return $listadoTipoServicio;

	}

	public function tipo_servicio($id){
		$sql = "delete from tipo_servicio where id_tipo_servicio = {$id}";
		$database = new MySQL();
		$database->eliminar();
	}
}


?>