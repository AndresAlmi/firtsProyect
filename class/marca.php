<?php

require_once "MySQL.php";

class marca{
    protected $_idMarca;
    protected $_descripcionMarca;


    public function getIdMarca(){
        return $this->_idMarca;
    }
    public function setIdMarca($_idMarca){
        $this->_idMarca = $_idMarca;
        return $this;
    }

    public function getDescripcionMarca(){
        return $this->_descripcionMarca;
    }

    public function setDescripcionMarca($_descripcionMarca){
        $this->_descripcionMarca = $_descripcionMarca;
        return $this;
    }


    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO marca_vehiculo(id_marca_vehiculo, descripcion) VALUE(NULL, '{$this->_descripcionMarca}')";
        $database->insertar($sql);
    }

    public function actualizar(){

        $database = new MySQL();

		$sql = "UPDATE marca_vehiculo SET descripcion = '{$this->_descripcionMarca}' "
             . "WHERE id_marca_vehiculo = {$this->_idMarca}";
        $database->actualizar($sql);
    }
    
    public function eliminar(){
        $database = new MySQL();
        $sql = "DELETE FROM marca_vehiculo WHERE id_marca_vehiculo = {$this->_idMarca}";
        $database->eliminar($sql);
    }
    public static function obtenerTodos(){
        $sql = "SELECT id_marca_vehiculo, descripcion as descripcionM FROM marca_vehiculo" ;
        $database = new MySQL();
    	$datos = $database->consultar($sql);

        $listadoMarca = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$marca = new marca();
			$marca->_idMarca = $registro["id_marca_vehiculo"];
			$marca->_descripcionMarca = $registro["descripcionM"];
            $listadoMarca[] = $marca;
    	}

    	return $listadoMarca;
    }


    public static function obtenerPorId($idMarca){
        $sql = "SELECT id_marca_vehiculo, descripcion as descripcionM FROM marca_vehiculo where id_marca_vehiculo = {$idMarca}" ;
        $database = new MySQL();
    	$datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$marca = self::_crearMarca($registro);
		return $marca;

    }

    private static function _crearMarca($datos) {
        $marca = new marca();
        $marca->_idMarca = $datos["id_marca_vehiculo"];
        $marca->_descripcionMarca = $datos["descripcionM"];

		return $marca;
    }
}

?>