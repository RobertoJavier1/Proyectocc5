<html>
  <head>
     <title>
        Aplicacion de Ejemplo - Modificar
     </title>
  </head>
  <body>


<?php

$codigo=$_POST["codigo"];
$nombre=$_POST["nombre"];

$link = mysqli_connect('localhost', 'root', '','Ejemplo') or die('Could not connect: ' . mysql_error());

$query = "UPDATE Persona SET nombre='$nombre' WHERE codigo=$codigo";

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
echo "el registro fue modificado exitosamente<br>";

mysqli_close($link);


?>

     <center>
         <a href="index.html">regresar</a>
     </center>
  </body>
</html>
