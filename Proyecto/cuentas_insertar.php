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

if ($NumCuenta <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el numero de cuenta debe ser un entero positivo.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
    exit;
}

if (trim($NombreCuenta) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: el nombre de cuenta no puede estar vacio.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "INSERT INTO CuentasContables VALUES ($NumCuenta, '$NombreCuenta', '$Tipo')";

$result = mysqli_query($link, $query);

if ($result) {
    echo '<p class="mensaje">La cuenta fue insertada exitosamente.</p>';
    echo '<a class="volver" href="cuentas_forma.html">Insertar otro registro</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_listado.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
} else if (mysqli_errno($link) == 1062) {
    echo '<p style="color:red; font-weight:bold;">Error: ya existe una cuenta con el numero ' . $NumCuenta . '.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_listado.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
} else {
    echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_listado.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
}

mysqli_close($link);
?>
    </div>
</body>
</html>
