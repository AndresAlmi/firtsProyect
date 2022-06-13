<?php

require_once "MySQL.php";

class color{
    private $_nombre;
    private $_idColor;

    public function getIdColor(){
        return $this->_idColor; 
    }

    public function getNombre(){
        return $this->_nombre;
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM color ";
        $database = new MySQL();
    	$datos = $database->consultar($sql);
        
        $listadoColor = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$color = new color();
			$color->_idColor = $registro["id_color"];
			$color->_nombre = $registro["descripcion"];
            $listadoColor[] = $color;
    	}


    	return $listadoColor;
    }


}

?>