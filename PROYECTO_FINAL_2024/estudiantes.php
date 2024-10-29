<?php
include 'conexion_be.php'; // Asegúrate de tener este archivo con la conexión a la base de datos.

// Consulta para obtener todos los registros de la tabla 'egresados'
$sql = "SELECT * FROM egresados";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Estudiantes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo de la Institución" id="logo">
        <a href="index.html">Inicio</a>
    </header>

    <main>
        <h2>Listado Completo de Estudiantes</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Género</th>
                        <th>Año de Ingreso</th>
                        <th>Año de Graduación</th>
                        <th>Curso de Graduación</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Ocupación Actual</th>
                    </tr>";

            // Mostrar cada registro en una fila de la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['fecha_nacimiento']}</td>
                        <td>{$row['genero']}</td>
                        <td>{$row['año_ingreso']}</td>
                        <td>{$row['año_graduacion']}</td>
                        <td>{$row['curso_graduacion']}</td>
                        <td>{$row['direccion']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['ocupacion_actual']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No se encontraron estudiantes en la base de datos.</p>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </main>
</body>
</html>
