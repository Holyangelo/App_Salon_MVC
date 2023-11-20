<?php
namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'citas_servicios';
    protected static $columnasDB = ["id", "citasId", "serviciosId"];

    public $id;
    public $citasId;
    public $serviciosId;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->citasId = $args["citasId"] ?? "";
        $this->serviciosId = $args["serviciosId"] ?? "";
    }

    public static function getCountServices($id) {
        $sql = "SELECT COUNT(citasId) FROM ".static::$tabla." WHERE serviciosId = " . $id;
        $query = self::$db->query($sql);
        $result = $query->fetch_assoc();
        return $result["COUNT(citasId)"];
    }
}
?>