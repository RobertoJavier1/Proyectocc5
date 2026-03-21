<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Libro Mayor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Libro Mayor</h1>
        <form action="reporte_mayor.php" method="get">

<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "SELECT NumCuenta, NombreCuenta FROM CuentasContables ORDER BY NumCuenta";
$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

echo "<label for='NumCuenta'>Cuenta:</label>\n";
echo "<select id='NumCuenta' name='NumCuenta'>\n";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='{$row['NumCuenta']}'>{$row['NumCuenta']} - {$row['NombreCuenta']}</option>\n";
}
echo "</select>\n";

mysqli_close($link);
?>

            <input type="submit" value="Ver">
        </form>
        <br><a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
