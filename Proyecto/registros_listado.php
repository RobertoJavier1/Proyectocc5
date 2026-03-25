<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Registros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Listado de Registros Contables</h1>
<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "SELECT r.NumPartida, r.NumCuenta, c.NombreCuenta, r.DebeHaber, r.Valor
          FROM RegistrosContables r
          JOIN CuentasContables c ON r.NumCuenta = c.NumCuenta
          ORDER BY r.NumPartida, r.NumCuenta";

$result = mysqli_query($link, $query)
    or die('Error: ' . mysqli_error($link));

echo "<table>\n";
echo "  <tr><th>Partida</th><th>Cuenta</th><th>Nombre Cuenta</th><th>D/H</th><th>Valor</th><th>Acciones</th></tr>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $np = $row["NumPartida"];
    $nc = $row["NumCuenta"];
    $nom = $row["NombreCuenta"];
    $dhRaw = $row["DebeHaber"];
    $dh = ($dhRaw == 'D') ? 'Debe' : 'Haber';
    $valRaw = $row["Valor"];
    $val = 'Q. ' . number_format($valRaw, 2, '.', ',');
    echo "<tr>\n";
    echo "<td>$np</td><td>$nc</td><td>$nom</td><td>$dh</td><td style='text-align:right; white-space:nowrap'>$val</td>\n";
    echo "<td class='accion'>";
    echo "<a href='registros_modificar_forma.php?NumPartida=$np'>Editar</a>";
    echo "<a class='eliminar' href='registros_eliminar.php?NumPartida=$np&NumCuenta=$nc'>Eliminar</a>";
    echo "</td>\n  </tr>\n";
}

echo "</table>\n";
mysqli_close($link);
?>
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
