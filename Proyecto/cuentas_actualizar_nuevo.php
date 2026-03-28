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
//intval para convertir a int
$NumCuenta = intval($_GET["NumCuenta"]);
$NombreCuenta = $_GET["NombreCuenta"];
$Tipo = $_GET["Tipo"];
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
            <p><?php echo $NumCuenta; ?></p>
            <input type="hidden" name="NumCuenta" value="<?php echo $NumCuenta; ?>">

            <label for="NombreCuenta">Nombre de Cuenta:</label>
            <input type="text" id="NombreCuenta" name="NombreCuenta" maxlength="50" value="<?php echo $NombreCuenta; ?>">


            <label for="Tipo">Tipo:</label>
            <select id="Tipo" name="Tipo">
             <!-- Recorre el arreglo de tipos para generar cada opcion del select
             $val = codigo (A, P, C, I, G), $label = nombre (Activo, Pasivo....) -->
                <?php foreach ($tipos as $val => $label): ?>
                <option value="<?php echo $val; ?>" <?php echo ($Tipo == $val) ? 'selected' : ''; ?>>
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
