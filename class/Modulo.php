<?php


require_once "MySQL.php";


class Modulo {

	private $_idModulo;
	private $_descripcion;
	private $_directorio;
	private $_nivel;
	private $_orden;
	private $_estado;
	private $_hijoDe;

	public function GetIdModulo()
    {
        return $this->_idModulo;
    }

    public function getDescripcion()
    {
        return $this->_descripcion;
    }

	public function setDescripcion($_descripcion){
		$this->_descripcion = $_descripcion;
		return $this;
	}
    public function getDirectorio()
    {
        return $this->_directorio;
    }

	public function setDirectorio($_directorio){
		$this->_directorio = $_directorio;
		return $this;
	}
	public function getEstado(){
		return $this->_estado;
	}

	public function setEstado($_estado){
		$this->_estado = $_estado;
		return $this;
	}
	public function getNivel(){
		return $this->_nivel;
	}

	public function setNivel($_nivel){
		$this->_nivel = $_nivel;
		return $this;
	}
	public function getOrden(){
		return $this->_orden;
	}

	public function setOrden($_orden){
		$this->_orden = $_orden;
		return $this;
	}
	public function getHijoDe(){
		return $this->_hijoDe;
	}

	public function setHijoDe($_hijoDe){
		$this->_hijoDe = $_hijoDe;
		return $this;
	}

	public function baja() {
    	$sql = "UPDATE modulo SET estado = '0' "
			 . "WHERE id_modulo = '{$this->_idModulo}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

	public function guardar(){
		$database = new MySQL();

		$sql = "INSERT INTO modulo "
		     . "(id_modulo, descripcion, directorio) "
		     . "VALUES (NULL, '{$this->_descripcion}', '{$this->_directorio}')";
		echo $sql;
		$database->insertar($sql);
	}

	public function actualizar(){
		$database = new MySQL();

		$sql = "UPDATE modulo SET directorio = '{$this->_directorio}', descripcion = '{$this->_descripcion}' "
             . "WHERE id_modulo = {$this->_idModulo}";


        $database->actualizar($sql);

	}

	public static function obtenerTodos(){
		$sql = "SELECT * FROM modulo WHERE estado = 1";
		//echo $sql;
		$database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoModulo = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$modulo = new modulo();
			$modulo->_idModulo = $registro["id_modulo"];
			$modulo->_descripcion = $registro["descripcion"];
            $modulo->_directorio = $registro["directorio"];
			$modulo->_nivel = $registro["nivel"];
			$modulo->_orden = $registro["orden"];
			$modulo->_estado = $registro["estado"];
			$modulo->_hijoDe = $registro["hijoDe"];
    		$listadoModulo[] = $modulo;
    	}


    	return $listadoModulo;
    }
	
	public static function obtenerPorId($id) {
    	$sql = "SELECT * from modulo "
             . "WHERE id_modulo = " . $id;
	
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$modulo = self::_crearModulo($registro);
		return $modulo;
    }


    private static function _crearModulo($datos) {
    	$modulo = new modulo();
		$modulo->_idModulo = $datos["id_modulo"];
		$modulo->_descripcion = $datos["descripcion"];
		$modulo->_directorio = $datos["directorio"];
        $modulo->_estado = $datos["estado"];

		return $modulo;
    }


	public static function obtenerPorIdPerfil($idPerfil) {

		$sql = "SELECT modulo.id_modulo, modulo.descripcion, modulo.directorio, modulo.orden, modulo.nivel, modulo.hijoDe "
			 . "FROM modulo "
			 . "JOIN perfil_modulo ON perfil_modulo.id_modulo = modulo.id_modulo "
			 . "JOIN perfil ON perfil.id_perfil = perfil_modulo.id_perfil "
			 . "WHERE perfil_modulo.id_perfil = {$idPerfil} "
			 . "ORDER BY orden ASC";
		//ECHO $sql;

		$databse = new MySQL();
		$datos = $databse->consultar($sql);

		$listadoModulos = [];

		while ($registro = $datos->fetch_assoc()) {
			$modulo = new Modulo();
			$modulo->_idModulo = $registro["id_modulo"];
			$modulo->_descripcion = $registro["descripcion"];
			$modulo->_directorio = $registro["directorio"];
			$modulo->_nivel = $registro["nivel"];
			$modulo->_orden = $registro["orden"];
			$modulo->_hijoDe = $registro["hijoDe"];
			$listadoModulos[] = $modulo;
    	}

    	return $listadoModulos;

	}




}


?>