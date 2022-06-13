<?php
require_once "MySQL.php";

class localidad{
    private $_idLocalidad;
    private $_descripcion;
    private $_idProvincia;
    

    public function getIdLocalidad(){
        return $this->_idLocalidad;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function getIdProvincia(){
        return $this->_idProvincia;
    }

    public static function obtenerTodos(){
        $sql = "SELECT id_localidad, descripcion, id_provincia FROM Localidad ";

        $database = new MySQL();
        $datos = $database->consultar($sql);
    
    
        $listadoLocalidad = [];

        while ($registro = $datos->fetch_assoc()) {
            $localidad = new localidad();
            $localidad->_idLocalidad = $registro["id_localidad"];
            $localidad->_descripcion = $registro["descripcion"];
            $localidad->_idProvincia = $registro["id_provincia"];
            $listadoLocalidad[] = $localidad;
        }


        return $listadoLocalidad;
    }

    public static function obtenerPorIdProvincia($id){
        $sql = "SELECT id_provincia, id_localidad, descripcion FROM localidad WHERE id_provincia = {$id} ";
        echo $sql;
        
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadolocalidad = [];
        
        while ($registro = $datos->fetch_assoc()) {
	    	$localidad = new localidad();
            //$marca = new marcaRepuesto();
            $localidad->_idProvincia = $registro["id_provincia"];
			$localidad->_idLocalidad = $registro["id_localidad"];
			$localidad->_descripcion = $registro["descripcion"];
  
            $listadolocalidad[] = $localidad;
    	}


    	return $listadolocalidad;
    }
}


?>