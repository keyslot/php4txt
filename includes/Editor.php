<?php 

require_once('Sesion.php');

class Editor{
        public  $error       = False;
        public  $guardado    = False;
        private $texto       = Null; 
        private $enviar      = Null;
        private $descriptor  = Null;
        private $rutaAchivo  = Null;
        private $tamRegistro = 0;
        private $limiteBytes = 0; 
                
        function __construct($Texto,$Enviar,$rutaAarchivo,$limiteBytes = 1024) {
                $this->texto       = $Texto;
                $this->enviar      = $Enviar;
                $this->rutaAchivo  = $rutaAarchivo;
                $this->limiteBytes = $limiteBytes;
        }

        private function Limpiar(){
                /** Evitar usando javascript **/
                $this->texto = preg_replace('/[\'\·\$\@\.\*\(\)\[\]\;\"\+\¨\=\{\}\?\~\^\!\|\-\_\&\%\#\<\>\-\/]+/','',$this->texto);
                $this->texto = preg_replace('/\n\r/','',$this->texto); /// Eliminar solo lineas vacías
        }

        private  function Validar(){
                return (isset($_POST[$this->enviar], $_POST[$this->texto]));
        }

       public function Procesar(){
            if($this->Validar()) {
                $this->texto = $_POST[$this->texto];
                $this->Limpiar();  /// Solo texto [0-9][A-z][a-z]*
                $this->EscribirArchivo();
              }
            else {
                $this->LeerArchivo();
            }
              
            return $this->texto;
        }

        private function LeerArchivo() {
            try{ 
                $this->AbrirArchivo('r'); 
            
                if ($this->tamRegistro && !($this->texto = fread($this->descriptor,$this->tamRegistro)))
                     throw new Exception("ERROR AL INTENTAR LEER ARCHIVO - REVISAR:");
                $this->CerrarArchivo();
                   
            }catch (Exception $e){
                $this->texto = $e;
                $this->error = True;
            }
            
        }
        
        private function EscribirArchivo() {
          try{ 
                $this->AbrirArchivo('w');
                $this->texto = ($this->texto ? $this->texto : "\r\n");
                if(($this->tamRegistro = strlen($this->texto)) > $this->limiteBytes) 
		   throw new Exception("ERROR, LIMITE DE BYTES SOBRE PASADOS: ".$this->tamRegistro);
                if(!fwrite($this->descriptor,$this->texto,$this->tamRegistro))
		   throw new Exception("ERROR AL INTENTAR ESCRIBIR ARCHIVO - REVISAR:");
                $this->CerrarArchivo();
                $this->guardado = True;
                
            }catch (Exception $e){
                $this->texto = $e;
                $this->error = True;
            }
            
        }
        
        private function AbrirArchivo($modo) {
             if(!file_exists($this->rutaAchivo))
                   throw new Exception("ERROR EL ARCHIVO NO EXISTE - REVISAR: ");
             if(($this->tamRegistro = filesize($this->rutaAchivo)) > $this->limiteBytes)
                   throw new Exception("ERROR EL ARCHIVO ES MUY PESADO - REVISAR: ".$this->limiteBytes);
             if(!($this->descriptor = fopen($this->rutaAchivo,$modo)))
                   throw new Exception("ERROR AL ABRIR ARCHIVO - REVISAR: "); 
                   
        }
        
        private function CerrarArchivo() {
                if(!fclose($this->descriptor))
                    throw new Exception("ERROR AL INTENTAR CERRAR ARCHIVO: ");
                $this->descriptor = Null;
        }
        

} 
?>
