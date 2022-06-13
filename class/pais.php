<?php
require_once "MySQL.php";

class pais{
    private $_idPais;
    private $_descripcion;
    
    public function getIdPais(){
        return $this->_idPais;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM pais ";
        $database = new MySQL();
        $datos = $database->consultar($sql);
    
    
        $listadoPais = [];

        while ($registro = $datos->fetch_assoc()) {
            $pais = new pais();
            $pais->_idPais = $registro["id_pais"];
            $pais->_descripcion = $registro["descripcion"];
            $listadoPais[] = $pais;
        }


        return $listadoPais;
    }
}

?>