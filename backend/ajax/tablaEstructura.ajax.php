<?php

require_once "../controladores/estructura.controlador.php";
require_once "../modelos/estructura.modelo.php";

class TablaEstructura {
    // ====================================================== //
    // ================== Tabla Estructura ================== //
    // ====================================================== //
    public function mostrarTabla(){
        $respuesta = ControladorEstructura::ctrMostrarEstructura(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><a href='index.php?pagina=estructura&idEstructura=".$value["id"]."' class='btn btn-secondary btn-sm btnVisualizarEstructura'><i class='far fa-eye'></i></a></div>";

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
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
// ================== Tabla Estructura ================== //
// ====================================================== //
$tabla = new TablaEstructura();
$tabla -> mostrarTabla();