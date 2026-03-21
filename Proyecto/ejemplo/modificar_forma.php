<html>
  <head>
     <title>
        Aplicacion de Ejemplo - Modificar
     </title>
  </head>
  <body>
     <form action="modificar.php" method="post">

<?php
    
	$codigo=$_GET["codigo"];
	$nombre=$_GET["nombre"];

	   echo "<b>Codigo: </b>$codigo<br>\n";
       echo "<input type=hidden name=codigo value=$codigo>\n";
       echo "<b>Nombre:</b>\n";

       echo "<input type=text name=nombre value=$nombre length=20><br>\n";

?>

       <input type="submit" name="submit" value="enviar">     
     </form>
     <center>
         <a href="index.html">regresar</a>
     </center>
  </body>
</html>
