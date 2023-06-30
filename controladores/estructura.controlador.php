<?php

Class ControladorEstructura{
    /*====================================================
    CARGAR LOS TITULOS DE LAS ESTRUCTURAS EN EL INICIO
    =====================================================*/

    static public function ctrCargarTitulosEstructura($codigo){
        $tabla1 = "informacion_estructura";
        $tabla2 = "catalogo";
        $respuesta = ModeloEstructura::mdlCargarTitulosDirecciones($tabla1, $tabla2, $codigo);

        return $respuesta;
    }

    /*====================================================
            MOSTRAR LA ESTRUCTURA SELECCIONADA
    =====================================================*/

    static public function ctrMostrarEstructura($id){
        $tabla1 = "informacion_estructura";
        $tabla2 = "catalogo";
        $respuesta = ModeloEstructura::mdlMostrarEstructura($tabla1, $tabla2, $id);

        return $respuesta;
    }
}