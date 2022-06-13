<?php


require_once "MySQL.php";
require_once "Persona.php";
require_once "Perfil.php";


class Usuario extends Persona {

	private $_idUsuario;
	private $_username;
	private $_idPerfil;
	private $_estaLogueado;
    private $_password;

    public $perfil;


    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->_idUsuario;
    }

    /**
     * @param mixed $_idUsuario
     *
     * @return self
     */
    public function setIdUsuario($_idUsuario)
    {
        $this->_idUsuario = $_idUsuario;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $_username
     *
     * @return self
     */
    public function setUsername($_username)
    {
        $this->_username = $_username;

        return $this;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    
    public function setPassword($_password){
        $this->_password = $_password;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdPerfil($_idPerfil)
    {
        $this->_idPerfil = $_idPerfil;

        return $this;
    }

    public function estaLogueado()
    {
    	return $this->_estaLogueado;
    }

    public function guardar() {

		$database = new MySQL();
        parent :: guardar();

		$sql = "INSERT INTO usuario "
		     . "(id_usuario, username, password, id_persona, id_perfil) "
		     . "VALUES (NULL, '{$this->_username}', '{$this->_password}', '{$this->_idPersona}', '{$this->_idPerfil}')";
		$database->insertar($sql);
	}

    public function actualizar(){
        parent :: actualizar();
        $sql = "UPDATE usuario SET "
             . "password = '{$this->_password}', id_perfil = '{$this->_idPerfil}' WHERE id_usuario = {$this->_idUsuario}";
        $database = new MySQL();
        $database->actualizar($sql);
        //echo $sql;
        //exit;
    }

    public static function comprobarNuevoUsuario($username){
        $database = new MySQL();
        $sql = "SELECT * FROM usuario WHERE username = '$username'";
        $datos = $database->consultar($sql);
        
        $mensaje = "";
        if ($datos->num_rows == 0) {
            return true;
        }else{
            return false;
        }
    }
    


    public static function eliminar($id) {

        $sql = "UPDATE persona SET estado = 0 WHERE id_persona=$id";
        $database = new MySQL();
        $database->actualizar($sql);

    }


    public static function obtenerTodos() {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.estado, persona.apellido, persona.id_sexo, persona.dni, "
             . "persona.fecha_nacimiento, usuario.id_usuario, usuario.username, usuario.password, "
             . "usuario.id_perfil "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE persona.estado != 0";
        //echo $sql;
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoUsuarios = [];

    	while ($registro = $datos->fetch_assoc()) {
    		$user = self::_crearUsuario($registro);
    		$listadoUsuarios[] = $user;
    	}


    	return $listadoUsuarios;
    }

    public static function login($username, $password) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, "
             . "persona.fecha_nacimiento, usuario.id_usuario, usuario.username, "
             . "usuario.id_perfil "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE username = '{$username}' and password = '{$password}' and persona.estado=1";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);


    	if ($datos->num_rows > 0) {
    		$registro = $datos->fetch_assoc();
			$user = self::_crearUsuario($registro);
			$user->_estaLogueado = true;

    	} else {
    		$user = new Usuario();
    		$user->_estaLogueado = false;
    	}

		return $user;

    }

    public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, persona.dni, "
             . "persona.fecha_nacimiento, usuario.id_usuario, usuario.username, usuario.password, "
             . "usuario.id_perfil "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE id_usuario=" . $id;
        

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$usuario = self::_crearUsuario($registro);
		return $usuario;

    }

    private static function _crearUsuario($datos) {
    	$user = new Usuario();
        $sexo = new Sexo();
		$user->_idUsuario = $datos["id_usuario"];
        $user->_idSexo = $sexo->getDescripcionById($datos["id_sexo"]);
		$user->_idPersona = $datos["id_persona"];
		$user->_username = $datos["username"];
        $user->_password = $datos["password"];
		$user->_idPerfil = $datos["id_perfil"];
		$user->_nombre = $datos["nombre"];
		$user->_apellido = $datos["apellido"];
        $user->_dni = $datos["dni"];
		$user->_fechaNacimiento = $datos["fecha_nacimiento"];
        $user->perfil = Perfil::obtenerPorId($user->_idPerfil);

		return $user;
    }
}


?>