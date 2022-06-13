<?php
require_once "cliente.php";
require_once "MySQL.php";
require_once "modelo.php";

class vehiculo extends modelo{
    private $_idVehiculo;
    private $_anio;
    private $_matricula;
    private $_color;
    private $_estado;
    private $_idCliente;

    public function getIdVehiculo(){
        return $this->_idVehiculo;
    }

    public function getIdCliente(){
        return $this->_idCliente;
    }

    public function setIdCliente($_idCliente){
        $this->_idCliente = $_idCliente;
        return $this;
    }
    
    public function setIdMarca($_idMarca){
        $this->_idMarca = $_idMarca;
        return $this;
    }

    public function setIdModelo($_idModelo){
        $this->_idModelo = $_idModelo;
        return $this;
    }

    public function getAnio(){
        return $this->_anio;
    }

    public function setAnio($_anio){
        $this->_anio = $_anio;
        return $this;
    }

    public function getMatricula(){
        return $this->_matricula;
    }

    public function setMatricula($_matricula){
        $this->_matricula = $_matricula;
        return $this;
    }

    public function getColor(){
        return $this->_color;
    }

    public function setColor($_color){
        $this->_color = $_color;
        return $this;
    }

	public function obtenerNombrePorId($_idVehiculo){
		$sql = "SELECT modelo_vehiculo.descripcion FROM vehiculo JOIN modelo_vehiculo "
             . "ON modelo_vehiculo.id_modelo_vehiculo = vehiculo.id_modelo_vehiculo Where id_vehiculo = {$_idVehiculo}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoSexo = [];
    	$registro = $datos->fetch_assoc();

        if($registro != null){
            return $registro["descripcion"];

        }

	}

	public function guardar() {

		$database = new MySQL();
        $sql = "select * from vehiculo";

        $datos = $database->consultar($sql);

        $id = 0;
    	while ($registro = $datos->fetch_assoc()) {
	    	$vehiculo = new vehiculo();
    		$id = $registro["id_vehiculo"];
    	}
        $id = $id + 1;

		$sql = "INSERT INTO vehiculo(id_vehiculo, matricula, color, anio, id_modelo_vehiculo, id_cliente) "
             . "VALUE ($id, '{$this->_matricula}', '{$this->_color}', '{$this->_anio}', '{$this->_idModelo}', '{$this->_idCliente}')";
		//echo $sql;
        //exit;
        $database->insertar($sql);

	}

    
	public function actualizar() {

		$database = new MySQL();

		$sql = "UPDATE vehiculo SET matricula = '{$this->_matricula}', "
             . "color = '{$this->_color}', anio = '{$this->_anio}', id_modelo_vehiculo = '{$this->_idModelo}' "
             . "WHERE vehiculo.id_vehiculo = {$this->_idVehiculo}";

        $database->actualizar($sql);
    }
    public function baja() {
    	$sql = "UPDATE vehiculo SET vehiculo.estado = '0' "
			 . "WHERE vehiculo.id_vehiculo = '{$this->_idVehiculo}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

	public static function obtenerTodos() {
    	$sql = "SELECT vehiculo.id_vehiculo, vehiculo.matricula, vehiculo.color, modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, "
             . "marca_vehiculo.id_marca_vehiculo, marca_vehiculo.descripcion as descripcionM, cliente.id_cliente, vehiculo.anio "
             . "FROM VEHICULO JOIN CLIENTE "
             . "ON vehiculo.id_cliente = cliente.id_cliente "
             . "JOIN modelo_vehiculo on vehiculo.id_modelo_vehiculo = modelo_vehiculo.id_modelo_vehiculo "
             . "JOIN marca_vehiculo on marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo "
             . "WHERE vehiculo.estado = 1";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoVehiculo = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$vehiculo = new vehiculo();
            $marca = new marca();
            $modelo = new modelo();
            $cliente = new cliente();
			$vehiculo->_idVehiculo = $registro["id_vehiculo"];
			$vehiculo->_idCliente = $registro["id_cliente"];
			$vehiculo->_anio = $registro["anio"];
			$vehiculo->_idModelo = $registro["id_modelo_vehiculo"];
            $vehiculo->_matricula = $registro["matricula"];
            $vehiculo->_color = $registro["color"];
            $vehiculo->_idMarca = $registro["id_marca_vehiculo"];
            $vehiculo->_descripcionMarca = $registro["descripcionM"];
            $vehiculo->_descripcionModelo = $registro["descripcion"];
            $listadoVehiculo[] = $vehiculo;
    	}


    	return $listadoVehiculo;
	}

    public static function obtenerPorMatricula($matricula) {
    	$sql = "SELECT vehiculo.id_vehiculo, vehiculo.matricula, vehiculo.color, modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, "
        . "marca_vehiculo.id_marca_vehiculo, marca_vehiculo.descripcion as descripcionM, cliente.id_cliente, vehiculo.anio, vehiculo.estado "
        . "FROM VEHICULO JOIN CLIENTE "
        . "ON vehiculo.id_cliente = cliente.id_cliente "
        . "JOIN modelo_vehiculo on vehiculo.id_modelo_vehiculo = modelo_vehiculo.id_modelo_vehiculo "
        . "JOIN marca_vehiculo on marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo "
        . "WHERE vehiculo.matricula = '$matricula'";
        //echo $sql;
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows >= 1) {
        	return false;
            exit;
        }else{
            return true;
            exit;
        }
    }
    public static function obtenerPorId($id) {
    	$sql = "SELECT vehiculo.id_vehiculo, vehiculo.matricula, vehiculo.color, modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, "
        . "marca_vehiculo.id_marca_vehiculo, marca_vehiculo.descripcion as descripcionM, cliente.id_cliente, vehiculo.anio, vehiculo.estado "
        . "FROM VEHICULO JOIN CLIENTE "
        . "ON vehiculo.id_cliente = cliente.id_cliente "
        . "JOIN modelo_vehiculo on vehiculo.id_modelo_vehiculo = modelo_vehiculo.id_modelo_vehiculo "
        . "JOIN marca_vehiculo on marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo "
        . "WHERE vehiculo.id_vehiculo = " . $id;

        //echo $sql;
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$vehiculo = self::_crearVehiculo($registro);
		return $vehiculo;
    }


    private static function _crearVehiculo($datos) {
        $vehiculo = new vehiculo();
        $vehiculo->_idVehiculo = $datos["id_vehiculo"];
        $vehiculo->_idCliente = $datos["id_cliente"];
        $vehiculo->_anio = $datos["anio"];
        $vehiculo->_estado = $datos["estado"];
        $vehiculo->_idModelo = $datos["id_modelo_vehiculo"];
        $vehiculo->_matricula = $datos["matricula"];
        $vehiculo->_color = $datos["color"];
        $vehiculo->_idMarca = $datos["id_marca_vehiculo"];
        $vehiculo->_descripcionMarca = $datos["descripcionM"];
        $vehiculo->_descripcionModelo = $datos["descripcion"];

		return $vehiculo;
    }

    public static function obtenerPorIdCliente($idCliente) {
    	$sql = "SELECT vehiculo.id_vehiculo, vehiculo.matricula, vehiculo.color, modelo_vehiculo.id_modelo_vehiculo, modelo_vehiculo.descripcion, "
             . "marca_vehiculo.id_marca_vehiculo, marca_vehiculo.descripcion as descripcionM, cliente.id_cliente, vehiculo.anio "
             . "FROM VEHICULO JOIN CLIENTE "
             . "ON vehiculo.id_cliente = cliente.id_cliente "
             . "JOIN modelo_vehiculo on vehiculo.id_modelo_vehiculo = modelo_vehiculo.id_modelo_vehiculo "
             . "JOIN marca_vehiculo on marca_vehiculo.id_marca_vehiculo = modelo_vehiculo.id_marca_vehiculo "
             . "WHERE cliente.id_cliente = {$idCliente} and estado = 1";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoVehiculo = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$vehiculo = new vehiculo();
            $marca = new marca();
            $modelo = new modelo();
			$vehiculo->_idVehiculo = $registro["id_vehiculo"];
			$vehiculo->_idCliente = $registro["id_cliente"];
			$vehiculo->_anio = $registro["anio"];
			$vehiculo->_idModelo = $registro["id_modelo_vehiculo"];
            $vehiculo->_matricula = $registro["matricula"];
            $vehiculo->_color = $registro["color"];
            $vehiculo->_idMarca = $registro["id_marca_vehiculo"];
            $vehiculo->_descripcionMarca = $registro["descripcionM"];
            $vehiculo->_descripcionModelo = $registro["descripcion"];
            $listadoVehiculo[] = $vehiculo;
    	}


    	return $listadoVehiculo;
	}

}

?>