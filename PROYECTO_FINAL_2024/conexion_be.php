<?php
$servidor = "localhost";     // Por lo general es "localhost" en XAMPP
$usuario = "root";           // Usuario por defecto en XAMPP
$password = "";              // Contraseña vacía en XAMPP por defecto
$nombre_bd = "felix_informacion_prueba"; // Cambia esto al nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $nombre_bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
