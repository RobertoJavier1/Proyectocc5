<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto - Insertar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Persona</h1>

<?php
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];

$link = mysqli_connect('localhost', 'root', '', 'Proyecto')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$stmt = mysqli_prepare($link, "INSERT INTO Persona VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "is", $codigo, $nombre);

if (mysqli_stmt_execute($stmt)) {
    echo '<p class="mensaje">El registro fue insertado exitosamente.</p>';
} else {
    echo '<p>Error: ' . mysqli_error($link) . '</p>';
}

mysqli_stmt_close($stmt);
mysqli_close($link);
?>

        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
