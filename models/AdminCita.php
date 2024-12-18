<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio', 'estado', 'usuarioId'];  // Agregar 'usuarioId'

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
    public $estado;  // Agregar propiedad para 'estado'
    public $usuarioId;  // Agregar propiedad para 'usuarioId'

    public function __construct($args = [])  // Asegúrate de pasar el argumento $args
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? null;  // Asignar 'estado'
        $this->usuarioId = $args['usuarioId'] ?? null;  // Asignar 'usuarioId'
    }
}