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
$codigo = intval($_GET["codigo"]);
$nombre = htmlspecialchars($_GET["nombre"]);
?>

        <form action="modificar.php" method="post">
            <label>Codigo:</label>
            <p><?php echo $codigo; ?></p>
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="20" value="<?php echo $nombre; ?>">

            <input type="submit" value="Guardar cambios">
        </form>
        <a class="volver" href="listado.php">Volver al listado</a>
    </div>
</body>
</html>
