<?php
// Clase para representar una tarea 

class Tarea {
    private $id;
    private $titulo;
    private $descripcion;
    private $prioridad;

    private static $contador = 0; // Contador estático

    public function __construct($id, $titulo, $descripcion, $prioridad) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->prioridad = $prioridad;

        self::$contador++;
    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getDescripcion() { return $this->descripcion; }
    public function getPrioridad() { return $this->prioridad; }

    public static function totalCreadas() {
        return self::$contador;
    }
}

