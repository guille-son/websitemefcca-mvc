<?php

class ControladorRadio
{
    /*====================================================
            MOSTRAR LA NOTICIA SELECCIONADA
    =====================================================*/

    static public function ctrMostrarRadio()
    {
        $tabla1 = "programa_radio";
        $tabla2 = "usuario";
        $respuesta = ModeloRadio::mdlMostrarRadio($tabla1, $tabla2);

        return $respuesta;
    }

    static public function ctrMostrarRadioPrincipal()
    {
        $tabla1 = "programa_radio";
        $tabla2 = "usuario";
        $respuesta = ModeloRadio::mdlMostrarRadio($tabla1, $tabla2);

        return $respuesta;
    }
}
