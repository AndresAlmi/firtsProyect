<?php

require_once "MySQL.php";


Class TipoContacto{
    private $_idTipoContacto;
    private $_Descripcion;

    public function getIdTipoContacto(){
        return $this->_idTipoContacto;
    }

    public function getDescripcion(){
        return $this->_Descripcion;
    }

    public function getDescripcionById($_idTipoContacto){
        $sql = "SELECT * FROM tipo_contacto Where id_tipo_contacto = {$_idTipoContacto}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoTipoContacto = [];
    	$registro = $datos->fetch_assoc();


		return $registro["descripcion"];

    }

    public static function obtenerTodos(){

        $sql="SELECT id_tipo_contacto, descripcion FROM tipo_contacto";
        $database = new Mysql();
        $datos = $database->consultar($sql);

        $listadoTipoContacto =[];

        while($registro = $datos->fetch_assoc()){
            $tipoContacto = new tipoContacto();
            $tipoContacto->_idTipoContacto = $registro ["id_tipo_contacto"];
            $tipoContacto->_Descripcion = $registro ["descripcion"];
            $listadoTipoContacto[]=$tipoContacto;
        }

        return $listadoTipoContacto;

    }


}
    
?>