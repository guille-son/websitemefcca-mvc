<?php
include "../modelos/adelante.modelo.php";

$tipo = $_POST['tipo'];

if($tipo == 'delegaciones'){
    die(ControladorDelegaciones::ctrMostrarDelegaciones());
}

Class ControladorDelegaciones{
    /*====================================================
            MOSTRAR DELEGACIONES
    =====================================================*/

    static public function ctrMostrarDelegaciones(){
        $delegaciones = ModeloDelegacion::mdlMostrarDelegacion();

        return $delegaciones;
    }
}

?>
