<?php

require_once "MySQL.php";
require_once "domicilio.php";
require_once "persona.php";

class domicilioPersona extends domicilio{

    private $_idDomicilioPersona;
    private $_estado;
    private $_idPersona;

    public function getIdDomicilioPersona(){
        return $this->_idDomicilioPersona;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setEstado($_estado){
        $this->_estado = $_estado;
        return $this;
    }
    
    public function getIdPersona(){
        return $this->_idPersona;
    }

    public function setIdPersona($_idPersona){
        $this->_idPersona = $_idPersona;
        return $this;
    }

    public function guardar(){
        parent::guardar();
        
        $database = new MySQL();

		$sql = "INSERT INTO domicilio_persona "
		     . "(id_domicilio_persona, id_persona, id_domicilio) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_idDomicilio})";

		$database->insertar($sql);
    }

    public function actualizar(){

        $database = new MySQL();

        $sql = "UPDATE domicilio SET id_barrio = {$this->_idBarrio}, calle = '{$this->_calle}', altura = '{$this->_altura}', "
             . "manzana = '{$this->_manzana}', torre = '{$this->_torre}', piso = '{$this->_piso}', num_casa = '{$this->_numCasa}' "
             . "WHERE id_domicilio = {$this->_idDomicilio}";

        $database->actualizar($sql);
    }


    public static function obtenerPorIdPersona($id){
        $sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_persona.id_persona, domicilio_persona.id_domicilio as domicilio_id, domicilio_persona.id_domicilio_persona, domicilio_persona.estado "
             . "FROM domicilio INNER JOIN domicilio_persona ON domicilio.id_domicilio = domicilio_persona.id_domicilio "
             . "WHERE domicilio_persona.id_persona = {$id} and domicilio_persona.estado = 1";

        
		$databse = new MySQL();
		$datos = $databse->consultar($sql);

        $listadoDomicilioPersona = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$domicilioPersona = new domicilioPersona();
            $domicilio = new domicilio();
            $domicilioPersona->_estado = $registro["estado"];
			$domicilioPersona->_idDomicilioPersona = $registro['id_domicilio_persona'];
            $domicilioPersona->_idPersona = $registro["id_persona"];
			$domicilioPersona->_idDomicilio = $registro["id_domicilio"];
			$domicilioPersona->_idBarrio = $domicilio->getDescripcionById($registro["id_barrio"]);
			$domicilioPersona->_calle = $registro["calle"];
			$domicilioPersona->_altura = $registro["altura"];
			$domicilioPersona->_manzana = $registro["manzana"];
			$domicilioPersona->_torre = $registro["torre"];
			$domicilioPersona->_piso = $registro["piso"];
			$domicilioPersona->_numCasa = $registro["num_casa"];
            $listadoDomicilioPersona[] = $domicilioPersona;
    	}


    	return $listadoDomicilioPersona;
    }


    public static function obtenerPorIdPersonaIdDomicilio($id, $idDomicilio) {
    	$sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_persona.id_persona, domicilio_persona.id_domicilio as domicilio_id, domicilio_persona.id_domicilio_persona "
             . "FROM domicilio INNER JOIN domicilio_persona ON domicilio.id_domicilio = domicilio_persona.id_domicilio "
             . "WHERE domicilio_persona.id_persona = {$id} and domicilio_persona.id_domicilio = {$idDomicilio} ";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$domicilioPersona = self::_CrearIdPersonaIdDomicilio($registro);
		return $domicilioPersona;

    }

    public function baja() {

    	$sql = "UPDATE domicilio_persona SET estado = '0' WHERE id_domicilio_persona = '{$this->_idDomicilioPersona}'";

    	$database = new MySQL();
        $database->baja($sql);
    }

    private static function _CrearIdPersonaIdDomicilio($datos) {
        $domicilioPersona = new domicilioPersona();
        $domicilio = new domicilio();
        $domicilioPersona->_idDomicilioPersona = $datos['id_domicilio_persona'];
        $domicilioPersona->_idPersona = $datos["id_persona"];
        $domicilioPersona->_idDomicilio = $datos["id_domicilio"];
        $domicilioPersona->_idBarrio = $domicilio->getDescripcionById($datos["id_barrio"]);
        $domicilioPersona->_calle = $datos["calle"];
        $domicilioPersona->_altura = $datos["altura"];
        $domicilioPersona->_manzana = $datos["manzana"];
        $domicilioPersona->_torre = $datos["torre"];
        $domicilioPersona->_piso = $datos["piso"];
        $domicilioPersona->_numCasa = $datos["num_casa"];

		return $domicilioPersona;
    }

    public static function obtenerPorIdPersonaDomicilio($idPersonaDomicilio) {
    	$sql = "SELECT domicilio.id_domicilio, domicilio.id_barrio, domicilio.calle, domicilio.altura, domicilio.manzana, "
             . "domicilio.torre, domicilio.piso, domicilio.num_casa, "
             . "domicilio_persona.id_persona, domicilio_persona.id_domicilio as domicilio_id, domicilio_persona.id_domicilio_persona "
             . "FROM domicilio INNER JOIN domicilio_persona ON domicilio.id_domicilio = domicilio_persona.id_domicilio "
             . "WHERE domicilio_persona.id_domicilio_persona = {$idPersonaDomicilio} ";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$domicilioPersona = self::_CrearPersonaDomicilio($registro);
		return $domicilioPersona;

    }

    private static function _CrearPersonaDomicilio($datos) {
        $domicilioPersona = new domicilioPersona();
        $domicilio = new domicilio();
        $domicilioPersona->_idDomicilioPersona = $datos['id_domicilio_persona'];
        $domicilioPersona->_idPersona = $datos["id_persona"];
        $domicilioPersona->_idDomicilio = $datos["id_domicilio"];
        $domicilioPersona->_idBarrio = $domicilio->getDescripcionById($datos["id_barrio"]);
        $domicilioPersona->_calle = $datos["calle"];
        $domicilioPersona->_altura = $datos["altura"];
        $domicilioPersona->_manzana = $datos["manzana"];
        $domicilioPersona->_torre = $datos["torre"];
        $domicilioPersona->_piso = $datos["piso"];
        $domicilioPersona->_numCasa = $datos["num_casa"];

		return $domicilioPersona;
    }
    
}

?>