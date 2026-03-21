<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Insertar Cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Cuenta Contable</h1>
<?php
// intval para convertir a entero
$NumCuenta = intval($_POST["NumCuenta"]);
$NombreCuenta = $_POST["NombreCuenta"];
$Tipo = $_POST["Tipo"];

mysqli_report(MYSQLI_REPORT_OFF);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "INSERT INTO CuentasContables VALUES ($NumCuenta, '$NombreCuenta', '$Tipo')";

$result = mysqli_query($link, $query);

if ($result) {
    echo '<p class="mensaje">La cuenta fue insertada exitosamente.</p>';
} else if (mysqli_errno($link) == 1062) {
    echo '<p style="color:red; font-weight:bold;">Error: ya existe una cuenta con el numero ' . $NumCuenta . '.</p>';
} else {
    echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
}

mysqli_close($link);
?>
        <a class="volver" href="javascript:history.back()">Regresar</a>
        &nbsp;|&nbsp;
        <a class="volver" href="cuentas_listado.php">Ver listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
