<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    public function ejecutarSQL($sql) {
        // Supongamos que ya tienes una conexión a la base de datos en la propiedad $db
        $result = $this->db->query($sql);
        if ($result === false) {
            throw new \Exception("Error en la consulta SQL");
        }
        return $result;
    }
    // Método para actualizar el estado de la cita
    public function actualizarEstado($estado)
    {
        $this->estado = $estado;
        // Aquí debes realizar el update en la base de datos para cambiar el estado
        $query = "UPDATE " . static::$tabla . " SET estado = :estado WHERE id = :id";
        $params = [
            'estado' => $estado,
            'id' => $this->id
        ];
        return self::ejecutarSQL($query, $params);
    }
        // Método para eliminar la relación entre citaId y servicioId
        public static function eliminarServicio($citaId, $servicioId) {
            // Verificamos si la relación existe antes de intentar eliminarla
            $query = "SELECT * FROM " . self::$tabla . " WHERE citaId = :citaId AND servicioId = :servicioId";
            
            $stmt = self::getDb()->prepare($query);
            $stmt->bindParam(':citaId', $citaId, \PDO::PARAM_INT);
            $stmt->bindParam(':servicioId', $servicioId, \PDO::PARAM_INT);
            
            $stmt->execute();
        
            // Si no existe la relación
            if ($stmt->rowCount() === 0) {
                error_log('No se encontró la relación entre citaId ' . $citaId . ' y servicioId ' . $servicioId);
                return false;
            }
        
            // Si existe, procedemos a eliminar
            $deleteQuery = "DELETE FROM " . self::$tabla . " WHERE citaId = :citaId AND servicioId = :servicioId";
            $deleteStmt = self::getDb()->prepare($deleteQuery);
            $deleteStmt->bindParam(':citaId', $citaId, \PDO::PARAM_INT);
            $deleteStmt->bindParam(':servicioId', $servicioId, \PDO::PARAM_INT);
        
            return $deleteStmt->execute();
        }
        
        

        // Método para obtener el nombre del servicio por ID
        public static function obtenerNombrePorId($id) {
            $query = "SELECT nombre FROM " . static::$tabla . " WHERE id = '$id' LIMIT 1";
            $resultado = self::$db->query($query);
    
            if ($resultado) {
                $registro = $resultado->fetch_assoc();
                return $registro['nombre'] ?? null; // Retorna el nombre o null si no se encuentra
            }
    
            return null; // Retorna null si la consulta falla
        }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos(); // Obtener los atributos
        $sanitizado = [];
    
        foreach ($atributos as $key => $value) {
            // Eliminar espacios en blanco y luego escapar el valor
            $sanitizado[$key] = self::$db->escape_string(trim($value));
        }
    
        return $sanitizado;
    }
    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public function obtenerUltimoId() {
        // Aquí se obtiene el último ID insertado
        return self::$db->insert_id;
    }
    public static function findByCita($citaId) {
        // Consulta SQL para buscar el servicio asociado a la cita
        $query = "SELECT * FROM " . static::$tabla . " WHERE citaId = {$citaId}";
        
        // Ejecutar la consulta y obtener el resultado
        $resultado = self::consultarSQL($query);
        
        // Retornar el primer resultado o null si no hay coincidencias
        return array_shift($resultado);
    }

    public function actualizarCita() {
        // Actualizar el servicioId en la tabla citasServicios para el registro correspondiente
        $query = "UPDATE " . static::$tabla . " SET servicioId = {$this->servicioId} WHERE id = {$this->id} LIMIT 1";
        
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function findByCitaAndServicio($citaId, $servicioId) {
        // Consulta SQL para buscar el servicio asociado a la cita
        $query = "SELECT * FROM " . static::$tabla . " WHERE citaId = {$citaId} AND servicioId = {$servicioId}";
        
        // Ejecutar la consulta y obtener el resultado
        $resultado = self::consultarSQL($query);
        
        // Retornar el primer resultado o null si no hay coincidencias
        return array_shift($resultado);
    }


    public static function findByCitaAndUsuario($citaId, $usuarioId) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$citaId} AND usuarioId = {$usuarioId}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    
    public static function consultarPorFecha($fecha)
    {
        // Asegúrate de que la fecha esté en el formato correcto
        $fecha = date('Y-m-d', strtotime($fecha)); // Asegura el formato de la fecha en Y-m-d
    
        // Realiza la consulta para buscar todas las citas con la fecha proporcionada
        $query = "SELECT * FROM " . static::$tabla . " WHERE DATE(fecha) = '{$fecha}'";
    
        // Ejecuta la consulta y devuelve el resultado
        $resultado = self::consultarSQL($query);
    
        // Si no se encuentran resultados, retorna un array vacío
        if (!$resultado) {
            return [];
        }
    
        return $resultado;
    }
    

    // Busca un registro por su id
    public static function find($id) {
        if (!is_numeric($id)) {
            throw new \Exception("El ID debe ser un número, se recibió: " . print_r($id, true));
        }
    
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
    
        if (!$resultado) {
            throw new \Exception("No se encontró ningún registro con ID {$id}");
        }
    
        return array_shift($resultado);
    }
    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busca un registro por su id
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Consulta Plana de SQL (Utilizar cuando los métodos del modelo no son suficientes)
    public static function SQL($query) {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}