<?php

require_once "MySQL.php";
require_once "Sexo.php";
class Persona {

    protected $_idPersona;
    protected $_nombre;
    protected $_apellido;
    protected $_fechaNacimiento;
    protected $_estado;
    protected $_dni;
    protected $_idSexo;

    public function getIdPersona()
    {
        return $this->_idPersona;
    }


    public function setIdPersona($_idPersona)
    {
        $this->_idPersona = $_idPersona;

        return $this;
    }

    public function getDni() {
		return $this->_dni;
	}

    public function setDni($_dni){
        $this->_dni = $_dni;
        return $this;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }


    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }


    public function getApellido()
    {
        return $this->_apellido;
    }


    public function setApellido($_apellido)
    {
        $this->_apellido = $_apellido;

        return $this;
    }


    public function getFechaNacimiento()
    {
        return $this->_fechaNacimiento;
    }

    public function setFechaNacimiento($_fechaNacimiento)
    {
        $this->_fechaNacimiento = $_fechaNacimiento;

        return $this;
    }


    public function getEstado()
    {
        return $this->_estado;
    }


    public function setEstado($_estado)
    {
        $this->_estado = $_estado;
        return $this;
    }



    public function setSexo($_idSexo)
    {
        $this->_idSexo = $_idSexo;
        return $this;
    }

    public function getIdSexo() {
        return $this->_idSexo;
    }

    public function obtenerSexo($_idSexo){
        $Sexo = new Sexo();
        return $Sexo->getDescripcionByID($_idSexo);
    }
    
    public function guardar() {
        $database = new MySQL();

        $sql = "INSERT INTO persona "
             . "(id_persona, nombre, apellido, dni, fecha_nacimiento, id_sexo) "
             . "VALUES (NULL, '{$this->_nombre}', '{$this->_apellido}', '{$this->_dni}', "
             . "'{$this->_fechaNacimiento}', {$this->_idSexo}) ";

        $idPersona = $database->insertar($sql);
        $this->_idPersona = $idPersona;
    }

    public function actualizar() {
        $sql = "UPDATE persona SET nombre = '{$this->_nombre}', apellido = '{$this->_apellido}', "
             . "fecha_nacimiento = '{$this->_fechaNacimiento}', dni = '{$this->_dni}', "
             . "id_sexo = {$this->_idSexo} "
             . "WHERE persona.id_persona = {$this->_idPersona}";
        echo $sql;
        $database = new MySQL();
        $database->actualizar($sql);
    }

    /*public function eliminar() {

        $sql = "DELETE FROM persona WHERE id_persona={$this->_idPersona}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }*/

    public function baja() {

        $sql = "UPDATE persona SET estado = '0' where id_persona ={$this->_idPersona}";
        
        $database = new MySQL();
        $database->baja($sql);

    }

    public function __toString() {
        return "{$this->_apellido}, {$this->_nombre}";
    }
}


?>