<?php
include('conexion_be.php');

// Variables para el formulario de edición
$editMode = false;
$egresado = null;

// Insertar un nuevo registro en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    // ... [código de inserción aquí]
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
// Editar un registro
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conexion->query("SELECT * FROM egresados WHERE id = $id");
    $egresado = $result->fetch_assoc();
    $editMode = true; // Activar modo edición
}

// Actualizar el registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Obtener datos del formulario de edición
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $año_ingreso = $_POST['año_ingreso'];
    $año_graduacion = $_POST['año_graduacion'];
    $curso_graduacion = $_POST['curso_graduacion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $ocupacion_actual = $_POST['ocupacion_actual'];

    // Actualizar los datos en la tabla egresados
    $sql = "UPDATE egresados SET 
                nombre='$nombre', 
                apellido='$apellido', 
                fecha_nacimiento='$fecha_nacimiento', 
                genero='$genero', 
                año_ingreso='$año_ingreso', 
                año_graduacion='$año_graduacion', 
                curso_graduacion='$curso_graduacion', 
                direccion='$direccion', 
                telefono='$telefono', 
                email='$email', 
                ocupacion_actual='$ocupacion_actual' 
            WHERE id = $id";

    if ($conexion->query($sql)) {
        header("Location: " . $_SERVER['PHP_SELF']); // Redirigir a la misma página
        exit;
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

// Obtener todos los registros si no hay búsqueda
$result = $searchResult ? $searchResult : $conexion->query("SELECT * FROM egresados");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Egresados</title>
    <link rel="stylesheet" href="index1.css">
</head>
<body>
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

    <main>
        <!-- Formulario para buscar por ID -->
        <h3>Buscar Egresado por Documento</h3>
        <form method="POST" action="">
            <input type="text" name="id" placeholder="Ingrese ID de Egresado" required>
            <button type="submit" name="search">Buscar</button>
        </form>

        <!-- Formulario para agregar egresado -->
        <h3><?php echo $editMode ? 'Editar Egresado' : 'Agregar Egresado'; ?></h3>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $editMode ? htmlspecialchars($egresado['id']) : ''; ?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $editMode ? htmlspecialchars($egresado['nombre']) : ''; ?>" required>
            <input type="text" name="apellido" placeholder="Apellido" value="<?php echo $editMode ? htmlspecialchars($egresado['apellido']) : ''; ?>" required>
            <input type="date" name="fecha_nacimiento" value="<?php echo $editMode ? htmlspecialchars($egresado['fecha_nacimiento']) : ''; ?>" required>
            <input type="text" name="genero" placeholder="Género" value="<?php echo $editMode ? htmlspecialchars($egresado['genero']) : ''; ?>" required>
            <input type="number" name="año_ingreso" placeholder="Año de Ingreso" value="<?php echo $editMode ? htmlspecialchars($egresado['año_ingreso']) : ''; ?>" required>
            <input type="number" name="año_graduacion" placeholder="Año de Graduación" value="<?php echo $editMode ? htmlspecialchars($egresado['año_graduacion']) : ''; ?>" required>
            <input type="text" name="curso_graduacion" placeholder="Curso de Graduación" value="<?php echo $editMode ? htmlspecialchars($egresado['curso_graduacion']) : ''; ?>" required>
            <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $editMode ? htmlspecialchars($egresado['direccion']) : ''; ?>" required>
            <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $editMode ? htmlspecialchars($egresado['telefono']) : ''; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $editMode ? htmlspecialchars($egresado['email']) : ''; ?>" required>
            <input type="text" name="ocupacion_actual" placeholder="Ocupación Actual" value="<?php echo $editMode ? htmlspecialchars($egresado['ocupacion_actual']) : ''; ?>" required>
            <button type="submit" name="<?php echo $editMode ? 'update' : 'add'; ?>">
                <?php echo $editMode ? 'Actualizar' : 'Agregar'; ?>
            </button>
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
                            <a href="?edit=<?php echo $row['id']; ?>">Editar</a>
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
