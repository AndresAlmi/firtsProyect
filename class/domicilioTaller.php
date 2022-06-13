<?php

require_once "MySQL.php";
require_once "domicilio.php";
require_once "taller.php";

class domicilioTaller extends domicilio{

    private $_idDomicilioTaller;
    private $_estado;
    private $_idTaller;

    public function getIdDomicilioTaller(){
        return $this->_idDomicilioTaller;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }
    public function getIdTaller(){
        return $this->_idTaller;
    }

    public function setIdTaller($_idTaller){
        $this->_idTaller = $_idTaller;
        return $this;
    }

    public function guardar(){
        parent::guardar();
        
        $database = new MySQL();

		$sql = "INSERT INTO domicilio_taller "
		     . "(id_domicilio_taller, id_taller, id_domicilio) "
		     . "VALUES (NULL, {$this->_idTaller}, {$this->_idDomicilio})";

		$database->insertar($sql);
    }

    public function actualizar(){

        $database = new MySQL();

        $sql = "UPDATE domicilio SET id_barrio = {$this->_idBarrio}, calle = '{$this->_calle}', altura = '{$this->_altura}', "
             . "manzana = '{$this->_manzana}', torre = '{$this->_torre}', piso = '{$this->_piso}', num_casa = '{$this->_numCasa}' "
             . "WHERE id_domicilio = {$this->_idDomicilio}";

        $database->actualizar($sql);
    }


    public static function obtenerPorIdtaller($id){
        $sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_taller.id_taller, domicilio_taller.id_domicilio as domicilio_id, domicilio_taller.id_domicilio_taller, domicilio_taller.estado "
             . "FROM domicilio INNER JOIN domicilio_taller ON domicilio.id_domicilio = domicilio_taller.id_domicilio "
             . "WHERE domicilio_taller.id_taller = $id and domicilio_taller.estado = 1";

        //echo $sql;
		$databse = new MySQL();
		$datos = $databse->consultar($sql);

        $listadoDomiciliotaller = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$domicilioTaller = new domicilioTaller();
            $domicilio = new domicilio();
            $domicilioTaller->_estado = $registro["estado"];
			$domicilioTaller->_idDomicilioTaller = $registro['id_domicilio_taller'];
            $domicilioTaller->_idTaller = $registro["id_taller"];
			$domicilioTaller->_idDomicilio = $registro["id_domicilio"];
			$domicilioTaller->_idBarrio = $domicilio->getDescripcionById($registro["id_barrio"]);
			$domicilioTaller->_calle = $registro["calle"];
			$domicilioTaller->_altura = $registro["altura"];
			$domicilioTaller->_manzana = $registro["manzana"];
			$domicilioTaller->_torre = $registro["torre"];
			$domicilioTaller->_piso = $registro["piso"];
			$domicilioTaller->_numCasa = $registro["num_casa"];
            $listadoDomiciliotaller[] = $domicilioTaller;
    	}


    	return $listadoDomiciliotaller;
    }


    public static function obtenerPorIdtallerIdDomicilio($id, $idDomicilio) {
    	$sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_taller.id_taller, domicilio_taller.id_domicilio as domicilio_id, domicilio_taller.id_domicilio_taller "
             . "FROM domicilio INNER JOIN domicilio_taller ON domicilio.id_domicilio = domicilio_taller.id_domicilio "
             . "WHERE domicilio_taller.id_taller = {$id} and domicilio_taller.id_domicilio = {$idDomicilio} ";


        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
            
        }

        $registro = $datos->fetch_assoc();
    	$domicilioTaller = self::_CrearIdtallerIdDomicilio($registro);
		return $domicilioTaller;

    }

    public function baja() {

    	$sql = "UPDATE domicilio_taller SET estado = '0' WHERE id_domicilio_taller = '{$this->_idDomicilioTaller}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

    private static function _CrearIdtallerIdDomicilio($datos) {
        $domicilioTaller = new domicilioTaller();
        $domicilio = new domicilio();
        $domicilioTaller->_idDomicilioTaller = $datos['id_domicilio_taller'];
        $domicilioTaller->_idTaller = $datos["id_taller"];
        $domicilioTaller->_idDomicilio = $datos["id_domicilio"];
        $domicilioTaller->_idBarrio = $domicilio->getDescripcionById($datos["id_barrio"]);
        $domicilioTaller->_calle = $datos["calle"];
        $domicilioTaller->_altura = $datos["altura"];
        $domicilioTaller->_manzana = $datos["manzana"];
        $domicilioTaller->_torre = $datos["torre"];
        $domicilioTaller->_piso = $datos["piso"];
        $domicilioTaller->_numCasa = $datos["num_casa"];

		return $domicilioTaller;
    }

    public static function obtenerPorIdtallerDomicilio($idtallerDomicilio) {
    	$sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_taller.id_taller, domicilio_taller.id_domicilio as domicilio_id, domicilio_taller.id_domicilio_taller "
             . "FROM domicilio INNER JOIN domicilio_taller ON domicilio.id_domicilio = domicilio_taller.id_domicilio "
             . "WHERE domicilio_taller.id_domicilio_taller = {$idtallerDomicilio} ";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$domicilioTaller = self::_CreartallerDomicilio($registro);
		return $domicilioTaller;

    }

    private static function _CreartallerDomicilio($datos) {
        $domicilioTaller = new domicilioTaller();
        $domicilio = new domicilio();
        $domicilioTaller->_idDomicilioTaller = $datos['id_domicilio_taller'];
        $domicilioTaller->_idTaller = $datos["id_taller"];
        $domicilioTaller->_idDomicilio = $datos["id_domicilio"];
        $domicilioTaller->_idBarrio = $datos["id_barrio"];
        $domicilioTaller->_calle = $datos["calle"];
        $domicilioTaller->_altura = $datos["altura"];
        $domicilioTaller->_manzana = $datos["manzana"];
        $domicilioTaller->_torre = $datos["torre"];
        $domicilioTaller->_piso = $datos["piso"];
        $domicilioTaller->_numCasa = $datos["num_casa"];

		return $domicilioTaller;
    }
    
}

?>