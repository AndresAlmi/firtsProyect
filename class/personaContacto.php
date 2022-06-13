<?php

require_once "MySQL.php";
require_once "tipoContacto.php";


class personaContacto {

	private $_idPersonaContacto;
	private $_idPersona;
	private $_idTipoContacto;
	private $_valor;
	private $_descripcion;


	public function getIdPersonaContacto() {
		return $this->_idPersonaContacto;
	}

	public function getDescripcion(){
		return $this->_descripcion;
	}

	public function setDescripcion($_descripcion){
		$this->_descripcion = $_descripcion;
		return $this;
	}

	public function getIdPersona() {
		return $this->_idPersona;
	}

	public function setIdPersona($_idPersona) {
		$this->_idPersona = $_idPersona;
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
		$sql = "INSERT INTO contacto_persona "
		     . "(id_contacto_persona, id_persona, id_tipo_contacto, valor) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_idTipoContacto}, '{$this->_valor}')";


       	$database = new MySQL();
        $idInsertado = $database->insertar($sql);

    	$this->_idPersonaContacto = $idInsertado;
	}


	public static function obtenerPorIdPersona($id) {
		$sql = "SELECT tipo_contacto.id_tipo_contacto as tipo_contacto_id, tipo_contacto.descripcion, contacto_persona.id_contacto_persona, "
			 . "contacto_persona.id_persona, contacto_persona.id_tipo_contacto, contacto_persona.valor "
			 . "FROM tipo_contacto INNER JOIN contacto_persona ON tipo_contacto.id_tipo_contacto = contacto_persona.id_tipo_contacto "
		     . "WHERE contacto_persona.id_persona= ". $id;

		//exit;

        $database = new MySQL();
        $datos = $database->consultar($sql);
    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new personaContacto();
			$tipoContacto = new tipoContacto();
			$contacto->_descripcion = $tipoContacto->getDescripcionById($registro["id_tipo_contacto"]);
			$contacto->_idPersonaContacto = $registro["id_contacto_persona"];
			$contacto->_idPersona = $registro["id_persona"];
			$contacto->_idTipoContacto = $registro["tipo_contacto_id"];
			$contacto->_valor = $registro["valor"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}


	public static function obtenerPorIdPersonaCont($id) {
    	$sql = "SELECT contacto_persona.id_contacto_persona, contacto_persona.id_persona, contacto_persona.id_tipo_contacto, "
			 . "contacto_persona.valor, tipo_contacto.descripcion FROM contacto_persona "
			 . "JOIN tipo_contacto on contacto_persona.id_tipo_contacto = tipo_contacto.id_tipo_contacto "
			 . "WHERE contacto_persona.id_contacto_persona =". $id;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$contactoPersona = self::_crearContactoPersona($registro);
		return $contactoPersona;

    }

    public function eliminar() {
		$database = new MySQL();
		$sql = "DELETE FROM contacto_persona WHERE id_contacto_persona = {$this->_idPersonaContacto} ";
        $database->eliminar($sql);
    }

    private static function _crearContactoPersona($datos) {
    	$contacto = new personaContacto();
		$contacto->_idPersonaContacto = $datos["id_contacto_persona"];
		$contacto->_idPersona = $datos["id_persona"];
		$contacto->_idTipoContacto = $datos["id_tipo_contacto"];
		$contacto->_valor = $datos["valor"];
		$contacto->_descripcion = $datos["descripcion"];

		return $contacto;
    }

}

?>