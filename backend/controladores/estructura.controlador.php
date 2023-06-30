<?php

class ControladorEstructura {

    /* ===================================================
    MOSTRAR LAS ESTRUCTURAS CON INNER JOIN
    ======================================================*/
    static public function ctrMostrarEstructura($item, $valor)
    {
        $tabla1 = "informacion_estructura";
        $tabla2 = "catalogo";

        $respuesta = ModeloEstructura::mdlMostrarEstructuras($tabla1, $tabla2, $item, $valor);

        return $respuesta;
    }

    /* ===================================================
    CRAGRA LAS ESTRUCTURAS AL EDITAR UN VIDEO
    ======================================================*/
    static public function ctrCargarEstructura($id)
    {
        $tabla = "informacion_estructura";

        $respuesta = ModeloEstructura::mdlCargarEstructuras($tabla, $id);

        return $respuesta;
    }

    // ====================================================== //
    // ================ Registro de Estructura ============== //
    // ====================================================== //
    static public function ctrRegistroEstructura($datos){

        include_once 'obtener.ip.controlador.php';
        include_once 'nombrarcarpeta.controlador.php';
        include_once 'alertas.controlador.php';
        
        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        $imagenPrincipal = ControladorAlertas::ctrImagenPrincipal();
        
        if(preg_match('/^[\/\;\\"\\?\\¿\\!\\¡\\:\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"])){

            if($datos["imagen"] != ""){

                // ======================================================
                // Guardamos la imagen principal
                // ========================================================
                $serverPrincipal = $_SERVER['DOCUMENT_ROOT']."/backend/";
                $directorioPrincipal = "../../../backend/vistas/img/estructuras";

                $id = ModeloEstructura::mdlRegistroConsecutivo();
                $catalogo = ControladorNombrarCarpeta::ctrNombrarCarpeta($datos['catalogo']);
                $aleatorio = mt_rand(1000,9999);

                if($datos["tipoImagen"] == "image/jpeg" || $datos["tipoImagen"] == "image/jpg") {

                    $rutaImagenPrincipal = strtolower($directorioPrincipal."/estructura_".$catalogo.$aleatorio.$id['id'].".jpg");

                    $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);
        
                    $origen = imagecreatefromjpeg($datos["imagen"]);
        
                    imagejpeg($origen, $serverPrincipal.$rutaImagenPrincipal);

                } else {

                    $rutaImagenPrincipal = strtolower($directorioPrincipal."/estructura_".$catalogo.$aleatorio.$id['id'].".png");

                    $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);

                    $origen = imagecreatefrompng($datos["imagen"]);

                    imagealphablending($origen, FALSE);
    
                    imagesavealpha($origen, TRUE);

                    imagepng($origen, $serverPrincipal.$rutaImagenPrincipal);

                }

                session_start();
                $tabla = "informacion_estructura";
                
                $datos = array(
                    "id_catalogo" => $datos["idCatalogo"],
                    "titulo" => $datos["titulo"],
                    "imagen" => $rutaImagenPrincipal,
                    "descripcion" => $datos["descripcion"],
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloEstructura::mdlRegistroEstructura($tabla, $datos);

                if($respuesta == "ok"){

                    $mensaje = array(
                        'mensaje' => 'exito',
                        'alerta' => $guardado,
                    );

                }

            } else {

                $mensaje = array(
                    'mensaje' => 'imagen-vacia',
                    'alerta' => $imagenPrincipal
                );

            }

        } else {

            $mensaje = array(
                'mensaje' => 'invalido',
                'alerta' => $formatoInvalido
            );

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ================= Editar la Estructura =============== //
    // ====================================================== //
    static public function ctrEditarEstructura($datos){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        
        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        
        if(preg_match('/^[\/\;\\"\\?\\¿\\!\\¡\\:\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"])){

            // ======================================================
            // Guardamos la imagen nueva
            // ======================================================
            if($datos["imagenNueva"] != ""){

                $serverPrincipal = $_SERVER['DOCUMENT_ROOT']."/backend/";

                unlink($serverPrincipal.$datos["imagenAntigua"]);

                $rutaImg= substr($datos["imagenAntigua"], 0, -4);


                if($datos["tipoImagenEditar"] == "image/jpeg" || $datos["tipoImagenEditar"] == "image/jpg") {

                    $rutaImagenPrincipal = $rutaImg.".jpg";
        
                    $origen = imagecreatefromjpeg($datos["imagenNueva"]);

                    imagejpeg($origen, $serverPrincipal.$rutaImagenPrincipal);

                } else {

                    $rutaImagenPrincipal = $rutaImg.".png";

                    $origen = imagecreatefrompng($datos["imagenNueva"]);

                    imagealphablending($origen, FALSE);
    
                    imagesavealpha($origen, TRUE);

                    imagepng($origen, $serverPrincipal.$rutaImagenPrincipal);

                }

            } else {

                $rutaImagenPrincipal = $datos["imagenAntigua"];

            }

            session_start();
            $tabla = "informacion_estructura";
            
            $datos = array(
                "id" => $datos["idEstructura"],
                "id_catalogo" => $datos["idCatalogo"],
                "titulo" => $datos["titulo"],
                "imagen" => $rutaImagenPrincipal,
                "descripcion" => $datos["descripcion"],
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloEstructura::mdlEditarEstructura($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    'mensaje' => 'exito',
                    'alerta' => $actualizado
                );

            }

        } else {

            $mensaje = array(
                'mensaje' => 'invalido',
                'alerta' => $formatoInvalido
            );

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // =============== Eliminar Una Estructura ============== //
    // ====================================================== //
    static public function ctrEliminarEstructura($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        // Eliminamos la imagen de la estructura
        unlink($server.$datos["imagenEstructura"]);

        // Ejecutamos la consulta desde el modelo
        session_start();
        $tabla = "informacion_estructura";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloEstructura::mdlEliminarEstructura($tabla, $data);
        
        return $respuesta;
    }

}