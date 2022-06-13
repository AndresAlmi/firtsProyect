<?php

require_once "MySQL.php";
require_once "tipoContacto.php";


class tallerContacto {

	private $_idTallerContacto;
	private $_idTaller;
	private $_idTipoContacto;
	private $_valor;
	private $_descripcion;


	public function getIdTallerContacto() {
		return $this->_idTallerContacto;
	}

	public function getDescripcion(){
		return $this->_descripcion;
	}

	public function setDescripcion($_descripcion){
		$this->_descripcion = $_descripcion;
		return $this;
	}

	public function getIdTaller() {
		return $this->_idPersona;
	}

	public function setIdTaller($_idTaller) {
		$this->_idTaller = $_idTaller;
	}

	public function getIdTipoContacto(){
		return $this->_idTipoContacto;
	}

	public function setIdTipoContacto($_idTipoContacto) {
		$this->_idTipoContacto = $_idTipoContacto;
	}

	public function getValor() {
		return $this->_valor;
	}

	public function setValor($valor) {
		$this->_valor = $valor;
	}

	public function guardar() {
		$sql = "INSERT INTO contacto_taller "
		     . "(id_contacto_taller, id_taller, id_tipo_contacto, valor) "
		     . "VALUES (NULL, {$this->_idTaller}, {$this->_idTipoContacto}, '{$this->_valor}')";


       	$database = new MySQL();
        $idInsertado = $database->insertar($sql);

    	$this->_idTallerContacto = $idInsertado;
	}


	public static function obtenerPorIdTaller($id) {
		$sql = "SELECT tipo_contacto.id_tipo_contacto as tipo_contacto_id, tipo_contacto.descripcion, contacto_taller.id_contacto_taller, "
			 . "contacto_taller.id_taller, contacto_taller.id_tipo_contacto, contacto_taller.valor "
			 . "FROM tipo_contacto INNER JOIN contacto_taller ON tipo_contacto.id_tipo_contacto = contacto_taller.id_tipo_contacto "
		     . "WHERE contacto_taller.id_taller= ". $id;

		//exit;


        $database = new MySQL();
        $datos = $database->consultar($sql);
    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new tallerContacto();
			$tipoContacto = new tipoContacto();
			$contacto->_descripcion = $tipoContacto->getDescripcionById($registro["id_tipo_contacto"]);
			$contacto->_idTallerContacto = $registro["id_contacto_taller"];
			$contacto->_idTaller = $registro["id_taller"];
			$contacto->_idTipoContacto = $registro["tipo_contacto_id"];
			$contacto->_valor = $registro["valor"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}


	public static function obtenerPorIdTallerCont($id) {
    	$sql = "SELECT contacto_Taller.id_contacto_taller, contacto_Taller.id_taller, contacto_Taller.id_tipo_contacto, "
			 . "contacto_Taller.valor, tipo_contacto.descripcion FROM contacto_Taller "
			 . "JOIN tipo_contacto on contacto_Taller.id_tipo_contacto = tipo_contacto.id_tipo_contacto "
			 . "WHERE contacto_Taller.id_contacto_Taller =". $id;
        
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$contactoTaller = self::_crearContactoTaller($registro);
		return $contactoTaller;

    }

    public function eliminar() {
		$database = new MySQL();
		$sql = "DELETE FROM contacto_taller WHERE id_contacto_taller = {$this->_idTallerContacto} ";

        $database->eliminar($sql);
    }

    private static function _crearContactoTaller($datos) {
    	$contacto = new tallerContacto();
		$contacto->_idTallerContacto = $datos["id_contacto_taller"];
		$contacto->_idTaller = $datos["id_taller"];
		$contacto->_idTipoContacto = $datos["id_tipo_contacto"];
		$contacto->_valor = $datos["valor"];
		$contacto->_descripcion = $datos["descripcion"];

		return $contacto;
    }

}

?>