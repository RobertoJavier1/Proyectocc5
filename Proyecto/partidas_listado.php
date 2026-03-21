<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Partidas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Listado de Partidas Contables</h1>
<?php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "SELECT * FROM PartidasContables ORDER BY NumPartida";

$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

echo "<table>\n";
echo " <tr><th>Num</th><th>Fecha</th><th>Descripcion</th><th>Acciones</th></tr>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $num = $row["NumPartida"];
    $fecha = $row["Fecha"];
    $desc = $row["Descripcion"];
    echo "  <tr>\n";
    echo "    <td>$num</td><td>$fecha</td><td>$desc</td>\n";
    echo "    <td class='accion'>";
    echo "<a href='partidas_modificar_forma.php?NumPartida=$num&Fecha=" . urlencode($fecha) . "&Descripcion=" . urlencode($desc) . "'>Editar</a>";
    echo "<a class='eliminar' href='partidas_eliminar.php?NumPartida=$num'>Eliminar</a>";
    echo "</td>\n  </tr>\n";
}

echo "</table>\n";
mysqli_close($link);
?>
        <br><a class="volver" href="partidas_forma.html">Insertar nueva partida</a>
        &nbsp;|&nbsp;
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
