<html>
  <head>
     <title>
        Aplicacion de Ejemplo - Eliminar
     </title>
  </head>
  <body>


<?php

$codigo=$_GET["codigo"];

$link = mysqli_connect('localhost', 'root', '','Ejemplo') or die('Could not connect: ' . mysqli_error());

$query = "DELETE FROM Persona WHERE codigo=$codigo";

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

echo 'el registro fue eliminado exitosamente<br>';

mysqli_close($link);


?>


     <center>
         <a href="index.html">regresar</a>
     </center>
  </body>
</html>
