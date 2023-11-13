<?php
/*Asignamos el namespace*/
namespace Model;

class AdminCita extends ActiveRecord{
	protected static $tabla = "citas_servicios";
	protected static $columnasDB = ["id", "hora", "cliente", "email", "telefono", "servicio", "precio"];

	public $id;
	public $hora;
	public $cliente;
	public $email;
	public $telefono;
	public $servicio;
	public $precio;

	public function __construct($args = []){
		$this->id = $args['id'] ?? null;
		$this->hora = $args['hora'] ?? '';
		$this->cliente = $args['cliente'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->telefono = $args['telefono'] ?? '';
		$this->servicio = $args['servicio'] ?? '';
		$this->precio = $args['precio'] ?? 0;
	}

	public static function obtenerCitaServicio($fecha){
        $consulta = '';
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citas_servicios ";
        $consulta .= " ON citas_servicios.citasId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citas_servicios.serviciosId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";
        return $query = self::consultarSQL($consulta);
    }
}
?>