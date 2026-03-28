<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Registro Contable</h1>
<?php
$NumPartida = intval($_GET["NumPartida"]);

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "SELECT r.NumCuenta, c.NombreCuenta, r.DebeHaber, r.Valor
          FROM RegistrosContables r
          JOIN CuentasContables c ON r.NumCuenta = c.NumCuenta
          WHERE r.NumPartida=$NumPartida";
$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

$debe  = null;
$haber = null;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row["DebeHaber"] == 'D') $debe  = $row;
    if ($row["DebeHaber"] == 'H') $haber = $row;
}

mysqli_close($link);
?>
        <p><b>Numero de Partida:</b> <?php echo $NumPartida; ?></p>

        <form action="registros_actualizar.php" method="post">
            <input type="hidden" name="NumPartida"  value="<?php echo $NumPartida; ?>">
            <input type="hidden" name="CuentaDebe"  value="<?php echo $debe["NumCuenta"]; ?>">
            <input type="hidden" name="CuentaHaber" value="<?php echo $haber["NumCuenta"]; ?>">

            <div style="display:flex; gap:40px;">
                <div>
                    <h3>Debe</h3>
                    <p><?php echo $debe["NumCuenta"] . ' - ' . $debe["NombreCuenta"]; ?></p>
                    <label for="ValorDebe">Valor:</label>
                    <input type="text" class="monto" id="ValorDebe" name="ValorDebe" placeholder="Q. 0.00" value="<?php echo $debe["Valor"]; ?>">
                </div>
                <div>
                    <h3>Haber</h3>
                    <p><?php echo $haber["NumCuenta"] . ' - ' . $haber["NombreCuenta"]; ?></p>
                    <label for="ValorHaber">Valor:</label>
                    <input type="text" class="monto" id="ValorHaber" name="ValorHaber" placeholder="Q. 0.00" value="<?php echo $haber["Valor"]; ?>">
                </div>
            </div>

            <input type="submit" value="Guardar cambios">
        </form>
        <a class="volver" href="registros_vista.php">Volver al listado</a>
    </div>
</body>
</html>
