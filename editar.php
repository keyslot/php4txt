<?php 

require_once('includes/Editor.php');

$sesion = new Sesion();
$sesion->Validar();

$bytes = 4096000; // 1kb = 1024 * 4000 cáracteres  (bytes)  
$registro = new Editor('Texto','Enviar','Archivo.txt', $bytes); 
$texto = $registro->Procesar();
$guardado = $registro->guardado;
$errorFatal = $registro->error;

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Editar</title>
    <script> function autoCerrar() { location.href= "cerrar.php"; } setTimeout(autoCerrar,500000); /**  5 minutos  **/ </script>
    <style> textarea{ width:900px; } </style>
  </head>

   <body>
   
    <section>
        <h3>Bienvenido <?php echo $sesion->actual;?></h3>
	
	Total de operaciones permitidas <?php echo $sesion->contador; ?>

        <?php if($guardado) : ?>
                 
              <h3>¡Guardado!</h3>
               
         <?php  endif  ?>      
      
      
      
        <form method="POST" class="" action="editar.php" autocomplete="off">
            <textarea maxlength="<?php echo $bytes - 1?>" 
            class=""  name="Texto" rows="11"><?php  echo $texto ?></textarea>

            <?php if(!$errorFatal) : /*** No errores ***/ ?>
               
               <button class="" type="submit" name="Enviar">Guardar</button>
               
          <?php endif ?>
             
        </form>
        
        <a href="cerrar.php"> Salir </a>
        
   </section>

    
  </body>
</html>
