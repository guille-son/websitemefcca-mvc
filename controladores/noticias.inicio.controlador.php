<?php

Class ControladorNoticiasInicio{
    /*====================================================
            MOSTRAR LAS ULTIMAS NOTICIAS EN EL INICIO
    =====================================================*/

    static public function ctrMostrarNoticiasInicio(){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        $respuesta = ModeloNoticiasInicio::mdlMostrarNoticiasInicio($tabla1,$tabla2,$tabla3);

        return $respuesta;
    }

    static public function ctrMostrarNoticiasJuridico(){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        $respuesta = ModeloNoticiasInicio::mdlMostrarNoticiasJuridico($tabla1,$tabla2,$tabla3);

        return $respuesta;
    }

    static public function ctrMostrarTodasNoticias(){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        $respuesta = ModeloNoticiasInicio::mdlMostrarTodasNoticias($tabla1,$tabla2,$tabla3);

        return $respuesta;
    }
}