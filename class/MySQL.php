<?php


class MySQL {

	private $_conexion;

	public function __construct() {
		$this->_conexion = new mysqli("localhost", "root", "", "proyectoSS");
	}

	public function consultar($sql) {
		$datos = $this->_conexion->query($sql);
		return $datos;
	}

	public function insertar($sql) {
		$datos = $this->_conexion->query($sql);
		return $this->_conexion->insert_id;
	}

	public function actualizar($sql) {
		$this->_conexion->query($sql);
	}

	public function eliminar($sql) {
		$this->_conexion->query($sql);
	}

	public function baja($sql) {
		$datos = $this->_conexion->query($sql);
		return $this->_conexion->insert_id;
	}
}


?>