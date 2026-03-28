<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Insertar Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Registro Contable</h1>
<?php
$NumPartida = intval($_POST["NumPartida"]);
$CuentaDebe = intval($_POST["CuentaDebe"]);
$ValorDebe = floatval($_POST["ValorDebe"]);
$CuentaHaber = intval($_POST["CuentaHaber"]);
$ValorHaber = floatval($_POST["ValorHaber"]);

$enlaces_error = '<a class="volver" href="javascript:history.back()">Regresar</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="registros_vista.php">Ver listado</a>'
    . ' &nbsp;|&nbsp; '
    . '<a class="volver" href="index.html">Volver al menu</a>';

if ($CuentaDebe === $CuentaHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: la cuenta del Debe y la del Haber no pueden ser la misma.</p>';
    echo $enlaces_error;
} elseif ($ValorDebe != $ValorHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor del Debe y el Haber deben ser iguales para que la partida cuadre.</p>';
    echo $enlaces_error;
} else {
    mysqli_report(MYSQLI_REPORT_OFF);

    $link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
        or die('No se pudo conectar: ' . mysqli_connect_error());

    $query = "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaDebe, 'D', $ValorDebe)";
    $result = mysqli_query($link, $query);

    if (!$result) {
        if (mysqli_errno($link) == 1062) {
            echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para la partida ' . $NumPartida . ' con la cuenta Debe seleccionada.</p>';
        } else {
            echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
        }
        echo $enlaces_error;
        mysqli_close($link);
    } else {
        $query = "INSERT INTO RegistrosContables VALUES ($NumPartida, $CuentaHaber, 'H', $ValorHaber)";
        $result = mysqli_query($link, $query);

        if (!$result) {
            if (mysqli_errno($link) == 1062) {
                echo '<p style="color:red; font-weight:bold;">Error: ya existe un registro para la partida ' . $NumPartida . ' con la cuenta Haber seleccionada.</p>';
            } else {
                echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
            }
            echo $enlaces_error;
        } else {
            echo '<p class="mensaje">El registro fue insertado exitosamente.</p>';
            echo '<a class="volver" href="registros_nuevo.php">Insertar otro registro</a>';
            echo ' &nbsp;|&nbsp; ';
            echo '<a class="volver" href="registros_vista.php">Ver listado</a>';
            echo ' &nbsp;|&nbsp; ';
            echo '<a class="volver" href="index.html">Volver al menu</a>';
        }

        mysqli_close($link);
    }
}
?>
    </div>
</body>
</html>
