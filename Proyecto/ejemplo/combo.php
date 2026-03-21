<html>
  <head>
     <title>
        Aplicacion de Ejemplo - Seleccion
     </title>
  </head>
  <body>


<form action=valorcombo.php method=post>

<?php

$link = mysqli_connect('localhost', 'root', '', 'Ejemplo' ) or die('Could not connect: ' . mysql_error());

$query = "select * from persona order by codigo";
$result = mysqli_query($link, $query) or die('Query failed: ' . mysqli_error($link));

$codigo=0;
$nombre="";

echo "<select name=codigo>\n";

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

   $codigo=$line["codigo"];
   $nombre=$line["nombre"];

   echo "<option value=$codigo>$codigo=$nombre</option>\n";
}

echo "</select>\n";




mysqli_close($link);


?>

 <input type=submit value=enviar>
 </form>



     <center>
         <a href="index.html">regresar</a>
     </center>
  </body>
</html>
