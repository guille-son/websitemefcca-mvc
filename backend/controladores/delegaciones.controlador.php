<?php

include '../modelos/delegaciones.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroDelegacion'){

    die(ControladorDelegaciones::ctrRegistroDelegacion());

}

if($tipo == 'editarDelegacion'){

    die(ControladorDelegaciones::ctrEditarDelegacion());

}

class ControladorDelegaciones {
    // ====================================================== //
    // ================ Mostrar Delegaciones ================ //
    // ====================================================== //
    static public function ctrMostrarDelegaciones($item, $valor){

        $tabla = "datos_delegacion";

        $respuesta = ModeloDelegaciones::mdlMostrarDelegaciones($tabla, $item, $valor);
        return $respuesta;

    }

    // ====================================================== //
    // =============== Registro de Delegación =============== //
    // ====================================================== //
    static public function ctrRegistroDelegacion(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        include_once 'nombrarcarpeta.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ================================================== //
        // ===================== ALERTAS ==================== //
        // ================================================== //
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        
        if(preg_match("/^[a-zA-ZñÑáéíóúüÁÉÍÓÚ ]+$/", $_POST["registroDelegado"]) &&
        preg_match("/^[a-zA-ZñÑáéíóúüÁÉÍÓÚ ]+$/", $_POST["registroNombre"])){


            $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
            $delegacion = ControladorNombrarCarpeta::ctrNombrarCarpeta($_POST["registroNombre"]);

            // ======================================================
            // ================= Guardamos la imagen ================
            // ======================================================
            $aleatorio = mt_rand(1000,9999);
            $id = ModeloDelegaciones::mdlRegistroConsecutivo();
            $directorioImagen = "../../../backend/vistas/img/delegaciones/";

            if($_FILES["subirImagenDelegacion"]["type"] == "image/jpeg" ||
            $_FILES["subirImagenDelegacion"]["type"] == "image/jpg") {

                $rutaImagenDlg = $directorioImagen."imagen_delegacion_".$delegacion.$aleatorio.$id["id"].".jpg";

                $rutaImagenDlg = substr($rutaImagenDlg,17);

                $origen = imagecreatefromjpeg($_POST["rutaImagen"]);

                imagejpeg($origen, $server.$rutaImagenDlg);

            } else {

                $rutaImagenDlg = $directorioImagen."imagen_delegacion_".$delegacion.$aleatorio.$id["id"].".png";

                $rutaImagenDlg = substr($rutaImagenDlg,17);

                $origen = imagecreatefrompng($_POST["rutaImagen"]);

                imagealphablending($origen, FALSE);

                imagesavealpha($origen, TRUE);

                imagepng($origen, $server.$rutaImagenDlg);

            }

            session_start();
            $tabla = "datos_delegacion";
            $telefono = str_replace("-","", $_POST["registroTelefono"]);
            
            $datos = array(
                "nombre" => $_POST["registroNombre"],
                "delegado" => $_POST["registroDelegado"],
                "imagen" => $rutaImagenDlg,
                "telefono" => $telefono,
                "direccion" => $_POST["registroDireccion"],
                "email" => $_POST["registroCorreo"],
                "twitter" => $_POST["registroTwitter"],
                "facebook" => $_POST["registroFacebook"],
                "instagram" => $_POST["registroInstagram"],
                "creado_por" => $_SESSION['idBackend'],
                "creado_en_ip" => $ip
            );

            $respuesta = ModeloDelegaciones::mdlRegistroDelegacion($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    'mensaje' => 'exito',
                    'alerta' => $guardado
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
    // ================= Editar Delegación ================== //
    // ====================================================== //
    static public function ctrEditarDelegacion(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        include_once 'nombrarcarpeta.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ================================================== //
        // ===================== ALERTAS ==================== //
        // ================================================== //
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        
        if(preg_match("/^[a-zA-ZñÑáéíóúüÁÉÍÓÚ ]+$/", $_POST["editarDelegado"]) &&
        preg_match("/^[a-zA-ZñÑáéíóúüÁÉÍÓÚ ]+$/", $_POST["editarNombre"])){


            $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
            $delegacion = ControladorNombrarCarpeta::ctrNombrarCarpeta($_POST["editarNombre"]);

            if($_POST["rutaImagenNueva"] != "") {

                // ======================================================
                // ============== Borramos la imagen actual =============
                // ======================================================
                unlink($server.$_POST["imagenActual"]);

                // ======================================================
                // ================= Guardamos la imagen ================
                // ======================================================
                $aleatorio = mt_rand(1000,9999);
                $id = $_POST["editarIdDelegacion"];
                $directorioImagen = "../../../backend/vistas/img/delegaciones/";

                if($_FILES["subirImagenEditarDelegacion"]["type"] == "image/jpeg" ||
                $_FILES["subirImagenEditarDelegacion"]["type"] == "image/jpg") {

                    $rutaImagenDlg = $directorioImagen."imagen_delegacion_".$delegacion.$aleatorio.$id.".jpg";

                    $rutaImagenDlg = substr($rutaImagenDlg,17);

                    $origen = imagecreatefromjpeg($_POST["rutaImagenNueva"]);

                    imagejpeg($origen, $server.$rutaImagenDlg);

                } else {

                    $rutaImagenDlg = $directorioImagen."imagen_delegacion_".$delegacion.$aleatorio.$id.".png";

                    $rutaImagenDlg = substr($rutaImagenDlg,17);

                    $origen = imagecreatefrompng($_POST["rutaImagenNueva"]);

                    imagealphablending($origen, FALSE);

                    imagesavealpha($origen, TRUE);

                    imagepng($origen, $server.$rutaImagenDlg);

                }

            } else {

                $rutaImagenDlg = $_POST["imagenActual"];

            }

            session_start();
            $tabla = "datos_delegacion";
            $telefono = str_replace("-","", $_POST["editarTelefono"]);
            
            $datos = array(
                "id" => $_POST["editarIdDelegacion"],
                "nombre" => $_POST["editarNombre"],
                "delegado" => $_POST["editarDelegado"],
                "imagen" => $rutaImagenDlg,
                "telefono" => $telefono,
                "direccion" => $_POST["editarDireccion"],
                "email" => $_POST["editarCorreo"],
                "twitter" => $_POST["editarTwitter"],
                "facebook" => $_POST["editarFacebook"],
                "instagram" => $_POST["editarInstagram"],
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloDelegaciones::mdlEditarDelegacion($tabla, $datos);

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
    // =============== Eliminar Una Delegacion ============== //
    // ====================================================== //
    static public function ctrEliminarDelegacion($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        // Eliminamos imagen  
        unlink($server.$datos["imagen"]);

        // Ejecutamos la consulta desde el modelo
        session_start();
        $tabla = "datos_delegacion";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloDelegaciones::mdlEliminarDelegacion($tabla, $data);
        
        return $respuesta;
    }

}