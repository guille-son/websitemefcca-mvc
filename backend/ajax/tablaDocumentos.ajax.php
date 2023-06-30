<?php
require_once "../controladores/documentos.controlador.php";
require_once "../modelos/documentos.modelo.php";

class TablaDocumentos {
    // ====================================================== //
    // ================ Tabla de Documentos ================= //
    // ====================================================== //
    public function mostrarTabla(){

        $respuesta = ControladorDocumentos::ctrMostrarDocumentos(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarDocumento' data-toggle='modal' data-target='#editarDocumentoModal' id-documento='".$value["id"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarDocumento' id-documento='".$value["id"]."' ruta-archivo='".$value["archivo"]."' ruta-imagen='".$value["imagen"]."'><i class='fa fa-trash-alt'></i></button></div></div>";
                    $imagen = "<img src='../../../backend/".$value["imagen"]."' class='img-fluid rounded-lg'>";
                    $ext = "<div class='text-center'><span class='btn btn-danger btn-sm'><i class='far fa-file-pdf'></i></span></div>";

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["estructura"].'",
                        "'.$value["catalogo"].'",
                        "'.$value["titulo"].'",
                        "'.$imagen.'",
                        "'.$ext.'",
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
// ================= Tabla de Documentos ================ //
// ====================================================== //
$tabla = new TablaDocumentos();
$tabla -> mostrarTabla();