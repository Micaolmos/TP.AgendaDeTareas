<?php
/*
TP
Profesor:Bruno Cano 
Estudiante: Lourdes Micaela Olmos Aguilera 
Curso: 5to Año
Materia: Programación
*/

include "includes/header.php";   // Encabezado del sitio
include "includes/menu.php";     // Menú
require_once __DIR__ . "/clases/Tarea.php"; // Clase Tarea


$archivo = __DIR__ . "/data/tareas.json"; //Archivo de las tareas 

// Función para cargar las tareas desde el JSON
function cargarTareas($archivo) {
    if (!file_exists($archivo)) {   // Si no existe, devuelve un array vacío
        return [];
    }
    $datos = file_get_contents($archivo);  // Lee el archivo
    return json_decode($datos, true) ?: []; // Lo convierte en array
}

// Carga todas las tareas
$tareas = cargarTareas($archivo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de tareas</title>
</head>
<body>
<div class="container mt-4">
    <h2>Nueva tarea</h2>

    <!-- Formulario para cargar una nueva tarea-->
    <form action="agregar.php" method="POST" class="mb-4">
        <input type="text" name="titulo" placeholder="Título" class="form-control mb-2" required>
        <textarea name="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>

        <!--Array indexado -->
        <select name="prioridad" class="form-select mb-2">
            <option value="No importante">No importante</option>
            <option value="Importante">Importante</option>
            <option value="Re importante">Muy importante</option>
        </select>

        <button type="submit" class="btn btn-primary">Nueva tarea </button>
    </form>

    <!-- Si no hay tareas avisa -->
</body>
</html>

    <?php 
    if (empty($tareas)): ?>
        <p>No hay ninguna tarea:D.</p>

    <!-- Si hay tareas, las muestra -->
    <?php else: ?>
        <ul class="list-group">
            <?php 
            foreach ($tareas as $t): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <!-- Muestra el título y descripción -->
                        <strong><?= htmlspecialchars($t['titulo']) ?></strong>
                        <small>(<?= htmlspecialchars($t['prioridad']) ?>)</small><br>
                        <span><?= htmlspecialchars($t['descripcion']) ?></span>
                    </div>

                    <!-- Botón para borrar las o la tarea -->
                    <form action="borrar.php" method="POST">
                        <input type="hidden" name="id" value="<?= $t['id'] ?>">
                        <button class="btn btn-sm btn-danger">Borrar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include "includes/footer.php"; ?>