<?php
require_once "MySQL.php";

class barrio{
    private $_idLocalidad;
    private $_descripcion;
    private $_idBarrio;
    

    public function getIdLocalidad(){
        return $this->_idLocalidad;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function getIdBarrio(){
        return $this->_idBarrio;
    }

    /*public static function obtenerTodos(){
        $sql = "SELECT id_localidad, descripcion, id_provincia FROM Localidad ";

        $database = new MySQL();
        $datos = $database->consultar($sql);
    
    
        $listadoBarrio = [];

        while ($registro = $datos->fetch_assoc()) {
            $localidad = new localidad();
            $localidad->_idLocalidad = $registro["id_localidad"];
            $localidad->_descripcion = $registro["descripcion"];
            $localidad->_idProvincia = $registro["id_provincia"];
            $listadoBarrio[] = $localidad;
        }


        return $listadoBarrio;
    }*/

    public static function obtenerPorIdLocalidad($id){
        $sql = "SELECT id_localidad, id_barrio, descripcion FROM barrio WHERE id_localidad = {$id} ";
        echo $sql;
        
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoBarrio = [];
        
        while ($registro = $datos->fetch_assoc()) {
	    	$barrio = new barrio();
            //$marca = new marcaRepuesto();
            $barrio->_idBarrio = $registro["id_barrio"];
			$barrio->_idLocalidad = $registro["id_localidad"];
			$barrio->_descripcion = $registro["descripcion"];
  
            $listadoBarrio[] = $barrio;
    	}


    	return $listadoBarrio;
    }
}


?>