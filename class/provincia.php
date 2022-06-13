<?php
require_once "MySQL.php";

class provincia{
    private $_idProvincia;
    private $_descripcion;
    private $_idPais;
    
    public function getIdProvincia(){
        return $this->_idProvincia;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function getIdPais(){
        return $this->_idPais;
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM provincia ";
        $database = new MySQL();
        $datos = $database->consultar($sql);
    
    
        $listadoprovincia = [];

        while ($registro = $datos->fetch_assoc()) {
            $provincia = new provincia();
            $provincia->_idPais = $registro["id_pais"];
            $provincia->_idProvincia = $registro["id_provincia"];
            $provincia->_descripcion = $registro["descripcion"];
            $listadoprovincia[] = $provincia;
        }


        return $listadoprovincia;
    }

    public static function obtenerPorIdPais($id){
        $sql = "SELECT id_pais, id_provincia, descripcion FROM provincia WHERE id_pais = {$id} ";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoprovincia = [];
        
        while ($registro = $datos->fetch_assoc()) {
	    	$provincia = new provincia();
            //$marca = new marcaRepuesto();
            $provincia->_idPais = $registro["id_pais"];
			$provincia->_idProvincia = $registro["id_provincia"];
			$provincia->_descripcion = $registro["descripcion"];
  
            $listadoprovincia[] = $provincia;
    	}


    	return $listadoprovincia;
    }
}


?>