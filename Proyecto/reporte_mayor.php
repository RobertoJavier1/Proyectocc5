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

<?php
$NumCuenta = intval($_GET["NumCuenta"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//obtener nombre de la cuenta
$query = "SELECT NombreCuenta FROM CuentasContables WHERE NumCuenta=$NumCuenta";
$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
$cuenta = mysqli_fetch_assoc($result);

echo "<p><b>EMPRESA BOB INDUSTRIES</b></p>\n";
echo "<p><b>CUENTA:</b> {$cuenta['NombreCuenta']}</p><br>\n";

//obtener todos los registros de esa cuenta
$query = "SELECT r.NumPartida, p.Fecha, p.Descripcion, r.DebeHaber, r.Valor
          FROM RegistrosContables r
          JOIN PartidasContables p ON r.NumPartida = p.NumPartida
          WHERE r.NumCuenta=$NumCuenta
          ORDER BY p.Fecha, r.NumPartida";
$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

$totalDebe = 0;
$totalHaber = 0;

echo "<table>\n";
echo "<tr><th>Partida</th><th>Fecha</th><th>Descripcion</th><th style='text-align:right'>Debe</th><th style='text-align:right'>Haber</th></tr>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $np = $row["NumPartida"];
    $fecha = $row["Fecha"];
    $desc = $row["Descripcion"];
    $valor = $row["Valor"];
    $dh = $row["DebeHaber"];

    if ($dh == 'D') {
        $totalDebe += $valor;
        $debe = 'Q. ' . number_format($valor, 2, '.', ',');
        $haber = '';
    } else {
        $totalHaber += $valor;
        $debe = '';
        $haber = 'Q. ' . number_format($valor, 2, '.', ',');
    }

    echo "<tr>\n";
    echo "<td>#$np</td><td style='white-space:nowrap'>$fecha</td><td>$desc</td>\n";
    echo "<td style='text-align:right; white-space:nowrap'>$debe</td>\n";
    echo "<td style='text-align:right; white-space:nowrap'>$haber</td>\n";
    echo "</tr>\n";
}

$saldo = abs($totalDebe - $totalHaber);
$saldoDebe  = ($totalDebe >= $totalHaber) ? 'Q. ' . number_format($saldo, 2, '.', ',') : '';
$saldoHaber = ($totalHaber > $totalDebe)  ? 'Q. ' . number_format($saldo, 2, '.', ',') : '';

echo "<tr>\n";
echo "<td></td><td></td><td></td>\n";
echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalDebe, 2, '.', ',') . "</td>\n";
echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalHaber, 2, '.', ',') . "</td>\n";
echo "</tr>\n";

echo "<tr>\n";
echo "<td></td><td></td><td style='text-align:right'><b>Saldo</b></td>\n";
echo "<td style='text-align:right; white-space:nowrap'>$saldoDebe</td>\n";
echo "<td style='text-align:right; white-space:nowrap'>$saldoHaber</td>\n";
echo "</tr>\n";
echo "</table>\n";

mysqli_close($link);
?>

        <br><a class="volver" href="reporte_mayor_nuevo.php">Volver</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
