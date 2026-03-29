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
//conectar a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

//obtener todas las partidas ordenadas por numero
$query = "SELECT * FROM PartidasContables ORDER BY NumPartida";

$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

echo "<table>\n";
echo " <tr><th>Num</th><th>Fecha</th><th>Descripcion</th><th>Acciones</th></tr>\n";

//recorrer cada partida y generar una fila en la tabla
while ($row = mysqli_fetch_assoc($result)) {
    $num = $row["NumPartida"];
    $fecha = $row["Fecha"];
    $desc = $row["Descripcion"];
    echo "  <tr>\n";
    echo "    <td>$num</td><td>$fecha</td><td>" . htmlspecialchars($desc) . "</td>\n";
    echo "    <td class='accion'>";
    echo "<a href='partidas_actualizar_nuevo.php?NumPartida=$num'>Editar</a>";
    echo "<a class='eliminar' href='partidas_eliminar.php?NumPartida=$num'>Eliminar</a>";
    echo "</td>\n  </tr>\n";
}

echo "</table>\n";
mysqli_close($link);
?>
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
