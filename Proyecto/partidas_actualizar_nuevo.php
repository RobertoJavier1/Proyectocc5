<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Partida Contable</h1>
<?php
$numeroPartida = intval($_GET["NumPartida"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//cargar datos de la partida
$res = mysqli_query($link, "SELECT Fecha, Descripcion FROM PartidasContables WHERE NumPartida = $numeroPartida");
$partida = mysqli_fetch_assoc($res);

if (!$partida) {
    echo '<p style="color:red; font-weight:bold;">Error: partida no encontrada.</p>';
    echo '<a class="volver" href="partidas_vista.php">Volver al listado</a>';
    mysqli_close($link);
    exit;
}

//cargar registros Debe y Haber de esta partida
$res = mysqli_query($link, "SELECT NumCuenta, DebeHaber, Valor FROM RegistrosContables WHERE NumPartida = $numeroPartida");
$registros = [];
while ($row = mysqli_fetch_assoc($res)) {
    $registros[$row['DebeHaber']] = $row;
}

$cuentaDebe  = isset($registros['D']) ? $registros['D']['NumCuenta'] : 0;
$valorDebe   = isset($registros['D']) ? $registros['D']['Valor']     : '';
$cuentaHaber = isset($registros['H']) ? $registros['H']['NumCuenta'] : 0;
$valorHaber  = isset($registros['H']) ? $registros['H']['Valor']     : '';

//cargar todas las cuentas para los combos
$res = mysqli_query($link, "SELECT NumCuenta, NombreCuenta FROM CuentasContables ORDER BY NumCuenta");
$cuentas = mysqli_fetch_all($res, MYSQLI_ASSOC);

mysqli_close($link);
?>
        <form action="partidas_actualizar.php" method="post">
            <input type="hidden" name="NumPartida" value="<?php echo $numeroPartida; ?>">

            <label>Numero de Partida:</label>
            <p><?php echo $numeroPartida; ?></p>

            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="Fecha" value="<?php echo $partida['Fecha']; ?>">

            <label for="Descripcion">Descripcion:</label>
            <input type="text" id="Descripcion" name="Descripcion" maxlength="100" value="<?php echo htmlspecialchars($partida['Descripcion']); ?>">

<?php
echo "<div style='display:flex; gap:40px; margin-top:10px;'>\n";

echo "<div>\n";
echo "<h3>Debe</h3>\n";
echo "<label for='CuentaDebe'>Cuenta:</label>\n";
echo "<select id='CuentaDebe' name='CuentaDebe'>\n";
foreach ($cuentas as $row) {
    $sel = ($row['NumCuenta'] == $cuentaDebe) ? " selected" : "";
    echo "<option value='{$row['NumCuenta']}'{$sel}>{$row['NumCuenta']} - " . htmlspecialchars($row['NombreCuenta']) . "</option>\n";
}
echo "</select>\n";
echo "<label for='ValorDebe'>Valor:</label>\n";
echo "<input type='text' class='monto' id='ValorDebe' name='ValorDebe' value='" . htmlspecialchars($valorDebe) . "'>\n";
echo "</div>\n";

echo "<div>\n";
echo "<h3>Haber</h3>\n";
echo "<label for='CuentaHaber'>Cuenta:</label>\n";
echo "<select id='CuentaHaber' name='CuentaHaber'>\n";
foreach ($cuentas as $row) {
    $sel = ($row['NumCuenta'] == $cuentaHaber) ? " selected" : "";
    echo "<option value='{$row['NumCuenta']}'{$sel}>{$row['NumCuenta']} - " . htmlspecialchars($row['NombreCuenta']) . "</option>\n";
}
echo "</select>\n";
echo "<label for='ValorHaber'>Valor:</label>\n";
echo "<input type='text' class='monto' id='ValorHaber' name='ValorHaber' value='" . htmlspecialchars($valorHaber) . "'>\n";
echo "</div>\n";

echo "</div>\n";
?>

            <input type="submit" value="Guardar cambios">
        </form>
        <a class="volver" href="partidas_vista.php">Volver al listado</a>
    </div>
</body>
</html>
