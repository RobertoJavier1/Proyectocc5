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
//intval para convertirlo a int
$NumCuenta = intval($_GET["NumCuenta"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$stmt = mysqli_prepare($link, "SELECT COUNT(*) FROM RegistrosContables WHERE NumCuenta = ?");
mysqli_stmt_bind_param($stmt, "i", $NumCuenta);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $total);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($total > 0) {
    echo '<p style="color:red; font-weight:bold;">Error: no se puede eliminar la cuenta porque tiene registros contables asociados.</p>';
} else {
    $stmt = mysqli_prepare($link, "DELETE FROM CuentasContables WHERE NumCuenta = ?");
    mysqli_stmt_bind_param($stmt, "i", $NumCuenta);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
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
