<?php
require_once "MySQL.php";
require_once "tipoRepuesto.php";
require_once "marcaRepuesto.php";

class repuestos {
    private $_descripcion;
    private $_idRepuesto;
    private $_existencia;
    private $_existenciaMin;
    private $_estado;
    private $_idTipoRepuesto;
    private $_idMarca;

    public function getIdRepuesto(){
        return $this->_idRepuesto;
    }

    public function getDescripcion(){
		return $this->_descripcion;
	}

    public function setDescripcion($_descripcion){
        $this->_descripcion = $_descripcion;
        return $this;
    }
    public function getExistencia(){
        return $this->_existencia;
    }

    public function getExistenciaMin(){
        return $this->_existenciaMin;
    }

    public function setExistencia($_existencia){
        $this->_existencia = $_existencia;
        return $this;
    }


    public function setExistenciaMin($_existenciaMin){
        $this->_existenciaMin = $_existenciaMin;
        return $this;
    }

    public function getIdTipoRepuesto(){
        return $this->_idTipoRepuesto;
    }

    public function setIdTipoRepuesto($_idTipoRepuesto){
        $this->_idTipoRepuesto = $_idTipoRepuesto;
        return $this;
    }
    public function getIdMarca(){
        return $this->_idMarca;
    }
    public function setIdMarca($_idMarca){
        $this->_idMarca = $_idMarca;
        return $this;
    }
    
    public function guardar(){

        $database = new MySQL();

        $sql = "INSERT INTO repuesto "
             . "(id_repuesto, descripcion, id_tipo_repuesto, id_marca) "
             . "VALUES(NULL, '{$this->_descripcion}',{$this->_idTipoRepuesto}, {$this->_idMarca})";
        //echo $sql;
        //exit;
        $idRepuesto = $database->insertar($sql);
        $this->_idRepuesto = $idRepuesto;
        
    }

    public static function cargarRepuestosATalleres($idTaller, $idRepuesto, $existencia, $existenciaMin){
        $database = new MySQL();

		$sql = "INSERT INTO repuesto_taller (id_repuesto_taller, id_taller, id_repuesto, existencia , existencia_minima) "
             . "VALUES(NULL, $idTaller, $idRepuesto, $existencia, $existenciaMin)";
        echo $sql;
        //exit;
		$database->insertar($sql);
    }

    
    public function actualizar(){


		$database = new MySQL();

		$sql = "UPDATE repuesto SET  descripcion = '{$this->_descripcion}', "
             . "id_tipo_repuesto = '{$this->_idTipoRepuesto}', id_marca = '{$this->_idMarca}' "
             . "WHERE repuesto.id_repuesto = {$this->_idRepuesto}";
        $database->actualizar($sql);

        echo $sql;
        $sql = "UPDATE repuesto_taller SET existencia = '{$this->_existencia}', existencia_minima = '{$this->_existenciaMin}' "
             . "WHERE id_repuesto = {$this->_idRepuesto}";
        echo $sql;
        exit;
        $database->actualizar($sql);

    }
    public function actualizarPorTaller($id){


		$database = new MySQL();

		$sql = "UPDATE repuesto SET  descripcion = '{$this->_descripcion}', "
             . "id_tipo_repuesto = '{$this->_idTipoRepuesto}', id_marca = '{$this->_idMarca}' "
             . "WHERE repuesto.id_repuesto = {$this->_idRepuesto}";
        $database->actualizar($sql);

        //echo $sql;
        $sql = "UPDATE repuesto_taller SET existencia = '{$this->_existencia}', existencia_minima = '{$this->_existenciaMin}' "
             . "WHERE id_repuesto = {$this->_idRepuesto} AND id_taller=$id";
        //echo $sql;
        //exit;
        $database->actualizar($sql);

    }


    
    public function baja() {

    	$sql = "UPDATE repuesto SET estado = '0' "
			 . "WHERE id_repuesto = '{$this->_idRepuesto}'";

    	$database = new MySQL();
        $database->baja($sql);
    }
    
    public static function obtenerTodos($filtro = 0){
        $database = new MySQL();

        $sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
             . "sum(repuesto_taller.existencia) as existencia, sum(repuesto_taller.existencia_minima) as existencia_minima, repuesto.descripcion, "
             . "repuesto.estado FROM repuesto "
             . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
             . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
             . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
             . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto "
             . "WHERE repuesto.estado > 0 GROUP BY repuesto.descripcion ORDER BY existencia DESC";
        //echo $sql;
        $datos = $database->consultar($sql);

        $listadoRepuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $repuesto = new repuestos();
            $marca = new marcaRepuesto();
            $repuesto->_idRepuesto = $registro['id_repuesto'];
            $repuesto->_idTipoRepuesto = $registro['id_tipo_repuesto'];
            $repuesto->_idMarca = $registro['id_marca'];
            $repuesto->_descripcion = $registro['descripcion'];
            $repuesto->_existencia = $registro['existencia'];
            $repuesto->_existenciaMin = $registro['existencia_minima'];
            $repuesto->_estado = $registro['estado'];
            
            $listadoRepuestos[] = $repuesto;
        }
    return $listadoRepuestos;
    

    }
    public static function obtenerPorIdTipoRepuesto($idTipo) {
    	$sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
             . "sum(repuesto_taller.existencia) as existencia, sum(repuesto_taller.existencia_minima) as existencia_minima, repuesto.descripcion, "
             . "repuesto.estado FROM repuesto "
             . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
             . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
             . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
             . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto "
             . "WHERE repuesto.estado > 0 AND tipo_repuesto.id_tipo_repuesto = $idTipo";
        $database = new MySQL();
        $datos = $database->consultar($sql);
        echo $sql;
        if ($datos->num_rows == 0) {
        	return false;
        }

        $listadoRepuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $repuesto = new repuestos();
            $marca = new marcaRepuesto();
            $repuesto->_idRepuesto = $registro['id_repuesto'];
            $repuesto->_idTipoRepuesto = $registro['id_tipo_repuesto'];
            $repuesto->_idMarca = $registro['id_marca'];
            $repuesto->_descripcion = $registro['descripcion'];
            $repuesto->_existencia = $registro['existencia'];
            $repuesto->_existenciaMin = $registro['existencia_minima'];
            $repuesto->_estado = $registro['estado'];
            
            $listadoRepuestos[] = $repuesto;
        }
        return $listadoRepuestos;

    }
    public static function obtenerPorIdMarcaYTipoRepuesto($idMarca, $idTipo) {
    	$sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
             . "sum(repuesto_taller.existencia) as existencia, sum(repuesto_taller.existencia_minima) as existencia_minima, repuesto.descripcion, "
             . "repuesto.estado FROM repuesto "
             . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
             . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
             . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
             . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto "
             . "WHERE repuesto.estado > 0 AND marca.id_marca = $idMarca AND tipo_repuesto.id_tipo_repuesto = $idTipo";
        $database = new MySQL();
        $datos = $database->consultar($sql);
        echo $sql;
        if ($datos->num_rows == 0) {
        	return false;
        }

        $listadoRepuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $repuesto = new repuestos();
            $marca = new marcaRepuesto();
            $repuesto->_idRepuesto = $registro['id_repuesto'];
            $repuesto->_idTipoRepuesto = $registro['id_tipo_repuesto'];
            $repuesto->_idMarca = $registro['id_marca'];
            $repuesto->_descripcion = $registro['descripcion'];
            $repuesto->_existencia = $registro['existencia'];
            $repuesto->_existenciaMin = $registro['existencia_minima'];
            $repuesto->_estado = $registro['estado'];
            
            $listadoRepuestos[] = $repuesto;
        }
        return $listadoRepuestos;

    }

    public static function obtenerPorIdRepuesto($id) {
    	$sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
             . "sum(repuesto_taller.existencia) as existencia, sum(repuesto_taller.existencia_minima) as existencia_minima, repuesto.descripcion, "
             . "repuesto.estado FROM repuesto "
             . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
             . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
             . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
             . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto "
             . "WHERE repuesto.id_repuesto = $id";
        $database = new MySQL();
        $datos = $database->consultar($sql);
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$repuesto = self::_crearRepuesto($registro);
		return $repuesto;
    }

    private static function _crearRepuesto($datos) {
        $repuesto = new repuestos();
        $repuesto->_idRepuesto = $datos['id_repuesto'];
        $repuesto->_idTipoRepuesto = $datos['id_tipo_repuesto'];
        $repuesto->_idMarca = $datos['id_marca'];
        $repuesto->_descripcion = $datos['descripcion'];
        $repuesto->_existencia = $datos['existencia'];
        $repuesto->_existenciaMin = $datos['existencia_minima'];
        $repuesto->_estado = $datos['estado'];
            
        return $repuesto;
        
    }
    
    public static function obtenerPorIdTaller($idTaller){
        $database = new MySQL();
        $sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
        . "repuesto_taller.existencia, repuesto_taller.existencia_minima, repuesto.descripcion, "
        . "repuesto.estado FROM repuesto "
        . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
        . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
        . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
        . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto WHERE taller.id_taller = $idTaller";
        $datos = $database->consultar($sql);

        $listadoRepuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $repuesto = new repuestos();
            $marca = new marcaRepuesto();
            $repuesto->_idRepuesto = $registro['id_repuesto'];
            $repuesto->_idTipoRepuesto = $registro['id_tipo_repuesto'];
            $repuesto->_idMarca = $registro['id_marca'];
            $repuesto->_descripcion = $registro['descripcion'];
            $repuesto->_existencia = $registro['existencia'];
            $repuesto->_existenciaMin = $registro['existencia_minima'];
            $repuesto->_estado = $registro['estado'];
            
            $listadoRepuestos[] = $repuesto;
        }
        return $listadoRepuestos;


        }
    
    public static function descontarStock($idRepuesto, $descontar, $idTaller){

        $database = new MySQL();
        $sql = "SELECT existencia FROM repuesto_taller WHERE id_repuesto = $idRepuesto and id_taller = '$idTaller'";
        
        $datos = $database->consultar($sql);
        $stockActual = 0;
        while ($registro = $datos->fetch_assoc()) {
            $stockActual = new repuestos();
			$stockActual = $registro["existencia"];
    	}

        $stockActual = $stockActual - $descontar;
        
        $sql = "UPDATE repuesto_taller SET existencia = $stockActual WHERE id_repuesto = $idRepuesto and id_taller = $idTaller";
        $database->actualizar($sql);
    }
    
    public static function sumarStock($idRepuesto, $cantidad, $idTaller){

        $database = new MySQL();
        $sql = "SELECT existencia FROM repuesto_taller WHERE id_repuesto = $idRepuesto and id_taller = $idTaller";

        $datos = $database->consultar($sql);
        $stockActual = 0;
        while ($registro = $datos->fetch_assoc()) {
            $stockActual = new repuestos();
			$stockActual = $registro["existencia"];
    	}

        $stockActual = $stockActual + $cantidad;
        
        $sql = "UPDATE repuesto_taller SET existencia = $stockActual WHERE id_repuesto = $idRepuesto and id_taller = $idTaller";
        
        $database->actualizar($sql);
    }

    public static function obtenerPorIdRepuestoYIdTaller($idRepuesto, $idTaller){
        $database = new MySQL();
        $sql = "SELECT taller.id_taller, repuesto_taller.id_repuesto_taller, repuesto.id_repuesto, marca.id_marca, tipo_repuesto.id_tipo_repuesto, "
        . "repuesto_taller.existencia, repuesto_taller.existencia_minima, repuesto.descripcion, "
        . "repuesto.estado FROM repuesto "
        . "INNER JOIN repuesto_taller ON repuesto_taller.id_repuesto = repuesto.id_repuesto "
        . "INNER JOIN taller ON taller.id_taller = repuesto_taller.id_taller "
        . "INNER JOIN marca ON marca.id_marca = repuesto.id_marca "
        . "INNER JOIN tipo_repuesto ON tipo_repuesto.id_tipo_repuesto = repuesto.id_tipo_repuesto WHERE taller.id_taller = $idTaller and repuesto.id_repuesto=$idRepuesto";
        $datos = $database->consultar($sql);
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$repuesto = self::_crearRepuesto($registro);
		return $repuesto;
    }
    
}

?>