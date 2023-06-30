<?php

require_once "../controladores/transmisiones.controlador.php";
require_once "../modelos/transmisiones.modelo.php";

class TablaTransmisiones {
    // ====================================================== //
    // ================= Tabla Transmisiones ================ //
    // ====================================================== //
    public function mostrarTabla(){
        $respuesta = ControladorTransmisiones::ctrMostrarTransmisiones(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarTransmision' data-toggle='modal' data-target='#editarTransmisionModal' id-transmision='".$value["id"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarTransmision' id-transmision='".$value["id"]."'><i class='fa fa-trash-alt'></i></button></div></div>";
                    
                    if($value["estado"] == 0) {

                        $estado = "<div class='text-center'><button class='btn btn-success btn-sm btnActivarTransmision' estadoTransmision='1' id-transmision='".$value["id"]."'>En curso</button></div>";

                    } else {

                        $estado = "<div class='text-center'><button class='btn btn-danger btn-sm btnActivarTransmision' estadoTransmision='0' id-transmision='".$value["id"]."'>Finalizado</button></div>";

                    }
                    
                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["titulo"].'",
                        "'.$value["hora"].'",
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
// ================= Tabla Transmisiones ================ //
// ====================================================== //
$tabla = new TablaTransmisiones();
$tabla -> mostrarTabla();