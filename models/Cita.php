<?php

namespace Model;

use Model\ActiveRecord;

class Cita extends ActiveRecord {


//base de datos

    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioid'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioid;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $this->formatearHora($args['hora'] ?? '', $this->fecha);
        
        // Buscar usuarioid o usuario_id
        $usuarioId = $args['usuarioid'] ?? $args['usuario_id'] ?? '';
        $this->usuarioid = !empty(trim($usuarioId)) ? $usuarioId : null;
    }

    private function formatearHora($hora, $fecha = '') {
        if (!empty($hora) && strlen($hora) === 5) {
            // Convertir HH:MM a YYYY-MM-DD HH:MM:SS
            $fecha = !empty($fecha) ? $fecha : date('Y-m-d');
            $hora = $fecha . ' ' . $hora . ':00';
        }
        return $hora;
    }
}