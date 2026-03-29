<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contabilidad - Modificar Cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Modificar Cuenta Contable</h1>
<?php

$numeroCuenta = intval($_GET["NumCuenta"]);
$nombreCuenta = $_GET["NombreCuenta"];
$tipo = $_GET["Tipo"];
$tipos = [
    'A' => 'Activo',
    'P' => 'Pasivo',
    'C' => 'Capital',
    'I' => 'Ingreso',
    'G' => 'Gasto'
];

?>
        <form action="cuentas_actualizar.php" method="post">
            <label>Numero de Cuenta:</label>
            <p><?php echo $numeroCuenta; ?></p>
            <input type="hidden" name="numeroCuenta" value="<?php echo $numeroCuenta; ?>">

            <label for="nombreCuenta">Nombre de Cuenta:</label>
            <input type="text" id="nombreCuenta" name="nombreCuenta" maxlength="50" value="<?php echo $nombreCuenta; ?>">


            <label for="tipo">tipo:</label>
            <select id="tipo" name="tipo">
             <!-- recorre el arreglo de tipos para generar cada opcion del select
             $val = codigo (A,P,C,I,G), $label = nombre (Activo,Pasivo,etc) -->
                <?php foreach ($tipos as $val => $label): ?>
                <option value="<?php echo $val; ?>" <?php echo ($tipo == $val) ? 'selected' : ''; ?>>
                    <?php echo $label; ?>
                </option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Guardar cambios">
        </form>
        <a class="volver" href="cuentas_vista.php">Volver al listado</a>
    </div>
</body>
</html>
