<?php

// Incluir el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta si es necesario

// Definir el controlador
class MercadoPagoController
{
    // El método para crear la preferencia de pago
    public function crearPreferencia($cita)
    {
        // Configurar Mercado Pago con tu Access Token
        MercadoPago\SDK::setAccessToken('APP_USR-1118700068231035-121800-0b14a137cab017d5e12983a65d914009-538852201'); // Reemplaza con tu Access Token

        // Crear la preferencia
        $preference = new MercadoPago\Preference();

        // Crear los productos (servicios)
        $items = [];
        foreach ($cita['servicios'] as $servicio) {
            $items[] = [
                'title' => $servicio['nombre'],
                'quantity' => 1,
                'unit_price' => (float)$servicio['precio'],
            ];
        }

        // Calcular el 30% del total para la seña
        $totalPrecio = 0;
        foreach ($cita['servicios'] as $servicio) {
            $totalPrecio += (float)$servicio['precio'];
        }
        $senia = $totalPrecio * 0.30; // 30% de la cita

        // Asignar los items y la URL de redirección a la preferencia
        $preference->items = $items;
        $preference->back_urls = [
            "success" => "http://www.tusitio.com/resultado_pago/success",
            "failure" => "http://www.tusitio.com/resultado_pago/failure",
            "pending" => "http://www.tusitio.com/resultado_pago/pending"
        ];
        $preference->auto_return = "approved";

        // Guardar la preferencia
        $preference->save();

        // Enviar el ID de la preferencia al frontend
        // Aquí puedes enviar el ID de la preferencia y la seña
        return ['preference_id' => $preference->id, 'senia' => $senia];
    }
}
