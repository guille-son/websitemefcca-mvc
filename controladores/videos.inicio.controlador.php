<?php
Class ControladorVideosInicio{
    /*====================================================
            MOSTRAR LOS ULTIMOS VIDEOS EN EL INICIO
    =====================================================*/

    static public function ctrMostrarVideosInicio(){
        $respuesta = ModeloVideosInicio::mdlMostrarVideosInicio();

        return $respuesta;
    }

    static public function ctrMostrarVideosSideBar($estructuraId){
        $respuesta = ModeloVideosInicio::mdlVideosSideBar($estructuraId);

        return $respuesta;
    }

    static public function ctrCategoriasVideos(){
        $respuesta = ModeloVideosInicio::mdlObtenerCategoriasVideos();

        return $respuesta;
    }
}