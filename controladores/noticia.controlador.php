<?php

Class ControladorNoticia{
    /*====================================================
            MOSTRAR LA NOTICIA SELECCIONADA
    =====================================================*/

    static public function ctrMostrarNoticia($id){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        $respuesta = ModeloNoticia::mdlMostrarNoticia($tabla1,$tabla2,$tabla3,$id);

        return $respuesta;
    }
}