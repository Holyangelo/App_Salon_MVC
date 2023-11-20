<?php
/*Creamos el namespace*/
namespace Model;

/*Main Class*/
class Servicio extends ActiveRecord{
	/*Creamos las variables para instanciar la db*/
	protected static $tabla = 'servicios';
	protected static $columnasDB = ['id', 'nombre', 'precio'];

	/*Creamos las variables que almacenan la data en la clase*/
	public $id;
	public $nombre;
	public $precio;

	/*Creamos el constructor*/
	public function __construct($args = []) {
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->precio = $args['precio'] ??  0;
	}

	public function validarServicio(){
		$matches = null;
		if (!$this->nombre) {
			self::$alertas['error'][] = "El campo nombre no puede estar vacio";
		}else if(strlen($this->nombre) < 1){
			self::$alertas['error'][] = "Debes ingresar un nombre mas largo";
		}
		if (!$this->precio) {
			self::$alertas['error'][] = "El campo precio no puede estar vacio";
		}else if(strlen($this->precio) <= 1){
			self::$alertas['error'][] = "Debes ingresar un precio mayor a 0";
		}

		return self::$alertas;
	}

	 public static function countServices(){
        $sql = "SELECT COUNT(*) FROM ". static::$tabla;
        $query = self::$db->query($sql);
        $result =  $query->fetch_assoc();
        return $result['COUNT(*)'];
    }

	public static function getAllServices() {
		$sql = 'SELECT * FROM '. static::$tabla;
		return $query = self::consultarSQL($sql);
	}
}
?>