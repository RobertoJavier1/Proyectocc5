<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Eliminar Cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Eliminar Cuenta Contable</h1>
<?php

$NumCuenta = intval($_GET["NumCuenta"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$result = mysqli_query($link, "SELECT COUNT(*) FROM RegistrosContables WHERE NumCuenta = $NumCuenta");
$row = mysqli_fetch_row($result);
$total = $row[0];

if ($total > 0) {
    echo '<p style="color:red; font-weight:bold;">Error: no se puede eliminar la cuenta porque tiene registros contables asociados.</p>';
} else {
    mysqli_query($link, "DELETE FROM CuentasContables WHERE NumCuenta = $NumCuenta");
    echo '<p class="mensaje">La cuenta fue eliminada exitosamente.</p>';
}

mysqli_close($link);
?>
        <a class="volver" href="cuentas_vista.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
