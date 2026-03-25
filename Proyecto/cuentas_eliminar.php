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

$query = "DELETE FROM RegistrosContables WHERE NumCuenta=$NumCuenta";
mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));

$query = "DELETE FROM CuentasContables WHERE NumCuenta=$NumCuenta";
mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));
echo '<p class="mensaje">La cuenta fue eliminada exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="cuentas_listado.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
