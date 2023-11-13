<?php
// escribimos el namespace
namespace Model;

class Cita extends ActiveRecord{
    //Creamos la variable del nombre de la tabla en la DB
    protected static $tabla = "citas";
    //creamos la variable que almacena el nombre de las columnas en la DB
    protected static $columnasDB = ["id", "fecha", "hora", "usuarioId"];

    //creamos las variables que almacenan los datos en la clase
    public $id;

    public $fecha;

    public $hora;

    public $usuarioId;

    //creamos el constructor con los datos en la clase
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
        $this->usuarioId = $args["usuarioId"] ?? null;
    }

    public static function countCita(){
        $sql = "SELECT COUNT(*) FROM ". static::$tabla . " WHERE fecha > now();";
        $query = self::$db->query($sql);
        $result = $query->fetch_assoc();
        return $result['COUNT(*)'];
    }

    public static function countCitaOut(){
        $sql = "SELECT COUNT(*) FROM ". static::$tabla . " WHERE fecha < now();";
        $query = self::$db->query($sql);
        $result = $query->fetch_assoc();
        return $result['COUNT(*)'];
    }
}
?>