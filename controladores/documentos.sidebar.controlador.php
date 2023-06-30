<?php
Class ControladorDocumentosSideBar{
    /*====================================================
            MOSTRAR LOS ULTIMOS DOCUMENTOOS EN EL SIDE BAR FILTRADOS POR EL ID DE LA ESTRUCTURA
    =====================================================*/

    static public function ctrMostrarDocumentosSideBar($estructuraId){
        $respuesta = ModeloDocumentosSideBar::mdlDocumentosSideBar($estructuraId);

        return $respuesta;
    }

    static public function ctrCategoriasDocumentos(){
        $respuesta = ModeloDocumentosSideBar::mdlObtenerCategoriasDocumentos();

        return $respuesta;
    }

    static public function ctrDocumentosInicio(){
        $respuesta = ModeloDocumentosSideBar::mdlDocumentosInicio();

        return $respuesta;
    }

    static public function ctrTotalDocumentosEstructura($estructuraId){
        $respuesta = ModeloDocumentosSideBar::mdlTotalDocEstructura($estructuraId);

        return $respuesta;
    }

    static public function ctrSideDocumentosEstructura($estructuraId){
        $respuesta = ModeloDocumentosSideBar::mdlDocEstructuraSideBar($estructuraId);

        return $respuesta;
    }
}