<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto - Seleccionar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Seleccionar Persona</h1>

        <form action="valorcombo.php" method="post">
<?php
$link = mysqli_connect('localhost', 'root', '', 'Proyecto')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query  = "SELECT * FROM Persona ORDER BY codigo";
$result = mysqli_query($link, $query)
    or die('Error en consulta: ' . mysqli_error($link));

echo "<label for='codigo'>Persona:</label>\n";
echo "<select id='codigo' name='codigo'>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $codigo = $row["codigo"];
    $nombre = htmlspecialchars($row["nombre"]);
    echo "  <option value='$codigo'>$codigo - $nombre</option>\n";
}

echo "</select>\n";

mysqli_close($link);
?>
            <input type="submit" value="Seleccionar">
        </form>
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
