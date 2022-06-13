<?php

require_once "MySQL.php";
require_once "Persona.php";


class cliente extends Persona {

	private $_idcliente;
	private $_fechaAlta;
	private $_tipoCliente;

	public function getIdcliente() {
		return $this->_idcliente;
	}

	public function setIdPersona($_idPersona){
		$this->_idPersona = $_idPersona;
		return $this;
	}
	public function getFechaAlta(){
		return $this->_fechaAlta;
	}

	public function setFechaAlta($_fechaAlta){
		$this->_fechaAlta = $_fechaAlta;
		return $this;
	}

	public function getTipoCliente(){
		return $this->_tipoCliente;
	}

	public function setTipoCliente($_tipoCliente){
		$this->_tipoCliente = $_tipoCliente;
		return $this;
	}


	public function guardar() {
		parent::guardar();

		$database = new MySQL();

		$sql = "INSERT INTO cliente "
		     . "(id_cliente, id_persona, fecha_alta) "
		     . "VALUES (NULL, {$this->_idPersona}, '{$this->_fechaAlta}')";

		$database->insertar($sql);

	}

	public function guardarUsuario() {

		$database = new MySQL();

		$sql = "INSERT INTO cliente "
		     . "(id_cliente, id_persona, fecha_alta) "
		     . "VALUES (NULL, {$this->_idPersona}, '{$this->_fechaAlta}')";
		$database->insertar($sql);

	}
	public function actualizar() {
		parent::actualizar();

		$database = new MySQL();

		$sql = "UPDATE cliente SET fecha_alta = '{$this->_fechaAlta}', tipo_cliente = '{$this->_tipoCliente}' "
             . "WHERE cliente.id_cliente = {$this->_idcliente}";


        $database->actualizar($sql);

	}

	public static function obtenerTodos() {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, "
             . "persona.fecha_nacimiento, persona.dni, cliente.id_cliente, cliente.fecha_alta, cliente.tipo_cliente, sexo.descripcion "
             . "FROM cliente "
             . "JOIN persona ON persona.id_persona = cliente.id_persona "
			 . "JOIN sexo ON sexo.id_sexo = persona.id_sexo "
			 . "WHERE persona.estado = 1";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoclientes = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$cliente = new cliente();
			$sexo = new sexo();
			$cliente->_idcliente = $registro["id_cliente"];
			$cliente->_idPersona = $registro["id_persona"];
			$cliente->_fechaAlta = $registro["fecha_alta"];
			$cliente->_nombre = $registro["nombre"];
			$cliente->_apellido = $registro["apellido"];
			$cliente->_dni = $registro ["dni"];
			$cliente->_fechaNacimiento = $registro["fecha_nacimiento"];
			$cliente->_tipoCliente = $registro["tipo_cliente"];
			$cliente->_idSexo = $sexo->getDescripcionById($registro["id_sexo"]);
    		$listadoclientes[] = $cliente;
    	}


    	return $listadoclientes;
	}

    public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.dni, "
             . "persona.fecha_nacimiento, persona.id_sexo, persona.estado, cliente.id_cliente, "
             . "cliente.fecha_alta, cliente.tipo_cliente "
             . "FROM cliente "
             . "JOIN persona ON persona.id_persona = cliente.id_persona "
             . "WHERE id_cliente=" . $id;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$cliente = self::_crearcliente($registro);
		return $cliente;

    }

	public static function obtenerPorIdPersona($id){
		$sql = "SELECT * FROM cliente JOIN persona ON cliente.id_persona = persona.id_persona Where cliente.id_persona = {$id}";

		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoSexo = [];
    	$registro = $datos->fetch_assoc();


		if($registro > 0){
			return $registro["id_cliente"];
		}
	}

    public function baja() {
		parent::baja();
    	$sql = "UPDATE persona SET persona.estado = '0' JOIN cliente ON persona.id_persona = cliente.id_persona "
			 . "WHERE cliente.id_cliente = '{$this->_idCliente}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

    private static function _crearcliente($datos) {
    	$cliente = new cliente();
		$cliente->_idcliente = $datos["id_cliente"];
		$cliente->_idPersona = $datos["id_persona"];
		$cliente->_nombre = $datos["nombre"];
		$cliente->_apellido = $datos["apellido"];
		$cliente->_idSexo = $datos["id_sexo"];
		$cliente->_estado = $datos["estado"];
		$cliente->_tipoCliente = $datos["tipo_cliente"];
		$cliente->_fechaNacimiento = $datos["fecha_nacimiento"];
		$cliente->_fechaAlta = $datos["fecha_alta"];
		$cliente->_dni = $datos["dni"];

		return $cliente;
    }

}



?>