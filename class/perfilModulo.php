<?php

require_once "MySQL.php";

class perfilModulo{
    private $_idPerfilModulo;
    private $_idModulo;
    private $_idPerfil;

    public function getIdPerfilModulo(){
        return $this->_idPerfilModulo;
    }
    
    public function getIdModulo(){
        return $this->_idModulo;
    }
    public function setIdModulo($_idModulo){
        $this->_idModulo = $_idModulo;
        return $this; 
    }
    public function getIdPerfil(){
        return $this->_idPerfil;
    }
    public function setIdPerfil($_idPerfil){
        $this->_idPerfil = $_idPerfil;
        return $this;
    }

    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO perfil_modulo(id_perfil_modulo, id_perfil, id_modulo) "
             . "VALUES (NULL, '{$this->_idPerfil}','{$this->_idModulo}')";

        $idPerfilModulo = $database->insertar($sql);
        $this->_idPerfilModulo = $idPerfilModulo;
    }


    public function actualizar(){
        $database = new MySQL();
        $sql = "UPDATE perfil_modulo SET id_modulo = '{$this->_idModulo}' "
             . "WHERE id_perfil_modulo = {$this->_idPerfilModulo}";


        $database->actualizar($sql);
    }
    public static function obtenerTodos(){
        $sql = "select * from perfil_modulo ";
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPerfilModulo = [];

        while ($registro = $datos->fetch_assoc()) {
            $pefilModulo = new perfilModulo();
            $pefilModulo->_idPerfilModulo = $registro["id_perfil_modulo"];
            $pefilModulo->_idPerfil = $registro["id_perfil"];
            $pefilModulo->_idModulo = $registro["id_modulo"];
            $listadoPerfilModulo[] = $pefilModulo;
        }


        return $listadoPerfilModulo;
    }

    public static function obtenerPorIdPerfil($idPerfil){
        $sql = "select * from perfil_modulo WHERE id_perfil = ". $idPerfil;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$perfilModulo = self::_crearPerfilModulo($registro);
		return $perfilModulo;

    }

    public static function obtenerPorId($idPerfilModulo) {
    	$sql = "select * from perfil_modulo WHERE id_perfil_modulo = ". $idPerfilModulo;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$perfilModulo = self::_crearPerfilModulo($registro);
		return $perfilModulo;

    }

    public function eliminar() {
		$database = new MySQL();
		$sql = "DELETE FROM perfil_modulo WHERE id_perfil = {$this->_idPerfil} ";
        echo $sql;
        $database->eliminar($sql);
    }

    private static function _crearPerfilModulo($datos) {
    	$perfilModulo = new perfilModulo();
		$perfilModulo->_idPerfilModulo = $datos["id_perfil_modulo"];
		$perfilModulo->_idPerfil = $datos["id_perfil"];
		$perfilModulo->_idModulo = $datos["id_modulo"];
		return $perfilModulo;
    }


}

?>