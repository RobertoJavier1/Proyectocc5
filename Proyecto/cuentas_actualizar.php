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
//obtener los datos del formulario
$numeroCuenta = intval($_POST["numeroCuenta"]);
$nombreCuenta = $_POST["nombreCuenta"];
$tipo = $_POST["tipo"];

//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//actualizar el nombre y tipo de la cuenta
$query = "UPDATE CuentasContables SET NombreCuenta='$nombreCuenta', Tipo='$tipo' WHERE NumCuenta=$numeroCuenta";

$result = mysqli_query($link, $query) or die('Hubo un error: ' . mysqli_error($link));
echo '<p class="mensaje">La cuenta fue modificada exitosamente.</p>';

mysqli_close($link);
?>
        <a class="volver" href="cuentas_vista.php">Volver al listado</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
