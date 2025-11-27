<?php
require_once "clases/Tarea.php";

$archivo = __DIR__ . "/data/tareas.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Toma los datos 
    $titulo = isset($_POST["titulo"]) ? trim($_POST["titulo"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
    $prioridad = isset($_POST["prioridad"]) ? $_POST["prioridad"] : "";

    // Si no se completa el titulo se toma como error 
    if ($titulo === "") {
        header("Location: index.php");
        exit;
    }

    // Cargan las tareas
    $tareas = [];
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $tareas = json_decode($contenido, true);
        if (!is_array($tareas)) {
            $tareas = [];
        }
    }

    // Crea un id
    $id = time();

    // Crea la tarea 
    $tarea = new Tarea($id, $titulo, $descripcion, $prioridad);

    // Guarda las tareas 
    $tareas[] = [
        "id" => $tarea->getId(),
        "titulo" => $tarea->getTitulo(),
        "descripcion" => $tarea->getDescripcion(),
        "prioridad" => $tarea->getPrioridad()
    ];

    // Guarda en el JSON
    file_put_contents($archivo, json_encode($tareas, JSON_PRETTY_PRINT));

    // Vuelve al inicio 
    header("Location: index.php");
    exit;
}
?>

