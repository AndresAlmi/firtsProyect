<?php

require_once "MySQL.php";
require_once "Persona.php";


class Empleado extends Persona {

	private $_idEmpleado;
	private $_numeroLegajo;
	private $_fechaAlta;
	private $_idTaller;

	public function getIdTaller(){
        return $this->_idTaller;
    }
	public function setIdTaller($_idTaller){
        $this->_idTaller = $_idTaller;
		return $this;
    }


	public function getIdEmpleado() {
		return $this->_idEmpleado;
	}

	public function getNumeroLegajo() {
		return $this->_numeroLegajo;
	}

	public function setNumeroLegajo($numeroLegajo) {
		$this->_numeroLegajo = $numeroLegajo;
	}
	
	public function getFechaAlta(){
		return $this->_fechaAlta;
	}

	public function setFechaAlta($_fechaAlta){
		$this->_fechaAlta = $_fechaAlta;
		return $this;
	}

	public function guardarUsuario() {

		$database = new MySQL();

		$sql = "INSERT INTO empleado "
		     . "(id_empleado, id_persona, fecha_alta) "
		     . "VALUES (NULL, {$this->_idPersona}, '{$this->_fechaAlta}')";
		$database->insertar($sql);

	}

	public function guardar() {
		parent::guardar();

		$database = new MySQL();

		$sql = "INSERT INTO empleado "
		     . "(id_empleado, id_persona, numero_legajo, fecha_alta, id_taller) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_numeroLegajo}, '{$this->_fechaAlta}', '{$this->_idTaller}')";
		echo $sql;
		//exit;
		$database->insertar($sql);

	}

	public function actualizar() {
		parent::actualizar();

		$database = new MySQL();

		$sql = "UPDATE empleado SET numero_legajo = '{$this->_numeroLegajo}', fecha_alta = '{$this->_fechaAlta}', id_taller = '{$this->_idTaller}' "
             . "WHERE empleado.id_empleado = {$this->_idEmpleado}";
		//echo $sql;


        $database->actualizar($sql);

	}

	public static function obtenerTodos() {
    	$sql = "SELECT taller.id_taller, persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, sexo.descripcion, "
             . "persona.fecha_nacimiento, persona.dni, empleado.id_empleado, empleado.numero_legajo, "
			 . "empleado.fecha_alta "
             . "FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona "
			 . "JOIN sexo ON sexo.id_sexo = persona.id_sexo "
			 . "JOIN taller on taller.id_taller = empleado.id_taller "
			 . "WHERE persona.estado = 1";
		//echo $sql;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEmpleados = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$empleado = new Empleado();
			$sexo = new Sexo();
			$empleado->_idEmpleado = $registro["id_empleado"];
			$empleado->_idPersona = $registro["id_persona"];
			$empleado->_numeroLegajo = $registro["numero_legajo"];
			$empleado->_fechaAlta = $registro["fecha_alta"];
			$empleado->_nombre = $registro["nombre"];
			$empleado->_apellido = $registro["apellido"];
			$empleado->_dni = $registro["dni"];
			$empleado->_fechaNacimiento = $registro["fecha_nacimiento"];
			$empleado->_idSexo = $sexo->getDescripcionById($registro["id_sexo"]);
			$empleado->_idTaller= $registro["id_taller"];
    		$listadoEmpleados[] = $empleado;


			
    	}


    	return $listadoEmpleados;
	}

    public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.dni, "
             . "persona.fecha_nacimiento, persona.id_sexo, persona.estado, empleado.id_empleado, "
             . "empleado.fecha_alta, empleado.numero_legajo "
             . "FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona "
             . "WHERE id_empleado=" . $id;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$empleado = self::_crearEmpleado($registro);
		return $empleado;

    }


    public function baja() {
		parent::baja();
    	$sql = "UPDATE persona SET persona.estado = '0' JOIN empleado ON persona.id_persona = empleado.id_persona "
			 . "WHERE empleado.id_empleado = '{$this->_idEmpleado}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

    private static function _crearEmpleado($datos) {
    	$empleado = new Empleado();
		$empleado->_idEmpleado = $datos["id_empleado"];
		$empleado->_idPersona = $datos["id_persona"];
		$empleado->_nombre = $datos["nombre"];
		$empleado->_apellido = $datos["apellido"];
		$empleado->_idSexo = $datos["id_sexo"];
		$empleado->_estado = $datos["estado"];
		$empleado->_fechaNacimiento = $datos["fecha_nacimiento"];
		$empleado->_numeroLegajo = $datos["numero_legajo"];
		$empleado->_fechaAlta = $datos["fecha_alta"];
		$empleado->_dni = $datos["dni"];

		return $empleado;
    }

	public static function obtenerPorIdTallerPorEmpleado($idEmpleado){
		$sql = "SELECT id_taller FROM empleado WHERE id_empleado = $idEmpleado";
		//echo $sql;
        $database = new MySQL();
        $datos = $database->consultar($sql);
		//echo $sql;
    	$registro = $datos->fetch_assoc();


		if($registro > 0){
			return $registro["id_taller"];
		}
	}
	public static function obtenerPorIdPersona($id){
		$sql = "SELECT * FROM empleado JOIN persona ON empleado.id_persona = persona.id_persona Where empleado.id_persona = {$id}";

		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$registro = $datos->fetch_assoc();


		if($registro > 0){
			return $registro["id_empleado"];
		}
	}
}



?>