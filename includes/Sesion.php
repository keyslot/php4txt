<?php 

class Sesion {

    public $actual;
    public $contador;
    
    function __construct(){
	$this->actual = $this->contador = 0;
        session_start();
    }
        
    public function Validar() {
        if(!isset($_SESSION['actual'], $_SESSION['contador']) || !$_SESSION['contador']) 
            $this->Destruir();
        else
	    $this->actual = $_SESSION['actual'];
	    $this->contador = $_SESSION['contador']--;
    }
        
    public function Crear($actual,$sesiones) {
      $_SESSION['actual'] = $actual;
      $_SESSION['contador'] = $sesiones ;
      header('location: editar.php');

    }
    public function Destruir() {
        $this->Limpiar();
        header('location: index.php');
    }
    
    public function Limpiar() {
        session_destroy();
    }
}



?>
