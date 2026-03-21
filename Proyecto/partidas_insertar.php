<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Insertar Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Partida Contable</h1>
<?php
$NumPartida = intval($_POST["NumPartida"]);
$Fecha = $_POST["Fecha"];
$Descripcion = $_POST["Descripcion"];

mysqli_report(MYSQLI_REPORT_OFF);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "INSERT INTO PartidasContables VALUES ($NumPartida, '$Fecha', '$Descripcion')";

$result = mysqli_query($link, $query);

if ($result) {
    echo '<p class="mensaje">La partida fue insertada exitosamente.</p>';
} else if (mysqli_errno($link) == 1062) {
    echo '<p style="color:red; font-weight:bold;">Error: ya existe una partida con el numero ' . $NumPartida . '.</p>';
} else {
    echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
}

mysqli_close($link);
?>
        <a class="volver" href="javascript:history.back()">Regresar</a>
        &nbsp;|&nbsp;
        <a class="volver" href="partidas_listado.php">Ver listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
