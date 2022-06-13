<?php

require_once "MySQL.php";


class tipoRepuesto{

	private $_idTipoRepuesto;
    private $_descripcionM;

	public function getIdTipoRepuesto(){
		return $this->_idTipoRepuesto;
	}

	public function getDescripcionM(){
		return $this->_descripcionM;
	}

    public function setDescripcionM($_descripcionM){
        $this->_descripcionM = $_descripcionM;
        return $this;
    }

    public function guardar(){
        $database = new MySQL();

		$sql = "INSERT INTO tipo_repuesto(id_tipo_repuesto, descripcion) "
             . "VALUE(NULL, '{$this->_descripcionM}')";
        echo $sql;
        //exit;

        $database->insertar($sql);
    }
    public function actualizar(){

        $database = new MySQL();

		$sql = "UPDATE tipo_repuesto SET descripcion = '{$this->_descripcionM}' "
             . "WHERE id_tipo_repuesto = {$this->_idTipoRepuesto}";
        //echo $sql;
        //exit;
        $database->actualizar($sql);
    }

    public function eliminar(){
        $database = new MySQL();
        $sql = "DELETE FROM";
    }

    public static function ObtenerTodos(){

        
        $database = new MySQL();
        $sql = "SELECT id_tipo_repuesto, descripcion FROM tipo_repuesto";

        $database->consultar($sql);
        $datos = $database->consultar($sql);


        $listadoTipoRepuesto = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$tipoRepuesto = new tipoRepuesto();
			$tipoRepuesto->_idTipoRepuesto = $registro["id_tipo_repuesto"];
			$tipoRepuesto->_descripcionM = $registro["descripcion"];

    		$listadoTipoRepuesto[] = $tipoRepuesto;
    	}


    	return $listadoTipoRepuesto;
    }

	public static function obtenerPorId($idTipoRepuesto) {

		$sql = "SELECT * FROM tipo_repuesto WHERE id_tipo_repuesto = {$idTipoRepuesto}";

		$database = new MySQL();
		$datos = $database->consultar($sql);
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$tipoRepuesto = self::_crearTipoRepuesto($registro);
		return $tipoRepuesto;

    }
    private static function _crearTipoRepuesto($datos) {
        $tipoRepuesto = new tipoRepuesto();
        $tipoRepuesto->_idTipoRepuesto = $datos["id_tipo_repuesto"];
        $tipoRepuesto->_descripcionM = $datos["descripcion"];

		return $tipoRepuesto;
    }
}
?>