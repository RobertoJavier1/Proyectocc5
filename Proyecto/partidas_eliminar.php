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
$NumPartida = intval($_GET["NumPartida"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "DELETE FROM PartidasContables WHERE NumPartida=$NumPartida";

$result = mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));
echo '<p class="mensaje">La partida fue eliminada exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="partidas_vista.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
