<?php

require_once('includes/Administrador.php');

$limpiar = new Sesion();
$limpiar->Limpiar();

$admon = array('usuario' => "admon", 
               'password' => "admon",
	       'sesiones' => 5);

$login = new Administrador($admon);
$login->Iniciar('campo1','campo2','enviar');

if($login->error){ /*** Contar, Bloquear IPs  **/}

?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <meta charset="utf-8">
  </head>

   <body>
      
            
            <form class="" method="POST" action="index.php" autocomplete="off">
             
                    <label for="usuario">usuario:</label>
                    <input type="text" class=""      placeholder="admon" name="campo1" minlength="" maxlength="" required>
             
                    <label for="protegido">contraseña:</label>
                    <input type="password" class=""  placeholder="admon" name="campo2" minlength="" maxlength="" required>

		    <button type="submit" class="" name="enviar">Iniciar</button>
            
	    </form>
            

   
  </body>
</html>
