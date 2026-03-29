<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Balance de Saldos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Balance de Saldos</h1>

<?php
//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//obtener totales de debe y haber por cuenta con left join para incluir cuentas sin registros
$query = "SELECT c.NumCuenta, c.NombreCuenta, c.Tipo,
          sum(if(r.DebeHaber='D', r.Valor, 0)) as Debe,
          sum(if(r.DebeHaber='H', r.Valor, 0)) as Haber
          FROM CuentasContables c
          LEFT JOIN RegistrosContables r ON c.NumCuenta = r.NumCuenta
          GROUP BY c.NumCuenta, c.NombreCuenta, c.Tipo
          ORDER BY c.Tipo, c.NumCuenta";

$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

$tipos = [
    'A' => 'ACTIVO',
    'P' => 'PASIVO',
    'C' => 'CAPITAL',
    'I' => 'INGRESO',
    'G' => 'GASTO'
];

//agrupar por tipo
$datos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $datos[$row["Tipo"]][] = $row;
}

$totalDebe  = 0;
$totalHaber = 0;

echo "<p><b>EMPRESA BOB INDUSTRIES</b></p>\n";
echo "<table>\n";
echo "<tr><th>Cuenta</th><th style='text-align:right'>Debe</th><th style='text-align:right'>Haber</th></tr>\n";

//recorrer los tipos en orden e imprimir cada seccion
foreach ($tipos as $tipo => $nombreTipo) {
    //si no hay cuentas de este tipo se omite la seccion
    if (!isset($datos[$tipo])) continue;

    echo "<tr><td colspan='3' style='font-weight:bold; padding-top:10px'>$nombreTipo</td></tr>\n";

    foreach ($datos[$tipo] as $row) {
        $nombre = $row["NombreCuenta"];
        $debe = $row["Debe"];
        $haber = $row["Haber"];

        $totalDebe += $debe;
        $totalHaber += $haber;

        $debeStr = $debe  > 0 ? 'Q. ' . number_format($debe,  2, '.', ',') : '';
        $haberStr = $haber > 0 ? 'Q. ' . number_format($haber, 2, '.', ',') : '';

        echo "<tr>\n";
        echo "<td style='padding-left:20px'>$nombre</td>\n";
        echo "<td style='text-align:right; white-space:nowrap'>$debeStr</td>\n";
        echo "<td style='text-align:right; white-space:nowrap'>$haberStr</td>\n";
        echo "</tr>\n";
    }
}

echo "<tr>\n";
echo "<td></td>\n";
echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalDebe, 2, '.', ',') . "</td>\n";
echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalHaber, 2, '.', ',') . "</td>\n";
echo "</tr>\n";
echo "</table>\n";

mysqli_close($link);
?>

        <br><a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
