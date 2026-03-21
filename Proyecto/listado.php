<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto - Listado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Listado de Personas</h1>

<?php
$link = mysqli_connect('localhost', 'root', '', 'Proyecto')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query  = "SELECT * FROM Persona ORDER BY codigo";
$result = mysqli_query($link, $query)
    or die('Error en consulta: ' . mysqli_error($link));

echo "<table>\n";
echo "  <tr><th>Codigo</th><th>Nombre</th><th>Acciones</th></tr>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $codigo = $row["codigo"];
    $nombre = htmlspecialchars($row["nombre"]);
    echo "  <tr>\n";
    echo "    <td>$codigo</td>\n";
    echo "    <td>$nombre</td>\n";
    echo "    <td class='accion'>";
    echo "<a href='modificar_forma.php?codigo=$codigo&nombre=" . urlencode($nombre) . "'>Editar</a>";
    echo "<a class='eliminar' href='eliminar.php?codigo=$codigo'>Eliminar</a>";
    echo "</td>\n";
    echo "  </tr>\n";
}

echo "</table>\n";

mysqli_close($link);
?>

        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
