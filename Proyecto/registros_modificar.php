<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Registro Contable</h1>
<?php
$NumPartida  = intval($_POST["NumPartida"]);
$CuentaDebe  = intval($_POST["CuentaDebe"]);
$ValorDebe   = floatval($_POST["ValorDebe"]);
$CuentaHaber = intval($_POST["CuentaHaber"]);
$ValorHaber  = floatval($_POST["ValorHaber"]);

if ($ValorDebe != $ValorHaber) {
    echo '<p style="color:red; font-weight:bold;">Error: el valor del Debe y el Haber deben ser iguales para que la partida cuadre.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
} else {
    $link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
        or die('No se pudo conectar: ' . mysqli_connect_error());

    $query = "UPDATE RegistrosContables SET Valor=$ValorDebe WHERE NumPartida=$NumPartida AND NumCuenta=$CuentaDebe";
    mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));

    $query = "UPDATE RegistrosContables SET Valor=$ValorHaber WHERE NumPartida=$NumPartida AND NumCuenta=$CuentaHaber";
    mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));

    echo '<p class="mensaje">El registro fue modificado exitosamente.</p>';

    mysqli_close($link);
}
?>
        <a class="volver" href="registros_listado.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
