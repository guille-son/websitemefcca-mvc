<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";

class TablaNoticias {

    // ====================================================== //
    // =================== Tabla Noticias =================== //
    // ====================================================== //
    public function mostrarTabla()
    {
        $respuesta = ControladorNoticias::ctrMostrarNoticias(null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><a href='index.php?pagina=noticias&idNoticia=".$value["id"]."' class='btn btn-secondary btn-sm btnVisualizarNoti'><i class='far fa-eye'></i></a></div>";

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["estructura"].'",
                        "'.$value["titulo"].'",
                        "'.$acciones.'"
                    ],';
                }
        $datosJSON = substr($datosJSON, 0, -1);
        $datosJSON .='
            ]
        }';

        echo $datosJSON;

    }

}

// ====================================================== //
// =================== Tabla Noticias =================== //
// ====================================================== //
$tabla = new TablaNoticias();
$tabla -> mostrarTabla();