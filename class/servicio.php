<?php

require_once "MySQL.php";
require_once "tipoServicio.php";
class Servicio {

    private $_idServicio;
    private $_descripcion;
    private $_duracion;
    private $_precioServicio;
    private $_idTipoServicio;
    private $_estado;

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }
    public function getIdServicio(){
        return $this->_idServicio;
    }

    public function getIdTipoServicio(){
        return $this->_idTipoServicio;
    }

    public function setIdTipoServicio($_idTipoServicio){
        $this->_idTipoServicio = $_idTipoServicio;
        return $this;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setDescripcion($_descripcion){
        $this->_descripcion = $_descripcion;
        return $this;
    }

    public function getDuracion(){
        return $this->_duracion;
    }

    public function setDuracion($_duracion){
        $this->_duracion = $_duracion;
        return $this;
    }

    public function getPrecio(){
        return $this->_precioServicio;
    }

    public function setPrecioServicio($_precioServicio){
        $this->_precioServicio = $_precioServicio;
        return $this;
    }

    public function obtenerTipoServicio($_idTipoServicio){
        $tipoServicio = new tipoServicio();
        return $tipoServicio->getDescripcionByID($_idTipoServicio);
    }
	public static function obtenerServicioPorId($_idServicio){
		$sql = "SELECT * FROM servicio Where id_servicio = {$_idServicio}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoSexo = [];
    	$registro = $datos->fetch_assoc();


		return $registro["descripcion"];

	}
    public function guardar() {
        $database = new MySQL();

        $sql = "INSERT INTO servicio "
             . "(id_servicio, descripcion, precio_servicio, duracion, id_tipo_servicio) "
             . "VALUES (NULL, '{$this->_descripcion}', '{$this->_precioServicio}', '{$this->_duracion}', '{$this->_idTipoServicio}')";
        //echo $sql;
        //exit;
        $idServicio = $database->insertar($sql);
        $this->_idServicio = $idServicio;
    }

    public function actualizar(){
        $sql = "UPDATE servicio SET descripcion = '{$this->_descripcion}', precio_servicio = {$this->_precioServicio}, "
             . "duracion = {$this->_duracion} "
             . "WHERE servicio.id_servicio = {$this->_idServicio}";

        $database = new MySQL();
        $database->actualizar($sql);
    }

    public function eliminar() {

        $sql = "UPDATE servicio SET estado = 0 "
            .  "WHERE servicio.id_servicio = {$this->_idServicio}";

        $database = new MySQL();
        $database->baja($sql);

    }

    public static function obtenerTodos() {
    	$sql = "SELECT * FROM servicio where estado = 1";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoservicios = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$servicio = new servicio();
            $tipoServicio = new tipoServicio();
			$servicio->_idServicio = $registro["id_servicio"];
            $servicio->_descripcion = $registro["descripcion"];
            $servicio->_duracion = $registro["duracion"];
            $servicio->_precioServicio = $registro["precio_servicio"];
            $servicio->_estado = $registro["estado"];
            $servicio->_idTipoServicio = $tipoServicio->getDescripcionById($registro["id_tipo_servicio"]);

    		$listadoservicios[] = $servicio;	
    	}


    	return $listadoservicios;
	}

    public static function obtenerPorId($id) {
        $sql = "SELECT id_servicio, descripcion, precio_servicio, duracion FROM servicio WHERE id_servicio= " . $id;

        $database = new mysql();
        $datos = $database->consultar($sql);


        if($datos == false || $datos->num_rows==0){ return false;}

        $registro = $datos->fetch_assoc();
        $servicio = self::_crearservicio($registro);
        return $servicio;
    }

    private static function _crearservicio($datos) {
        $servicio = new Servicio();
        $servicio->_idServicio = $datos["id_servicio"];
        $servicio->_descripcion = $datos["descripcion"];
        $servicio->_precioServicio = $datos["precio_servicio"];
        $servicio->_duracion = $datos["duracion"];


        return $servicio;
    }
    
    

}



?>
