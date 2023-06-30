<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class TablaBanner {
    // ====================================================== //
    // ==================== Tabla Banner ==================== //
    // ====================================================== //
    public function mostrarTabla(){
        $respuesta = ControladorBanner::ctrMostrarBanner(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{

            "data" : [';

                foreach ($respuesta as $key => $value) {

                    $imagen = "<img src='../../../backend/".$value["imagen"]."' class='img-fluid rounded-lg'>";

                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarBanner' data-toggle='modal' data-target='#editarBannerModal' id-banner='".$value["id"]."' orden='".$value["orden"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarBanner' id-banner='".$value["id"]."' ruta-imagen='".$value["imagen"]."'><i class='fa fa-trash-alt'></i></button></div></div>";

                    if($value["estado"] == 0) {

                        $estado = "<div class='text-center'><button class='btn btn-success btn-sm btnHabilitarBanner' estadoBanner='1' id-banner='".$value["id"]."'>Habilitado</button></div>";

                    } else {

                        $estado = "<div class='text-center'><button class='btn btn-danger btn-sm btnHabilitarBanner' estadoBanner='0' id-banner='".$value["id"]."'>Deshabilitado</button></div>";

                    }

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["orden"].'",
                        "'.$imagen.'",
                        "'.$estado.'",
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
// ==================== Tabla Banner ==================== //
// ====================================================== //
$tabla = new TablaBanner();
$tabla -> mostrarTabla();