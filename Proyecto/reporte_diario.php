<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Libro de Diario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Libro de Diario</h1>

<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//determinar si busca por partida o por fecha
if (isset($_GET["NumPartida"]) && $_GET["NumPartida"] != '') {
    $numPartida = intval($_GET["NumPartida"]);
    $query = "SELECT * FROM PartidasContables WHERE NumPartida=$numPartida";
} elseif (isset($_GET["Fecha"]) && $_GET["Fecha"] != '') {
    $fecha = $_GET["Fecha"];
    $query = "SELECT * FROM PartidasContables WHERE Fecha='$fecha'";
} else {
    echo '<p style="color:red; font-weight:bold;">Error: debe ingresar un numero de partida o una fecha.</p>';
    mysqli_close($link);
    exit;
}

$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

while ($partida = mysqli_fetch_assoc($result)) {
    $np = $partida["NumPartida"];
    $fecha = $partida["Fecha"];
    $desc = $partida["Descripcion"];

    echo "<p><b>EMPRESA BOB INDUSTRIES</b></p>\n";
    echo "<p><b>NUMERO DE PARTIDA:</b> $np</p>\n";
    echo "<p><b>FECHA:</b> $fecha</p>\n";
    echo "<p><b>DESCRIPCION:</b> " . htmlspecialchars($desc) . "</p>\n";

    //registros de esta partida
    $query2 = "SELECT r.DebeHaber, r.Valor, c.NombreCuenta
               FROM RegistrosContables r
               JOIN CuentasContables c ON r.NumCuenta = c.NumCuenta
               WHERE r.NumPartida=$np
               ORDER BY r.DebeHaber ASC";
    $result2 = mysqli_query($link, $query2) or die('Error: ' . mysqli_error($link));

    $totalDebe = 0;
    $totalHaber = 0;

    echo "<table>\n";
    echo "<tr><th>Cuenta</th><th style='text-align:right'>Debe</th><th style='text-align:right'>Haber</th></tr>\n";

    while ($row = mysqli_fetch_assoc($result2)) {
        $nombre = $row["NombreCuenta"];
        $valor = $row["Valor"];
        $dh = $row["DebeHaber"];

        if ($dh == 'D') {
            $totalDebe += $valor;
            $debe  = 'Q. ' . number_format($valor, 2, '.', ',');
            $haber = '';
        } else {
            $totalHaber += $valor;
            $debe  = '';
            $haber = 'Q. ' . number_format($valor, 2, '.', ',');
        }

        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($nombre) . "</td>\n";
        echo "<td style='text-align:right; white-space:nowrap'>$debe</td>\n";
        echo "<td style='text-align:right; white-space:nowrap'>$haber</td>\n";
        echo "</tr>\n";
    }

    echo "<tr>\n";
    echo "<td></td>\n";
    echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalDebe, 2, '.', ',') . "</td>\n";
    echo "<td style='text-align:right; border-top:2px solid #333; white-space:nowrap'>Q. " . number_format($totalHaber, 2, '.', ',') . "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br>\n";
}

mysqli_close($link);
?>

        <a class="volver" href="reporte_diario_nuevo.html">Volver</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
