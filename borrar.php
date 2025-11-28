<?php
// Archivo para borrar tareas
$archivo = "data/tareas.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ID de la tarea para borrar
    $id = intval($_POST["id"]);

    if (file_exists($archivo)) {

        // Carga las tareas
        $tareas = json_decode(file_get_contents($archivo), true);

        // Guarda solamente las que NO coinciden con el ID
        $nuevas = [];
        foreach ($tareas as $t) {
            if ($t["id"] != $id) {
                $nuevas[] = $t;
            }
        }

        // Guarda el nuevo archivo
        file_put_contents($archivo, json_encode($nuevas, JSON_PRETTY_PRINT));
    }
}

// Vuelve al inicio
header("Location: index.php");
exit;
