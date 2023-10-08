<?php
namespace Model;

class Usuario extends ActiveRecord{
	protected static $tabla = 'usuarios';
	protected static $columnasDB = [
		'id', 
		'nombre', 
		'apellido', 
		'email', 
		'telefono', 
		'admin',
		'confirmado',
		'token',
		'password'
	];

	public $id;
	public $nombre;
	public $apellido;
	public $email;
	public $password;
	public $telefono;
	public $admin;
	public $confirmado;
	public $token;

	public function __construct($args = []){
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->apellido = $args['apellido'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->password = $args['password'] ?? '';
		$this->telefono = $args['telefono'] ?? '';
		$this->admin = $args['admin'] ?? 0;
		$this->confirmado = $args['confirmado'] ?? 0;
		$this->token = $args['token'] ?? '';
	}

	/*Mensajes de validacion para la cuenta*/

	public function validarNuevaCuenta(){
		$matches = null;
		if (!$this->nombre) {
			self::$alertas['error'][] = "El campo nombre no puede estar vacio";
		}else if(strlen($this->nombre) < 1){
			self::$alertas['error'][] = "Debes ingresar un nombre mas largo";
		}
		if (!$this->apellido) {
			self::$alertas['error'][] = "El campo apellido no puede estar vacio";
		}else if(strlen($this->apellido) < 1){
			self::$alertas['error'][] = "Debes ingresar un apellido mas largo";
		}
		if (!$this->email) {
			self::$alertas['error'][] = "Debes ingresar un Email";
		}else if(strlen($this->email) < 1){
			self::$alertas['error'][] = "Debes ingresar un email mas largo";
		}else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			self::$alertas['error'][] = "El formato de email es invalido";
		}
		if (!$this->telefono) {
			self::$alertas['error'][] = "El campo telefono no puede estar vacio";
		}
		if (!$this->password) {
			self::$alertas['error'][] = "El campo password no puede estar vacio";
		}else if(strlen($this->password) < 8){
			self::$alertas['error'][] = "El password debe contener al menos 8 caracteres";
		}else if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $this->password, $matches)){
			self::$alertas['error'][] = "Patron de password es incorrecto";
		}

		return self::$alertas;
	}

	public function existeUsuario(){
		$sql = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."'"."LIMIT 1";
		$resultado = self::$db->query($sql);
		if($resultado->num_rows){
			self::$alertas['error'][] = "Usuario con ese email ya existe, prueba con otro.";
		}
		return $resultado;
	}

	public function hashPassword(){
		/*reescribimos el password con su version hasheada usando password hash BCRYPT*/
		$this->password = password_hash($this->password, PASSWORD_BCRYPT);
	}

	public function crearToken(){
		$this->token = uniqid();
	}

	public static function confirmarUsuario($token){
		$sql = "UPDATE ". static::$tabla ." SET confirmado = true, token = null WHERE token = '${token}'";
		$resultado = self::$db->query($sql);
		if ($resultado){
			return $resultado;
		}
	}


}
?>