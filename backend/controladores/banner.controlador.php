<?php
include '../modelos/banner.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroBanner'){

    die(ControladorBanner::ctrRegistroBanner());

}

if($tipo == 'editarBanner'){

    die(ControladorBanner::ctrEditarBanner());

}

class ControladorBanner {
    // ====================================================== //
    // =================== Mostrar Banner =================== //
    // ====================================================== //
    static public function ctrMostrarBanner($item, $valor){
        $tabla = "banner";

        $respuesta = ModeloBanner::mdlMostrarBanner($tabla, $item, $valor);

        return $respuesta;

    }

    // ====================================================== //
    // ================ Registro Nuevo Banner =============== //
    // ====================================================== //
    static public function ctrRegistroBanner(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $imagenIncompatible = ControladorAlertas::ctrImagenIncompatible();
        
        if(isset($_FILES["subirBanner"]["tmp_name"]) && !empty($_FILES["subirBanner"]["tmp_name"])){

            // =================================================================== //
            //  CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA IMAGEN DEL USUARIO  //
            // =================================================================== //

            $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

            $directorio = "vistas/img/banner";

            // =================================================================== //
            //  DE ACUERDO A LA IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  //
            // =================================================================== //

            if($_FILES["subirBanner"]["type"] == "image/jpeg"  || $_FILES["subirBanner"]["type"] == "image/png"){

                $id = ModeloBanner::mdlRegistroConsecutivo();
                $aleatorio = mt_rand(10000,99999);
                $date = date("Y-m-d");

                if($_FILES["subirBanner"]["type"] == "image/jpeg" || $_FILES["subirBanner"]["type"] == "image/jpg") {

                    $ruta = $directorio."/banner".$date.$aleatorio.$id['id'].".jpg";

                } else {

                    $ruta = $directorio."/banner".$date.$aleatorio.$id['id'].".png";

                }

				move_uploaded_file($_FILES["subirBanner"]["tmp_name"], $server.$ruta);

			} else {

                $mensaje = array(
                    'mensaje' => 'incompatible',
                    'alerta' => $imagenIncompatible
                );

            }

            session_start();
            $tabla = "banner";
            
            $datos = array(
                "ruta" => $ruta,
                "creado_por" => $_SESSION['idBackend'],
                "creado_en_ip" => $ip
            );

            $respuesta = ModeloBanner::mdlRegistroBanner($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    'mensaje' => 'exito',
                    'alerta' => $guardado
                );

            }

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ==================== Editar Banner =================== //
    // ====================================================== //
    static public function ctrEditarBanner(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $imagenIncompatible = ControladorAlertas::ctrImagenIncompatible();
        
        session_start();
        $id = $_POST["idBanner"];

        if(isset($_POST["idBanner"])){

            if(isset($_FILES["editarBanner"]["tmp_name"]) && !empty($_FILES["editarBanner"]["tmp_name"])){

                // =================================================================== //
                // == CREAMOS EL DIRECTORIO DONDE ESTA ALOJADA LA IMAGEN A ELIMINAR == //
                // =================================================================== //

                $rutaServidor = $_SERVER['DOCUMENT_ROOT']."/backend/";

                // =============================================================== //
                //  PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS  //
                // =============================================================== //

                if(isset($_POST["bannerActual"])){

                    unlink($rutaServidor.$_POST["bannerActual"]);

                }
    
                // =================================================================== //
                //  DE ACUERDO A LA IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  //
                // =================================================================== //
    
                if($_FILES["editarBanner"]["type"] == "image/jpeg"  || $_FILES["editarBanner"]["type"] == "image/png"){

                    $rutaActual = substr($_POST["bannerActual"], 0, -4);

                    if($_FILES["editarBanner"]["type"] == "image/jpeg" || $_FILES["subirBanner"]["type"] == "image/jpg") {

                        $ruta = $rutaActual.".jpg";
    
                    } else {
    
                        $ruta = $rutaActual.".png";
    
                    }
    
                    move_uploaded_file($_FILES["editarBanner"]["tmp_name"], $rutaServidor.$ruta);
    
                } else {
    
                    $mensaje = array(
                        'mensaje' => 'incompatible',
                        'alerta' => $imagenIncompatible
                    );
    
                }
    
            } else {

                $ruta = $_POST["bannerActual"];

            }

            session_start();
            $tabla = "banner";
            $id = $_POST["idBanner"];
            
            $datos = array(
                "ruta" => $ruta,
                "ordenActual" => $_POST["ordenActual"],
                "nuevoOrden" => $_POST["editarOrden"],
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip,
                "id" => $id
            );

            $respuesta = ModeloBanner::mdlEditarBanner($tabla, $datos);
            $respuesta = "ok";

            if($respuesta == "ok"){

                $mensaje = array(
                    'mensaje' => 'exito',
                    'alerta' => $actualizado
                );

            }

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ==================== Elimianr Banner ================= //
    // ====================================================== //
    static public function ctrEliminarBanner($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";        

        // Eliminamos la imagen principal de la noticia
        unlink($server.$datos["rutaImagen"]);

        session_start();
        $tabla = "banner";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloBanner::mdlEliminarBanner($tabla, $data);
        
        return $respuesta;

    }

    // ====================================================== //
    // ================= Estado Banner =============== //
    // ====================================================== //
    static public function ctrEstadoBanner($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        session_start();
        $tabla = "banner";

        $datos = array(
            "id" => $datos["idBannerEstado"],
            "estado" => $datos["estado"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloBanner::mdlEstadoBanner($tabla, $datos);
        
        return $respuesta;

    }

}