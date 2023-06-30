<?php
include '../modelos/transmisiones.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroTransmision'){

    die(ControladorTransmisiones::ctrRegistroTransmision());

}

if($tipo == 'editarTransmision'){

    die(ControladorTransmisiones::ctrEditarTransmision());

}

class ControladorTransmisiones {

    // ====================================================== //
    // =============== Mostrar Transmisiones ================ //
    // ====================================================== //
    static public function ctrMostrarTransmisiones($item, $valor){

        $tabla = "transmisiones_en_vivo";

        $respuesta = ModeloTransmisiones::mdlMostrarTransmisiones($tabla, $item, $valor);
        return $respuesta;

    }

    // ====================================================== //
    // =============== Registro de Transmision ============== //
    // ====================================================== //
    static public function ctrRegistroTransmision(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalidoTitulo();
       
        if(isset($_POST["registroTitulo"])){

            if (preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿, ]+$/", $_POST["registroTitulo"])){

                session_start();
                $tabla = "transmisiones_en_vivo";
                
                $datos = array(
                    "titulo" => $_POST["registroTitulo"],
                    "link" => $_POST["registroLinkTransmision"],
                    "hora" => $_POST["registroHoraTransmision"],
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloTransmisiones::mdlRegistroTransmision($tabla, $datos);

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

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ================ Editar de Transmision =============== //
    // ====================================================== //
    static public function ctrEditarTransmision(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalidoTitulo();
       
        if(isset($_POST["editarTitulo"])){

            if (preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿, ]+$/", $_POST["editarTitulo"])){

                session_start();
                $tabla = "transmisiones_en_vivo";
                
                $datos = array(
                    "id" => $_POST["editarIdTransmision"],
                    "titulo" => $_POST["editarTitulo"],
                    "link" => $_POST["editarLinkTransmision"],
                    "hora" => $_POST["editarHoraTransmision"],
                    "modificado_el" => date("Y-m-d H:i:s"),
                    "modificado_por" => $_SESSION['idBackend'],
                    "modificado_en_ip" => $ip
                );

                $respuesta = ModeloTransmisiones::mdlEditarTransmision($tabla, $datos);

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

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ================= Eliminar Transmision =============== //
    // ====================================================== //
    static public function ctrEliminarTransmision($id){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        session_start();
        $tabla = "transmisiones_en_vivo";

        $datos = array(
            "id" => $id,
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloTransmisiones::mdlEliminarTransmision($tabla, $datos);
        
        return $respuesta;

    }

    // ====================================================== //
    // ================= Estado Transmision =============== //
    // ====================================================== //
    static public function ctrEstadoTransmisiones($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        session_start();
        $tabla = "transmisiones_en_vivo";

        $datos = array(
            "id" => $datos["idTransmision"],
            "estado" => $datos["estado"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloTransmisiones::mdlEstadoTransmision($tabla, $datos);
        
        return $respuesta;

    }

}