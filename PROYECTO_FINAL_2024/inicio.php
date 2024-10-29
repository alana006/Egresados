
<?php
include('conexion_be.php')

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institución Educativa</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
    <a href="pagina.php">
    <img src="logo.png" alt="Logo de la Institución" id="logo">
</a>
        <h1>Institución Educativa FELIX DE BEDOUT MORENO</h1>
        <h2>"Educamos en el ser y el conocer con respeto y compromiso"</h2>
        <p>Dirección: Calle 108 No 70 - 39 Barrio Tejelo, MEDELLIN, COLOMBIA</p>
        <p>Teléfono: 463 19 80 - 463 30 90 Coordinación</p>
        <a href="Egresado.html">Egresado</a>
    </header>

    <main>
        <h2>Buscar Perfil de Estudiante</h2>
        <input type="text" id="studentId" placeholder="Ingrese ID de Estudiante"<?php $usuario='id  '?> >
        <button onclick="openStudentProfile()">Buscar</button>

        <div id="profileModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Perfil de Estudiante</h2>
                <p id="studentInfo"></p>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>