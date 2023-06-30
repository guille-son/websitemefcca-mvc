<?php
require_once "../controladores/videos.controlador.php";
require_once "../modelos/videos.modelo.php";

class TablaVideos {
    // ====================================================== //
    // ================== Tabla de Videoss ================== //
    // ====================================================== //
    public function mostrarTabla(){

        $respuesta = ControladorVideos::ctrMostrarVideos(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarVideo' data-toggle='modal' data-target='#editarVideoModal' id-video='".$value["id"]."' id-estructura='".$value["id_estructura"]."' id-catalogo='".$value["id_catalogo"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarVideo' id-video='".$value["id"]."'><i class='fa fa-trash-alt'></i></button></div></div>";
                    
                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["estructura"].'",
                        "'.$value["catalogo"].'",
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
// =================== Tabla de Videos ================== //
// ====================================================== //
$tabla = new TablaVideos();
$tabla -> mostrarTabla();