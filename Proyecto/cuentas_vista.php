<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Cuentas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Listado de Cuentas Contables</h1>
<?php
$tipos = [
    'A' => 'Activo',
    'P' => 'Pasivo',
    'C' => 'Capital',
    'I' => 'Ingreso',
    'G' => 'Gasto'
];

$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
    or die('No se pudo conectar: ' . mysqli_connect_error());

$query = "SELECT * FROM CuentasContables ORDER BY NumCuenta";

$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));

echo "<table>\n";
echo "<tr><th>Num</th><th>Nombre</th><th>Tipo</th><th>Acciones</th></tr>\n";

while ($row = mysqli_fetch_assoc($result)) {
    $num = $row["NumCuenta"];
    $nombre = $row["NombreCuenta"];
    $tipo = $row["Tipo"];
    //traduccion para devolever el nombre del tipo no la letra
    $tipotxt = $tipos[$tipo];
    echo "<tr>\n";
    echo "<td>$num</td><td>$nombre</td><td>$tipotxt</td>\n";
    echo "<td class='accion'>";
    // urlencode convierte el nombre a formato URL espacios y simbolos para que el link no se rompa
    echo "<a href='cuentas_actualizar_nuevo.php?NumCuenta=$num&NombreCuenta=" . urlencode($nombre) . "&Tipo=$tipo'>Editar</a>";
    echo "<a class='eliminar' href='cuentas_eliminar.php?NumCuenta=$num'>Eliminar</a>";
    echo "</td>\n  </tr>\n";
}

echo "</table>\n";
mysqli_close($link);
?>
        <a class="volver" href="index.html">Volver al menu</a>
    </div>
</body>
</html>
