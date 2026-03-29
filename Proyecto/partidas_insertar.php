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
//obtener y convertir los datos del formulario
$NumPartida = intval($_POST["NumPartida"]);
$Fecha = $_POST["Fecha"];
$Descripcion = $_POST["Descripcion"];
$CuentaDebe = intval($_POST["CuentaDebe"]);
$CuentaHaber = intval($_POST["CuentaHaber"]);
//guardar los valores crudos para validar que sean numericos antes de convertir
$rawDebe = $_POST["ValorDebe"];
$rawHaber = $_POST["ValorHaber"];
$ValorDebe = floatval($rawDebe);
$ValorHaber = floatval($rawHaber);

//enlaces de navegacion para mostrar en caso de error
$enlaces_error = '<a class="volver" href="javascript:history.back()">Regresar</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="partidas_vista.php">Ver listado</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="index.html">Volver al menu</a>';

//validar que el numero de partida sea un entero positivo
if ($NumPartida <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el numero de partida debe ser un entero positivo.</p>';
    echo $enlaces_error;
    exit;
}

//validar que la fecha no este vacia
if (trim($Fecha) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la fecha no puede estar vacia.</p>';
    echo $enlaces_error;
    exit;
}

//validar que la descripcion no este vacia
if (trim($Descripcion) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la descripcion no puede estar vacia.</p>';
    echo $enlaces_error;
    exit;
}

//validar que la cuenta del debe y el haber sean diferentes
if ($CuentaDebe === $CuentaHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: la cuenta del Debe y la del Haber no pueden ser la misma.</p>';
    echo $enlaces_error;
    exit;
}

//validar que los valores sean iguales para que la partida cuadre
if ($ValorDebe != $ValorHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor del Debe y el Haber deben ser iguales para que la partida cuadre.</p>';
    echo $enlaces_error;
    exit;
}

//validar que los valores sean numericos validos, sin letras ni comas
if (!is_numeric($rawDebe) || !is_numeric($rawHaber)) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser un numero valido. Use punto para decimales (ej: 1500.00), no se aceptan comas.</p>';
    echo $enlaces_error;
    exit;
}

//validar que el valor sea mayor a cero
if ($ValorDebe <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser mayor a cero.</p>';
    echo $enlaces_error;
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//insertar la partida contable
$result = mysqli_query($link, "INSERT INTO PartidasContables VALUES ($NumPartida, '$Fecha', '$Descripcion')");

if (!$result) {
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe una partida con el numero ' . $NumPartida . '.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
    }
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

//insertar el registro debe
$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaDebe, 'D', $ValorDebe)");

if (!$result) {
    //si falla se elimina la partida para no dejar datos incompletos
    mysqli_query($link, "DELETE FROM PartidasContables WHERE NumPartida = $NumPartida");
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para esa partida con la cuenta Debe seleccionada.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error al insertar el registro Debe: ' . mysqli_error($link) . '</p>';
    }
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

//insertar el registro haber
$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaHaber, 'H', $ValorHaber)");

if (!$result) {
    //si falla se elimina el registro debe y la partida para no dejar datos incompletos
    mysqli_query($link, "DELETE FROM RegistrosContables WHERE NumPartida = $NumPartida AND NumCuenta = $CuentaDebe");
    mysqli_query($link, "DELETE FROM PartidasContables WHERE NumPartida = $NumPartida");
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para esa partida con la cuenta Haber seleccionada.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error al insertar el registro Haber: ' . mysqli_error($link) . '</p>';
    }
    echo $enlaces_error;
    mysqli_close($link);
    exit;
}

mysqli_close($link);

echo '<p class="mensaje">La partida y sus registros fueron insertados exitosamente.</p>';
echo '<a class="volver" href="partidas_nuevo.php">Insertar otra partida</a>';
echo ' &nbsp;|&nbsp; ';
echo '<a class="volver" href="partidas_vista.php">Ver listado</a>';
echo ' &nbsp;|&nbsp; ';
echo '<a class="volver" href="index.html">Volver al menu</a>';
?>
    </div>
</body>
</html>
