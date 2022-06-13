<?php

require_once "MySQL.php";

class noticias{
    private $_idNoticia;
    private $_noticia;

    public function getIdNoticia(){
        return $this->_idNoticia;
    }

    public function getNoticia(){
        return $this->_noticia;
    }

    public function setNoticia($_idNoticia){
        $this->_idNoticia = $_idNoticia;
        return $this;
    }

    public static function guardar($noticia){
        $database = new MySQL();
        $sql = "INSERT INTO noticias(id_noticia, noticia) VALUE(NULL, '$noticia')";
        $database->insertar($sql);
    }

    public static function obtenerUltimasNoticias(){
        $database = new MySQL();
        $sql = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT 3";
        $datos = $database->consultar($sql);

    	$listadoNoticias = [];

        while ($registro = $datos->fetch_assoc()) {
	    	$noticias = new noticias();
			$noticias->_idNoticia = $registro["id_noticia"];
			$noticias->_noticia = $registro["noticia"];
    		$listadoNoticias[] = $noticias;
    	}


    	return $listadoNoticias;
	}
}

?>