<?php 

require_once('Sesion.php');

class Administrador {      
      private $secret_usuario = "none";  
      private $secret_password = "none";
      private $longitud_usuario = 0; 
      private $longitud_password = 0;
      private $sesiones = 0;
      public  $error = False;
      
      function __construct($secret = NULL) {
              if(isset($secret, $secret['usuario'], $secret['password'], $secret['sesiones'])) {
                 $this->secret_usuario  = $secret['usuario'];
                 $this->secret_password = $secret['password'];
                 $this->longitud_usuario = strlen($secret['usuario']);
                 $this->longitud_password = strlen($secret['password']);
		 $this->sesiones = $secret['sesiones'];
               }

      }
      
      private function vectorEquivalente($x,$y,$limite) {
            for($i = 0; $i < $limite; $i++) 
                if(!isset($x[$i]) || $x[$i] != $y[$i]) return False;
            
            return (!isset($x[$limite]));
      }
      
      protected function Autentificar($usuario,$password,$firma) {
            
            if (!isset($_POST[$firma]))                     
                return False;
            
            if($this->vectorEquivalente($_POST[$usuario],$this->secret_usuario,$this->longitud_usuario) &&
               $this->vectorEquivalente($_POST[$password],$this->secret_password,$this->longitud_password))
               return True;
               
            $this->error = True;
                
            return False;
      }      
      
      public function Iniciar($usuario,$password,$firma) {
           if($this->Autentificar($usuario,$password,$firma)) {
             $sesion = new Sesion();
             $sesion->Crear($this->secret_usuario, $this->sesiones);
             }
      }
        
}
?>
