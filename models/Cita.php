<?php

namespace Model;

class Cita extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId', 'estado', 'duracionTotal']; // Añadimos 'duracionTotal'

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $estado;  // Nueva propiedad para 'estado'
    public $duracionTotal; // Nueva propiedad para 'duracionTotal'

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->estado = $args['estado'] ?? 0;  // Por defecto, el estado es 0
        $this->duracionTotal = $args['duracionTotal'] ?? null;  // Añadimos el valor para 'duracionTotal'
    }

}
