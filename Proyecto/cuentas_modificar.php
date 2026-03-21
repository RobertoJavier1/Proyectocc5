<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Cuenta Contable</h1>
<?php
$NumCuenta = intval($_POST["NumCuenta"]);
$NombreCuenta = $_POST["NombreCuenta"];
$Tipo = $_POST["Tipo"];

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "UPDATE CuentasContables SET NombreCuenta='$NombreCuenta', Tipo='$Tipo' WHERE NumCuenta=$NumCuenta";

$result = mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));
echo '<p class="mensaje">La cuenta fue modificada exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="cuentas_listado.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
