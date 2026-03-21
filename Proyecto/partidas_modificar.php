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
$NumPartida = intval($_POST["NumPartida"]);
$Fecha = $_POST["Fecha"];
$Descripcion = $_POST["Descripcion"];

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "UPDATE PartidasContables SET Fecha='$Fecha', Descripcion='$Descripcion' WHERE NumPartida=$NumPartida";

$result = mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));
echo '<p class="mensaje">La partida fue modificada exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="partidas_listado.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
