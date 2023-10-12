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
		$this->precio = $args['precio'] ?? '';
	}

}
?>