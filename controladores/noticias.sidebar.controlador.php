<?php

Class ControladorNoticiasSidebar{
    /*====================================================
        MOSTRAR LAS ULTIMAS 2 NOTICIAS EN EL SIDEBAR
    =====================================================*/

    static public function ctrMostrarNoticiasSidebar($id){
        $tabla1 = "noticia";
        $tabla2 = "usuario";
        $respuesta = ModeloNoticiasSidebar::mdlMostrarNoticiasSidebar($tabla1,$tabla2,$id);

        return $respuesta;
    }

    static public function ctrNoticiasSideBarTopDos(){
        $tabla1 = "noticia";
        $tabla2 = "usuario";
        $respuesta = ModeloNoticiasSidebar::mdlSideBarNoticiasTopDos($tabla1,$tabla2);

        return $respuesta;
    }
}