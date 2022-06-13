<?php
require_once "MySQL.php";

class domicilio{
    protected $_idDomicilio;
    protected $_idBarrio;
    protected $_calle;
    protected $_altura;
    protected $_manzana;
    protected $_torre;
    protected $_piso;
    protected $_numCasa;

    public function getIdDomicilio(){
        return $this->_idDomicilio;
    }

    public function setIdDomicilio($_idDomicilio){
        $this->_idDomicilio = $_idDomicilio;
        return $this;
    }
    public function getIdBarrio(){
        return $this->_idBarrio;
    }

    public function setIdBarrio($_idBarrio){
        $this->_idBarrio = $_idBarrio;
        return $this;
    }

    public function getCalle(){
        return $this->_calle;
    }

    public function setCalle($_calle){
        $this->_calle = $_calle;
        return $this;
    }

    public function getAltura(){
        return $this->_altura;
    }

    public function setAltura($_altura){
        $this->_altura = $_altura;
        return $this;
    }

    public function getManzana(){
        return $this->_manzana;
    }

    public function setManzana($_manzana){
        $this->_manzana = $_manzana;
        return $this;
    }

    public function getTorre(){
        return $this->_torre;
    }

    public function setTorre($_torre){
        $this->_torre = $_torre;
        return $this;
    }

    public function getPiso(){
        return $this->_piso;
    }

    public function setPiso($_piso){
        $this->_piso = $_piso;
        return $this;
    }

    public function getNumCasa(){
        return $this->_numCasa;
    }

    public function setNumCasa($_numCasa){
        $this->_numCasa = $_numCasa;
        return $this;
    }

    public function getDescripcionById($_idBarrio){
		$sql = "SELECT * FROM barrio Where id_barrio = {$_idBarrio}";
		$database = new MySQL();
    	$datos = $database->consultar($sql);
    	$listadoBarrio = [];
    	$registro = $datos->fetch_assoc();
		return $registro["descripcion"];
	}

    /*public function obtenerTodo(){
        $sql = "SELECT * FROM domicilio";

        $database = new MySQL();
        $datos=$database->consultar();
    }*/

    public function guardar(){
        $database = new MySQL();
        $sql = "INSERT INTO domicilio(id_domicilio, id_barrio, calle, altura, manzana, torre, piso, num_casa) "
             . "VALUE(NULL, {$this->_idBarrio}, '{$this->_calle}', '{$this->_altura}', '{$this->_manzana}', "
             . "'{$this->_torre}', '{$this->_piso}', '{$this->_numCasa}')";

        $_idDomicilio = $database->insertar($sql);
        $this->_idDomicilio = $_idDomicilio;
    }

}

?>