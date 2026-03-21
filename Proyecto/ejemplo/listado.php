<html>
  <head>
     <title>
        Aplicacion de Ejemplo - Listado
     </title>
  </head>
  <body>


<?php

$link = mysqli_connect('localhost', 'root', '', 'Ejemplo') or die('Could not connect: ' . mysqli_error());

$query = "select * from persona order by codigo";

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

$codigo=0;
$nombre="";

echo "<table border=1>\n";
echo "\t<tr>\n";
echo "\t\t<th><b>Codigo</b></th>\n";
echo "\t\t<th>Nombre</th>\n";
echo "\t</tr>\n";

while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {

   $codigo=$line["codigo"];
   $nombre=$line["nombre"];

   echo "\t<tr>\n";
   echo "\t\t<td>$codigo</td>\n";
   echo "\t\t<td>$nombre</td>\n";
   echo "\t\t<td><a href=eliminar.php?codigo=$codigo><img src=icon-remove.png></a></td>\n";
   echo "\t\t<td><a href=modificar_forma.php?codigo=$codigo&nombre=$nombre><img src=icon-edit.jpg></a></td>\n";
   echo "\t</tr>\n";
}
echo "</table>\n";


mysqli_close($link);


?>




     <center>
         <a href="index.html">regresar</a>
     </center>
  </body>
</html>
