<?php

require_once "MySQL.php";
require_once "marca.php";

class modelo extends marca{
    protected $_idModelo;
    protected $_descripcionModelo;

    
    public function getIdModelo(){
        return $this->_idModelo;
    }

    public function setIdModelo($_idModelo){
        $this->_idModelo = $_idModelo;
        return $this;
    }

    public function getDescripcionModelo(){
        return $this->_descripcionModelo;
    }

    public function setDescripcionModelo($_descripcionModelo){
        $this->_descripcionModelo = $_descripcionModelo;
        return $this;
    }

    public function guardar(){
        $database = new MySQL();

		$sql = "INSERT INTO modelo_vehiculo(id_modelo_vehiculo, id_marca_vehiculo, descripcion) "
             . "VALUE(NULL, {$this->_idMarca}, '{$this->_descripcionModelo}')";

        $database->insertar($sql);
    }
    public function actualizar(){

        $database = new MySQL();

		$sql = "UPDATE modelo_vehiculo SET descripcion = '{$this->_descripcionModelo}', id_marca_vehiculo = '{$this->_idMarca}' "
             . "WHERE id_modelo_vehiculo = {$this->_idModelo}";

        $database->actualizar($sql);
    }

    public function eliminar(){
        $database = new MySQL();
        $sql = "DELETE FROM modelo_vehiculo WHERE id_modelo_vehiculo = {$this->_idModelo}";
        $database->eliminar($sql);
    }

    public static function obtenerTodos(){
        $sql = "SELECT modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, marca_vehiculo.id_marca_vehiculo, marca_vehiculo.descripcion AS descripcionM "
             . "FROM modelo_vehiculo INNER JOIN marca_vehiculo ON marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo " ;
        
        $database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoModelo = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$modelo = new modelo();
			$modelo->_idModelo = $registro["id_modelo_vehiculo"];
            $modelo->_idMarca = $registro["id_marca_vehiculo"];
			$modelo->_descripcionModelo = $registro["descripcion"];
            $modelo->_descripcionMarca = $registro["descripcionM"];

            $listadoModelo[] = $modelo;
    	}


    	return $listadoModelo;
    }

	public static function obtenerPorIdMarca($idMarca) {

		$sql = "SELECT modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, marca_vehiculo.id_marca_vehiculo "
             . "FROM modelo_vehiculo INNER JOIN marca_vehiculo ON marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo "
			 . "WHERE modelo_vehiculo.id_marca_vehiculo = {$idMarca}";

		$databse = new MySQL();
		$datos = $databse->consultar($sql);

        $listadoModelo = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$modelo = new modelo();
			$modelo->_idModelo = $registro["id_modelo_vehiculo"];
            $modelo->_idMarca = $registro["id_marca_vehiculo"];
			$modelo->_descripcionModelo = $registro["descripcion"];

            $listadoModelo[] = $modelo;
    	}


    	return $listadoModelo;
    }

    public static function obtenerPorModeloPorIdVehiculo($idVehiculo) {

		$sql = "SELECT modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, vehiculo.id_vehiculo "
             . "FROM modelo_vehiculo INNER JOIN vehiculo ON vehiculo.id_modelo_vehiculo = modelo_vehiculo.id_modelo_vehiculo "
			 . "WHERE vehiculo.id_vehiculo = {$idVehiculo}";
        //echo $sql;
		$databse = new MySQL();
		$datos = $databse->consultar($sql);

        $registro = $datos->fetch_assoc();
    	$modelo = self::_crearModelo1($registro);
		return $modelo;

    }
    private static function _crearModelo1($datos) {
        $modelo = new modelo();
        $modelo->_idModelo = $datos["id_modelo_vehiculo"];
        $modelo->_descripcionModelo = $datos["descripcion"];

		return $modelo;
    }
    public static function obtenerPorId($idModelo) {

		$sql = "SELECT * FROM modelo_vehiculo WHERE id_modelo_vehiculo = {$idModelo}";

		$database = new MySQL();
		$datos = $database->consultar($sql);
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$modelo = self::_crearModelo($registro);
		return $modelo;

    }
    private static function _crearModelo($datos) {
        $modelo = new modelo();
        $modelo->_idMarca = $datos["id_marca_vehiculo"];
        $modelo->_idModelo = $datos["id_modelo_vehiculo"];
        $modelo->_descripcionModelo = $datos["descripcion"];

		return $modelo;
    }


}

?>