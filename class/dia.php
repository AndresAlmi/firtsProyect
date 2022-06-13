<?php


require_once "MySQL.php";
require_once "agenda.php";


class Dia {

	private $_idDia;
	private $_lunes;
	private $_martes;
	private $_miercoles;
	private $_jueves;
	private $_viernes;
	private $_sabado;
	private $_domingo;
	private $_idAgenda;


	public function getidDia(){
		return $this->_idDia;
	}

	public function setidDia($_idDia){
		$this->_idDia=$_idDia;
	}

	public function getLunes(){
		return $this->_lunes;
	}

	public function setLunes($_lunes){
		$this->_lunes = $_lunes;
        return $this;
	}

	public function getMartes(){
		return $this->_martes;
	}
	
	public function setMartes($_martes){
		$this->_martes = $_martes;
	}

	public function setMiercoles($_miercoles){
		$this->_miercoles = $_miercoles;
	}

	public function getMiercoles(){
		return $this->_miercoles;
	}

	public function setJueves($_jueves){
		$this->_jueves = $_jueves;
	}

	public function getJueves(){
		return $this->_jueves;
	}

	public function setViernes($_viernes){
		$this->_viernes = $_viernes;
	}

	public function getViernes(){
		return $this->_viernes;
	}

	public function setSabado($_sabado){
		$this->_sabado = $_sabado;
	}

	public function getSabado(){
		return $this->_sabado;
	}

	public function setDomingo($_domingo){
		$this->_domingo = $_domingo;
	}

	public function getDomingo(){
		return $this->_domingo;
	}

	public function setIdAgenda($_idAgenda){
		$this ->_idAgenda=$_idAgenda;
	}

	public function getIdAgenda (){
		return $this->_idAgenda;
	}

	public function guardar() {
		$database = new MySQL();

		$sql = "INSERT INTO dias (id_dia, Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Domingo, id_agenda) "
			 . "VALUES (NULL, {$this->getLunes()}, {$this->getMartes()}, {$this->getMiercoles()}, "
			 . "{$this->getJueves()}, {$this->getViernes()}, {$this->getSabado()}, {$this->getDomingo()}, {$this->getIdAgenda()} )";
		//echo $sql;

		$database->insertar($sql);
	}

    public function eliminar(){
        $database = new MySQL();
        $sql = "DELETE FROM dias WHERE id_agenda = {$this->_idAgenda}";

        $database->eliminar($sql);
    }

	public static function obtenerTodos() {
    	$sql = "SELECT id_dia, Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Domingo, id_agenda FROM dia";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoDia = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$dia = new Dia();
			$dia->_idDia = $registro["id_dia"];
			$dia->_lunes = $registro["Lunes"];
			$dia->_martes = $registro["Martes"];
			$dia->_miercoles = $registro["Miercoles"];
			$dia->_jueves = $registro["Jueves"];
			$dia->_viernes = $registro["Viernes"];
			$dia->_sabado = $registro["Sabado"];
			$dia->_domingo = $registro["Domingo"];
			$dia->_idAgenda =$registro ["id_agenda"];
    		$listadoDia[] = $dia;
    	}


    	return $listadoDia;
	}


	public static function obtenerPorIdAgenda($id) {

		$sql = "SELECT dias.id_agenda,dias.id_dia, dias.Lunes, dias.Martes, dias.Miercoles, dias.Jueves, dias.Viernes, dias.Sabado, dias.domingo "
			 . "FROM dias "
			 . "INNER JOIN Agenda ON Agenda.id_agenda = dias.id_agenda "
			 . "WHERE Agenda.id_agenda = ".$id;


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$dia = new dia();
		if ($datos->num_rows > 0) {

			$registro = $datos->fetch_assoc();
			$dia->_idDia = $registro["id_dia"];
			$dia->_lunes = $registro["Lunes"];
			$dia->_martes = $registro["Martes"];
			$dia->_miercoles = $registro["Miercoles"];
			$dia->_jueves = $registro["Jueves"];
			$dia->_viernes = $registro["Viernes"];
			$dia->_sabado = $registro["Sabado"];
			$dia->_domingo = $registro["domingo"];
			$dia->_idAgenda= $registro["id_agenda"];
		
		}

    	return $dia;

	}

	public static function obtenerListaIdAgenda($id) {

		$sql = "SELECT dias.id_agenda,dias.id_dia, dias.Lunes, dias.Martes, dias.Miercoles, dias.Jueves, dias.Viernes, dias.Sabado, dias.Domingo "
			 . "FROM dias "
			 . "INNER JOIN Agenda ON Agenda.id_agenda = dias.id_agenda "
			 . "WHERE Agenda.id_agenda = ".$id;


		$database = new MySQL();
		$datos = $database->consultar($sql);

    	$listadoDia = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$dia = new Dia();

			$dia->_lunes = $registro["Lunes"];
			$dia->_martes = $registro["Martes"];
			$dia->_miercoles = $registro["Miercoles"];
			$dia->_jueves = $registro["Jueves"];
			$dia->_viernes = $registro["Viernes"];
			$dia->_sabado = $registro["Sabado"];
			$dia->_domingo = $registro["Domingo"];

    		$listadoDia[] = $dia;
    	}


    	return $listadoDia;

	}



} 

	


?>