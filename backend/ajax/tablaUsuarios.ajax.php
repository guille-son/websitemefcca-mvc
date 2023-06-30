<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios {
    // ====================================================== //
    // =================== Tabla Usuarios =================== //
    // ====================================================== //
    public function mostrarTabla(){
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios(null, null);

        if(count($respuesta) == 0){
            $datosJSON = '{"data" : []}';

            echo $datosJSON;

            return;
        }

        $datosJSON = '{
            "data" : [';
                foreach ($respuesta as $key => $value) {
                    $acciones = "<div class='text-center'><div class='btn-group'><button class='btn bg-warning btn-sm margin editarUsuario' data-toggle='modal' data-target='#editarUsuarioModal' id-usuario='".$value["id"]."' id-rol='".$value["rol_id"]."'><i class='fa fa-pencil-alt text-white'></i></button><button class='btn bg-danger btn-sm margin eliminarUsuario' id-usuario='".$value["id"]."'><i class='fa fa-trash-alt'></i></button></div></div>";

                    $datosJSON .=
                    '[
                        "'.($key+1).'",
                        "'.$value["nombre_completo"].'",
                        "'.$value["usuario"].'",
                        "'.$value["correo"].'",
                        "'.$value["rol_id"].'",
                        "'.$value["rol"].'",
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
// =================== Tabla Usuarios =================== //
// ====================================================== //
$tabla = new TablaUsuarios();
$tabla -> mostrarTabla();