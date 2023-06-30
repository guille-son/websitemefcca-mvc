<?php
include '../modelos/videos.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroVideo'){

    die(ControladorVideos::ctrRegistroVideo());

}

if($tipo == 'editarVideo'){

    die(ControladorVideos::ctrEditarVideo());

}

class ControladorVideos {
    // ====================================================== //
    // =================== Mostrar Videos =================== //
    // ====================================================== //
    static public function ctrMostrarVideos($item, $valor){

        $tabla1 = "video";
        $tabla2 = "catalogo";
        $tabla3 = "informacion_estructura";

        $respuesta = ModeloVideos::mdlMostrarVideos($tabla1, $tabla2, $tabla3, $item, $valor);
        return $respuesta;

    }

    // ====================================================== //
    // ================== Registro de Video ================= //
    // ====================================================== //
    
    static public function ctrRegistroVideo(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();

        

        if( preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,. ]+$/" , $_POST['registroTitulo'] ) ){

            session_start();
            $tabla = "video";
            
            $datos = array(
                "estructura_id" => $_POST["registroEstructura"],
                "categoria_id" => $_POST["registroCategoria"],
                "titulo" => $_POST["registroTitulo"],
                "link" => $_POST["registroCodigo"],
                "creado_por" => $_SESSION['idBackend'],
                "creado_en_ip" => $ip
            );

            $respuesta = ModeloVideos::mdlRegistroVideo($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    "mensaje" => "exito",
                    "alerta" => $guardado
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
    // ================== Registro de Video ================= //
    // ====================================================== //
    
    static public function ctrEditarVideo(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();

        if( preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,. ]+$/" , $_POST["editarTitulo"] ) ){

            session_start();
            $tabla = "video";
            
            $datos = array(
                "id" => $_POST["editarIdVideo"],
                "estructura_id" => $_POST["editarEstructura"],
                "categoria_id" => $_POST["editarCategoria"],
                "titulo" => $_POST["editarTitulo"],
                "link" => $_POST["editarCodigo"],
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloVideos::mdlEditarVideo($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    "mensaje" => "exito",
                    "alerta" => $actualizado
                );

            }

        } else {

            $mensaje = array(
                "mensaje" => "invalido",
                "alerta" => $formatoInvalido
            );

        }
        
        return json_encode($mensaje);
        
    }

    static public function ctrEliminarVideos($id){
        
        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        session_start();
        $tabla = "video";

        $datos = array(
            "id" => $id,
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloVideos::mdlEliminarVideo($tabla, $datos);
        
        return $respuesta;

    }

}
