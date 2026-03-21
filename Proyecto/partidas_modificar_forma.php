<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Partida Contable</h1>
<?php
$NumPartida = intval($_GET["NumPartida"]);
$Fecha = $_GET["Fecha"];
$Descripcion = $_GET["Descripcion"];
?>
        <form action="partidas_modificar.php" method="post">
            <label>Numero de Partida:</label>
            <p><?php echo $NumPartida; ?></p>
            <input type="hidden" name="NumPartida" value="<?php echo $NumPartida; ?>">

            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="Fecha" value="<?php echo $Fecha; ?>">

            <label for="Descripcion">Descripcion:</label>
            <input type="text" id="Descripcion" name="Descripcion" maxlength="100" value="<?php echo $Descripcion; ?>">

            <input type="submit" value="Guardar cambios">
        </form>
        <a class="volver" href="partidas_listado.php">Volver al listado</a>
    </div>
</body>
</html>
