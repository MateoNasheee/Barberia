<?php

namespace Model;

class HistorialCita extends ActiveRecord {
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['citaId', 'fecha', 'hora', 'servicioNombre', 'servicioPrecio', 'estado', 'servicioId', 'usuarioId'];

    public $citaId;
    public $fecha;
    public $hora;
    public $servicioNombre;
    public $servicioPrecio;
    public $estado;
    public $servicioId;
    public $usuarioId;  // Nuevo campo para usuarioId

    public function __construct($args = [])
    {
        $this->citaId = $args['citaId'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->servicioNombre = $args['servicioNombre'] ?? '';
        $this->servicioPrecio = $args['servicioPrecio'] ?? 0.00;
        $this->estado = $args['estado'] ?? 0;
        $this->servicioId = $args['servicioId'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? null;  // Inicializar el campo usuarioId
    }
}