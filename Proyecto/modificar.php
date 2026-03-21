<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto - Modificar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Persona</h1>

<?php
$codigo = intval($_POST["codigo"]);
$nombre = $_POST["nombre"];

$link = mysqli_connect('localhost', 'root', '', 'Proyecto')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$stmt = mysqli_prepare($link, "UPDATE Persona SET nombre = ? WHERE codigo = ?");
mysqli_stmt_bind_param($stmt, "si", $nombre, $codigo);

if (mysqli_stmt_execute($stmt)) {
    echo '<p class="mensaje">El registro fue modificado exitosamente.</p>';
} else {
    echo '<p>Error: ' . mysqli_error($link) . '</p>';
}

mysqli_stmt_close($stmt);
mysqli_close($link);
?>

        <a class="volver" href="listado.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
