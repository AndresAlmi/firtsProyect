<?php

require_once "MySQL.php";


class Sexo {

	private $_idSexo; 
	private $_descripcion;

    public function getIdSexo()
    {
        return $this->_idSexo;
    }

    public function getDescripcion()
    {
        return $this->_descripcion;
    }

	public function getDescripcionById($_idSexo){
		$sql = "SELECT * FROM sexo Where id_sexo = {$_idSexo}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoSexo = [];
    	$registro = $datos->fetch_assoc();


		return $registro["descripcion"];

	}
	public static function obtenerTodos() {

    	$sql = "SELECT * FROM sexo";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoSexo = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$sexo = new Sexo();
			$sexo->_idSexo = $registro["id_sexo"];
			$sexo->_descripcion = $registro["descripcion"];
    		$listadoSexo[] = $sexo;
    	}


    	return $listadoSexo;

	}
}


?>