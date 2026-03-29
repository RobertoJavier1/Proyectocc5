<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Eliminar Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Eliminar Partida Contable</h1>
<?php
//obtener el numero de partida desde la url
$numPartida = intval($_GET["NumPartida"]);

//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//eliminar primero los registros para no violar la llave foranea
mysqli_query($link, "DELETE FROM RegistrosContables WHERE NumPartida=$numPartida")
    or die('Hubo un error al eliminar los registros: ' . mysqli_error($link));

//luego eliminar la partida
mysqli_query($link, "DELETE FROM PartidasContables WHERE NumPartida=$numPartida")
    or die('Hubo un error al eliminar la partida: ' . mysqli_error($link));

echo '<p class="mensaje">La partida y sus registros fueron eliminados exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="partidas_vista.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
