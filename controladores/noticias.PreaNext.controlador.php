<?php

Class ControladorPreaNextNoticias{

    static public function NoticiaPreaNextId($id, $sign){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        
        $resultado = ModeloPreaNextNoticia::mdlMostrarIDNoticia($tabla1,$tabla2,$tabla3,$id,$sign);

        if($resultado != null){
            return $resultado[0];
        }else{
            return null;
        }
    }

    static public function NoticiaPreaNextIdPrevious($id, $sign){
        $tabla1 = "noticia";
        $tabla2 = "noticia_detalle";
        $tabla3 = "usuario";
        
        $resultadoTwo = ModeloPreaNextNoticia::mdlMostrarIDNoticiaPrevious($tabla1,$tabla2,$tabla3,$id,$sign);

        if($resultadoTwo != null){
            return $resultadoTwo[0];
        }else{
            return null;
        }
    }
}
