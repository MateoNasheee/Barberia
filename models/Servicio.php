<?php 

namespace Model;

class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'duracion', 'descripcion', 'categoria'];  // Agregado 'duracion'

    public $id;
    public $nombre;
    public $precio;
    public $duracion;  // Agregado 'duracion'
    public $descripcion;
    public $categoria;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->duracion = $args['duracion'] ?? 0;  // Establecer duracion por defecto si no se proporciona
        $this->descripcion = $args['descripcion'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
    }


    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Servicio es Obligatorio';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El Precio del Servicio es Obligatorio';
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'El precio no es válido';
        }

        return self::$alertas;
    }

    // // Método para obtener el nombre del servicio por ID
    // public static function obtenerNombrePorId($id) {
    //     $query = "SELECT nombre FROM " . static::$tabla . " WHERE id = '$id' LIMIT 1";
    //     $resultado = self::$db->query($query);

    //     if ($resultado) {
    //         $registro = $resultado->fetch_assoc();
    //         return $registro['nombre'] ?? null; // Retorna el nombre o null si no se encuentra
    //     }

    //     return null; // Retorna null si la consulta falla
    // }


    public static function obtenerPrecioPorId($idServicio) {
        // Consulta para obtener el precio del servicio
        $consulta = "SELECT precio FROM servicios WHERE id = ${idServicio} LIMIT 1";
        $resultado = self::consultarSQL($consulta);
    
        return $resultado ? $resultado[0]->precio : 0; // Devuelve el precio, o 0 si no se encuentra
    }

}