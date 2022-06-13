<?php

require_once "Modulo.php";
require_once "MySQL.php";


class Perfil {

	private $_idPerfil;
	private $_descripcion;
	private $_listadoModulos;
	private $_estado;

	public function getIdPerfil(){
		return $this->_idPerfil;
	}

	public function setIdPerfil($_idPerfil){
		$this->_idPerfil = $_idPerfil;
		return $this;
	}

	public function getDescripcion(){
		return $this->_descripcion;
	}

	public function setDescripcion($_descripcion){
		$this->_descripcion = $_descripcion;
		return $this;
	}

	public function getModulos() {
		return $this->_listadoModulos;
	}

	public function getEstado(){
		return $this->_estado;
	}

	public function guardar(){
		$database = new MySQL();
		$sql = "INSERT INTO perfil(id_perfil, descripcion) VALUE(NULL, '{$this->_descripcion}') ";
		
		$idPerfil = $database->insertar($sql);
		$this->_idPerfil = $idPerfil;
		
	}

	public function actualizar() {
		$database = new mysql();

		$sql = "UPDATE perfil SET descripcion = '{$this->_descripcion}'"
             . "WHERE perfil.id_perfil = {$this->_idPerfil}";


        $database->actualizar($sql);

	}
	
	public function eliminar(){
		$database = new MySQL();
		$sql = "DELETE FROM perfil WHERE id_perfil = {$this->_idPerfil} ";
        $database->eliminar($sql);
	}

	public static function obtenerTodos(){
		$sql = "SELECT * FROM perfil where estado = 1";
		$database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoPerfil = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$perfil = new perfil();
			$perfil->_idPerfil = $registro["id_perfil"];
			$perfil->_descripcion = $registro["descripcion"];
            $perfil->_estado = $registro["estado"];
    		$listadoPerfil[] = $perfil;
    	}


    	return $listadoPerfil;
	}
	public static function obtenerPorId($idPerfil) {
		$sql = "SELECT * FROM perfil WHERE id_perfil={$idPerfil}";

		$database = new MySQL();
		$datos = $database->consultar($sql);
		//echo $sql;
		$registro = $datos->fetch_assoc();

		$perfil = new Perfil();
		$perfil->_idPerfil = $registro["id_perfil"];
		$perfil->_descripcion = $registro["descripcion"];
		$perfil->_listadoModulos = Modulo::obtenerPorIdPerfil($perfil->_idPerfil);

		return $perfil;
	}

}


?>