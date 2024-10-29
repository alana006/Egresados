<?php
include('conexion_be.php');

// Insertar un nuevo registro en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $año_ingreso = $_POST['año_ingreso'] ?? '';
    $año_graduacion = $_POST['año_graduacion'] ?? '';
    $curso_graduacion = $_POST['curso_graduacion'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $ocupacion_actual = $_POST['ocupacion_actual'] ?? '';

    // Insertar los datos en la tabla egresados
    $sql = "INSERT INTO egresados (nombre, apellido, fecha_nacimiento, genero, año_ingreso, año_graduacion, curso_graduacion, direccion, telefono, email, ocupacion_actual)
            VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$genero', '$año_ingreso', '$año_graduacion', '$curso_graduacion', '$direccion', '$telefono', '$email', '$ocupacion_actual')";

    if (!$conexion->query($sql)) {
        echo "Error al agregar el registro: " . $conexion->error;
    }
}

// Eliminar un registro
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (!$conexion->query("DELETE FROM egresados WHERE id = $id")) {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

// Búsqueda de registro por documento (id)
$searchResult = null;
if (isset($_POST['search'])) {
    $id = $_POST['id'];
    $searchResult = $conexion->query("SELECT * FROM egresados WHERE id = '$id'");
}

// Obtener todos los registros si no hay búsqueda
$result = $searchResult ? $searchResult : $conexion->query("SELECT * FROM egresados");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Egresados</title>
    <link rel="stylesheet" href="index1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <header>
    <header>
    <a href="index.php">
    <img src="logo.png" alt="Logo de la Institución" id="logo">
</a>
        <h1>Institución Educativa FELIX DE BEDOUT MORENO</h1>
        <h2>"Educamos en el ser y el conocer con respeto y compromiso"</h2>
        <p>Dirección: Calle 108 No 70 - 39 Barrio Tejelo, MEDELLIN, COLOMBIA</p>
        <p>Teléfono: 463 19 80 - 463 30 90 Coordinación</p>
        <a href="index1.php">Egresado</a>
    </header>
    </header>

    <main>
        <!-- Formulario para buscar por ID -->
        <h3>Buscar Egresado por Documento</h3>
        <form method="POST" action="">
            <input type="text" name="id" placeholder="Ingrese ID de Egresado" required>
            <button type="submit" name="search">Buscar</button>
        </form>

        <!-- Formulario para agregar egresado -->
        <h3>Agregar Egresado</h3>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="date" name="fecha_nacimiento" required>
            <input type="text" name="genero" placeholder="Género" required>
            <input type="number" name="año_ingreso" placeholder="Año de Ingreso" required>
            <input type="number" name="año_graduacion" placeholder="Año de Graduación" required>
            <input type="text" name="curso_graduacion" placeholder="Curso de Graduación" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="ocupacion_actual" placeholder="Ocupación Actual" required>
            <button type="submit" name="add">Agregar</button>
        </form>

        <!-- Mostrar todos los egresados -->
        <h3>Lista de Egresados</h3>
        <table border="1">
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
                <th>Acciones</th>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                        <td><?php echo htmlspecialchars($row['genero']); ?></td>
                        <td><?php echo htmlspecialchars($row['año_ingreso']); ?></td>
                        <td><?php echo htmlspecialchars($row['año_graduacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['curso_graduacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['ocupacion_actual']); ?></td>
                        <td>
                            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este egresado?')">Eliminar</a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13">No se encontraron egresados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</body>
</html>
