<?php
require_once "../controladores/delegaciones.controlador.php";
require_once "../modelos/delegaciones.modelo.php";

class TablaDelegaciones {
    // ====================================================== //
    // =============== Tabla de Delegaciones ================ //
    // ====================================================== //
    public function mostrarTabla(){

        $respuesta = ControladorDelegaciones::ctrMostrarDelegaciones(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarDelegaciones' data-toggle='modal' data-target='#editarDelegacionModal' id-delegacion='".$value["id"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarDelegacion' id-delegacion='".$value["id"]."' ruta-imagen='".$value["imagen"]."'><i class='fa fa-trash-alt'></i></button></div></div>";
                    $imagen = "<img src='../../../backend/".$value["imagen"]."' class='img-fluid rounded-lg'>";
                    
                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["nombre_delegacion"].'",
                        "'.$value["delegado"].'",
                        "'.$value["telefono"].'",
                        "'.$imagen.'",
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
// ================ Tabla de Delegaciones =============== //
// ====================================================== //
$tabla = new TablaDelegaciones();
$tabla -> mostrarTabla();