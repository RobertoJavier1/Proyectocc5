<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Insertar Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Insertar Registro Contable</h1>
        <form action="registros_insertar.php" method="post">

<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

// Combo de partidas existentes
$resP = mysqli_query($link, "SELECT NumPartida, Fecha, Descripcion FROM PartidasContables ORDER BY NumPartida");
$partidas = mysqli_fetch_all($resP, MYSQLI_ASSOC);

echo "<label for='NumPartida'>Partida:</label>\n";
if ($partidas) {
    echo "<select id='NumPartida' name='NumPartida'>\n";
    foreach ($partidas as $p) {
        $desc = htmlspecialchars($p['NumPartida'] . ' — ' . $p['Fecha']);
        echo "  <option value='{$p['NumPartida']}'>{$desc}</option>\n";
    }
    echo "</select>\n";
} else {
    echo "<p style='color:red'>No hay partidas registradas. <a href='partidas_forma.html'>Crear una partida</a> primero.</p>\n";
}

// Opciones de cuentas para reusar en ambos combos
$query = "SELECT NumCuenta, NombreCuenta FROM CuentasContables ORDER BY NumCuenta";
$res2 = mysqli_query($link, $query);
$cuentas = mysqli_fetch_all($res2, MYSQLI_ASSOC);

mysqli_close($link);

// Combo cuentas Debe
echo "<div style='display:flex; gap:40px;'>\n";

echo "<div>\n";
echo "<h3>Debe</h3>\n";
echo "<label for='CuentaDebe'>Cuenta:</label>\n";
echo "<select id='CuentaDebe' name='CuentaDebe'>\n";
foreach ($cuentas as $row) {
    echo "<option value='{$row['NumCuenta']}'>{$row['NumCuenta']} - {$row['NombreCuenta']}</option>\n";
}
echo "</select>\n";
echo "<label for='ValorDebe'>Valor:</label>\n";
echo "<input type='text' class='monto' id='ValorDebe' name='ValorDebe' placeholder='Q. 0.00'>\n";
echo "</div>\n";

// Combo cuentas Haber
echo "<div>\n";
echo "<h3>Haber</h3>\n";
echo "<label for='CuentaHaber'>Cuenta:</label>\n";
echo "<select id='CuentaHaber' name='CuentaHaber'>\n";
foreach ($cuentas as $row) {
    echo "<option value='{$row['NumCuenta']}'>{$row['NumCuenta']} - {$row['NombreCuenta']}</option>\n";
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
