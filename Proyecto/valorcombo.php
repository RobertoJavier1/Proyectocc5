<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto - Seleccion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Resultado</h1>

<?php
$codigo = intval($_POST["codigo"]);
echo "<p>Usted selecciono el codigo: <strong>$codigo</strong></p>";
?>

        <a class="volver" href="combo.php">Volver</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
