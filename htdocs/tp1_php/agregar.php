<?php
// Se agrega una nueva tarea al archivo JSON
require_once "clases/Tarea.php";

$archivo = "data/tareas.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Toma los datos del formulario
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $prioridad = $_POST["prioridad"];

    // Si el título está vacío, se vuelve al inicio
    if ($titulo === "") {
        header("Location: index.php");
        exit;
    }

    // Carga las tareas 
    $tareas = [];
    if (file_exists($archivo)) {
        $tareas = json_decode(file_get_contents($archivo), true);
    }

    // Crea un nuevo ID 
    $id = count($tareas) + 1;

    // Crea objeto a la  tarea (POO)
    $tarea = new Tarea($id, $titulo, $descripcion, $prioridad);

    // Guarda la nueva tarea como array asociativo
    $tareas[] = [
        "id" => $tarea->getId(),
        "titulo" => $tarea->getTitulo(),
        "descripcion" => $tarea->getDescripcion(),
        "prioridad" => $tarea->getPrioridad()
    ];

    // Lo guarda en JSON
    file_put_contents($archivo, json_encode($tareas, JSON_PRETTY_PRINT));

    // Vuelve al inicio
    header("Location: index.php");
    exit;

} else {
    header("Location: index.php");
    exit;
}

