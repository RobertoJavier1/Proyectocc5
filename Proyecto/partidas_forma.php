<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Insertar Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Partida Contable</h1>
        <form action="partidas_insertar.php" method="post">
            <label for="NumPartida">Numero de Partida:</label>
            <input type="text" id="NumPartida" name="NumPartida">

            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="Fecha">

            <label for="Descripcion">Descripcion:</label>
            <input type="text" id="Descripcion" name="Descripcion" maxlength="100">

<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$res = mysqli_query($link, "SELECT NumCuenta, NombreCuenta FROM CuentasContables ORDER BY NumCuenta");
$cuentas = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_close($link);

echo "<div style='display:flex; gap:40px; margin-top:10px;'>\n";

echo "<div>\n";
echo "<h3>Debe</h3>\n";
echo "<label for='CuentaDebe'>Cuenta:</label>\n";
echo "<select id='CuentaDebe' name='CuentaDebe'>\n";
foreach ($cuentas as $row) {
    echo "<option value='{$row['NumCuenta']}'>{$row['NumCuenta']} - " . htmlspecialchars($row['NombreCuenta']) . "</option>\n";
}
echo "</select>\n";
echo "<label for='ValorDebe'>Valor:</label>\n";
echo "<input type='text' class='monto' id='ValorDebe' name='ValorDebe' placeholder='Q. 0.00'>\n";
echo "</div>\n";

echo "<div>\n";
echo "<h3>Haber</h3>\n";
echo "<label for='CuentaHaber'>Cuenta:</label>\n";
echo "<select id='CuentaHaber' name='CuentaHaber'>\n";
foreach ($cuentas as $row) {
    echo "<option value='{$row['NumCuenta']}'>{$row['NumCuenta']} - " . htmlspecialchars($row['NombreCuenta']) . "</option>\n";
}
echo "</select>\n";
echo "<label for='ValorHaber'>Valor:</label>\n";
echo "<input type='text' class='monto' id='ValorHaber' name='ValorHaber' placeholder='Q. 0.00'>\n";
echo "</div>\n";

echo "</div>\n";
?>

            <input type="submit" value="Guardar">
        </form>
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
