<?php

require_once "../controladores/radio.controlador.php";
require_once "../modelos/radio.modelo.php";

class TablaRadio {
    // ====================================================== //
    // ============== Tabla Programas Radiales ============== //
    // ====================================================== //
    public function mostrarTabla(){
        $respuesta = ControladorRadio::ctrMostrarProgramasRadio(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarRadio' data-toggle='modal' data-target='#editarRadioModal' id-radio='".$value["id"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarRadio' id-radio='".$value["id"]."' ruta='".$value["link"]."'><i class='fa fa-trash-alt'></i></button></div></div>";

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["tema"].'",
                        "'.$value["fecha"].'",
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
// ============== Tabla Programas Radiales ============== //
// ====================================================== //
$tabla = new TablaRadio();
$tabla -> mostrarTabla();