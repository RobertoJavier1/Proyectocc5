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
//obtener y convertir los datos del formulario
$NumeroCuenta = intval($_POST["NumCuenta"]);
$NombreCuenta = $_POST["NombreCuenta"];
$Tipo = $_POST["Tipo"];

//validar que el numero de cuenta sea un entero positivo
if ($NumeroCuenta <= 0) {
    echo '<p style="color:red; font-weight:bold;">Error: el numero de cuenta debe ser un entero positivo.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
    exit;
}

//validar que el nombre de cuenta no este vacio
if (trim($NombreCuenta) === '') {
    echo '<p style="color:red; font-weight:bold;">Error: el nombre de cuenta no puede estar vacio.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
    exit;
}

//desactivar los reportes automaticos de MYSQL
mysqli_report(MYSQLI_REPORT_OFF);

//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//insertar la nueva cuenta
$query = "INSERT INTO CuentasContables VALUES ($NumeroCuenta, '$NombreCuenta', '$Tipo')";

$result = mysqli_query($link, $query);

//verificar si la insercion fue exitosa
if ($result) {
    echo '<p class="mensaje">La cuenta fue insertada exitosamente.</p>';
    echo '<a class="volver" href="cuentas_nuevo.html">Insertar otro registro</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_vista.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
//error 1062 significa que ya existe una cuenta con ese numero
} else if (mysqli_errno($link) == 1062) {
    echo '<p style="color:red; font-weight:bold;">Error: ya existe una cuenta con el numero ' . $NumeroCuenta . '.</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_vista.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
} else {
    echo '<p style="color:red; font-weight:bold;">Hubo un error: ' . mysqli_error($link) . '</p>';
    echo '<a class="volver" href="javascript:history.back()">Regresar</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="cuentas_vista.php">Ver listado</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a class="volver" href="index.html">Volver al menu</a>';
}

mysqli_close($link);
?>
    </div>
</body>
</html>
