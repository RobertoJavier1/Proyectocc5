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
$numPartida = intval($_POST["NumPartida"]);
$fecha = $_POST["Fecha"];
$descripcion = $_POST["Descripcion"];
$cuentaDebe = intval($_POST["CuentaDebe"]);
$cuentaHaber = intval($_POST["CuentaHaber"]);
//guardar los valores crudos para validar que sean numericos antes de convertir
$rawDebe = $_POST["ValorDebe"];
$rawHaber = $_POST["ValorHaber"];
$valorDebe = floatval($rawDebe);
$valorHaber = floatval($rawHaber);

//enlaces de navegacion para mostrar en caso de error
$enlacesError = '<a class="volver" href="javascript:history.back()">Regresar</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="partidas_vista.php">Ver listado</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="index.html">Volver al menu</a>';

//validar que el numero de partida sea un entero positivo
if ($numPartida <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el numero de partida debe ser un entero positivo.</p>';
    echo $enlacesError;
    exit;
}

//validar que la fecha no este vacia
if (trim($fecha) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la fecha no puede estar vacia.</p>';
    echo $enlacesError;
    exit;
}

//validar que la descripcion no este vacia
if (trim($descripcion) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: la descripcion no puede estar vacia.</p>';
    echo $enlacesError;
    exit;
}

//validar que la cuenta del debe y el haber sean diferentes
if ($cuentaDebe === $cuentaHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: la cuenta del Debe y la del Haber no pueden ser la misma.</p>';
    echo $enlacesError;
    exit;
}

//validar que los valores sean iguales para que la partida cuadre
if ($valorDebe != $valorHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor del Debe y el Haber deben ser iguales para que la partida cuadre.</p>';
    echo $enlacesError;
    exit;
}

//validar que los valores sean numericos validos, sin letras ni comas
if (!is_numeric($rawDebe) || !is_numeric($rawHaber)) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser un numero valido. Use punto para decimales (ej: 1500.00), no se aceptan comas.</p>';
    echo $enlacesError;
    exit;
}

//validar que el valor sea mayor a cero
if ($valorDebe <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor debe ser mayor a cero.</p>';
    echo $enlacesError;
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//insertar la partida contable
$result = mysqli_query($link, "INSERT INTO PartidasContables VALUES ($numPartida, '$fecha', '$descripcion')");

if (!$result) {
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe una partida con el numero ' . $numPartida . '.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
    }
    echo $enlacesError;
    mysqli_close($link);
    exit;
}

//insertar el registro debe
$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($numPartida, $cuentaDebe, 'D', $valorDebe)");

if (!$result) {
    //si falla se elimina la partida para no dejar datos incompletos
    mysqli_query($link, "DELETE FROM PartidasContables WHERE NumPartida = $numPartida");
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para esa partida con la cuenta Debe seleccionada.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error al insertar el registro Debe: ' . mysqli_error($link) . '</p>';
    }
    echo $enlacesError;
    mysqli_close($link);
    exit;
}

//insertar el registro haber
$result = mysqli_query($link, "INSERT INTO RegistrosContables VALUES ($numPartida, $cuentaHaber, 'H', $valorHaber)");

if (!$result) {
    //si falla se elimina el registro debe y la partida para no dejar datos incompletos
    mysqli_query($link, "DELETE FROM RegistrosContables WHERE NumPartida = $numPartida AND NumCuenta = $cuentaDebe");
    mysqli_query($link, "DELETE FROM PartidasContables WHERE NumPartida = $numPartida");
    if (mysqli_errno($link) == 1062) {
        echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para esa partida con la cuenta Haber seleccionada.</p>';
    } else {
        echo '<p style="color:red; font-weight:bold;">Hubo un error al insertar el registro Haber: ' . mysqli_error($link) . '</p>';
    }
    echo $enlacesError;
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
