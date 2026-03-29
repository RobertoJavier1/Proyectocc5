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
$NumPartida  = intval($_POST["NumPartida"]);
$Fecha       = $_POST["Fecha"];
$Descripcion = $_POST["Descripcion"];
$CuentaDebe  = intval($_POST["CuentaDebe"]);
$CuentaHaber = intval($_POST["CuentaHaber"]);
$rawDebe     = $_POST["ValorDebe"];
$rawHaber    = $_POST["ValorHaber"];
$ValorDebe   = floatval($rawDebe);
$ValorHaber  = floatval($rawHaber);

$enlaces_error = '<a class="volver" href="javascript:history.back()">Regresar</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="partidas_vista.php">Ver listado</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="index.html">Volver al menu</a>';

if (!is_numeric($rawDebe) || !is_numeric($rawHaber)) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser un numero valido. Use punto para decimales (ej: 1500.00), no se aceptan comas.</p>';
    echo $enlaces_error;
    exit;
}

if (trim($Fecha) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la fecha no puede estar vacia.</p>';
    echo $enlaces_error;
    exit;
}

if (trim($Descripcion) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la descripcion no puede estar vacia.</p>';
    echo $enlaces_error;
    exit;
}

if ($CuentaDebe === $CuentaHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: la cuenta del Debe y la del Haber no pueden ser la misma.</p>';
    echo $enlaces_error;
    exit;
}

if ($ValorDebe != $ValorHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor del Debe y el Haber deben ser iguales para que la partida cuadre.</p>';
    echo $enlaces_error;
    exit;
}

if ($ValorDebe <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser mayor a cero.</p>';
    echo $enlaces_error;
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$result = mysqli_query($link, "UPDATE PartidasContables SET Fecha='$Fecha', Descripcion='$Descripcion' WHERE NumPartida=$NumPartida");

if (!$result) {
    echo '<p style="color:red; font-weight:bold;">Hubo un error al modificar la partida: ' . mysqli_error($link) . '</p>';
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

//reemplazar registros, borrar los actuales e insertar los nuevos
mysqli_query($link, "DELETE FROM RegistrosContables WHERE NumPartida = $NumPartida");

$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaDebe, 'D', $ValorDebe)");

if (!$result) {
    echo '<p style="color:red; font-weight:bold;">Hubo un error al guardar el registro Debe: ' . mysqli_error($link) . '</p>';
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaHaber, 'H', $ValorHaber)");

if (!$result) {
    echo '<p style="color:red; font-weight:bold;">Hubo un error al guardar el registro Haber: ' . mysqli_error($link) . '</p>';
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

mysqli_close($link);

echo '<p class="mensaje">La partida fue modificada exitosamente.</p>';
echo '<a class="volver" href="partidas_vista.php">Volver al listado</a>';
echo ' &nbsp;|&nbsp; ';
echo '<a class="volver" href="index.html">Volver al menu</a>';
?>
    </div>
</body>
</html>
