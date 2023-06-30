<?php
include '../modelos/radio.modelo.php';

$tipo = $_POST['tipo'];


if($tipo == 'registroRadio'){

    die(ControladorRadio::ctrRegistroRadio());

}

if($tipo == 'editarRadio'){

    die(ControladorRadio::ctrEditarRadio());

}

class ControladorRadio {

    // ====================================================== //
    // ============= Mostrar Programas de Radio ============= //
    // ====================================================== //
    static public function ctrMostrarProgramasRadio($item, $valor){

        $tabla = "programa_radio";

        $respuesta = ModeloRadio::mdlMostrarRadio($tabla, $item, $valor);
        return $respuesta;

    }

    // ====================================================== //
    // ============= Registro Programas de Radio ============ //
    // ====================================================== //
    static public function ctrRegistroRadio(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $subirAudio = ControladorAlertas::ctrSubirAudio();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalidoTema();

        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,. ]+$/", $_POST["registroTema"])){

            if($_FILES["subirPrograma"]["tmp_name"] == ""){

                $mensaje = array(
                    'mensaje' => 'subir-audio',
                    'alerta' => $subirAudio
                );

            } else {

                // ======================================================
                // Guardamos el audio
                // ======================================================
                $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
                $nombreCarpeta = date("Y-m-d");
                $aleatorio = mt_rand(1000,9999);
                $id = ModeloRadio::mdlRegistroConsecutivo();
                $directorio = "../../../backend/vistas/radio/".$nombreCarpeta;

                if (!file_exists($directorio)) {

                    mkdir($directorio, 0777, true);

                }

                $rutaArchivo = $directorio."/programa_radial".$aleatorio.$id["id"].".mp3";

                $rutaArchivo = substr($rutaArchivo,17);

                move_uploaded_file($_FILES["subirPrograma"]["tmp_name"], $server.$rutaArchivo);

                session_start();
                $tabla = "programa_radio";
                
                $datos = array(
                    "tema" => $_POST["registroTema"],
                    "fecha" => $_POST["registroFecha"],
                    "link" => $rutaArchivo,
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloRadio::mdlRegistroRadio($tabla, $datos);

                if($respuesta == "ok"){

                    $mensaje = array(
                        'mensaje' => 'exito',
                        'alerta' => $guardado
                    );

                }

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
    // =============== Editar Programa de Radio ============= //
    // ====================================================== //
    static public function ctrEditarRadio(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalidoTema();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,. ]+$/", $_POST["editarTema"])){

            if($_FILES["subirProgramaEditar"]["tmp_name"] != ""){

                // ======================================================
                // Eliminamos el antiguo audio
                // ======================================================
                unlink($server.$_POST["programaActual"]);

                // ======================================================
                // Guardamos el nuevo audio
                // ======================================================
                $nombreCarpeta = date("Y-m-d");
                $aleatorio = mt_rand(1000,9999);
                $id = $_POST["editarIdRadio"];
                $directorio = "../../../backend/vistas/radio/".$nombreCarpeta;

                if (!file_exists($directorio)) {

                    mkdir($directorio, 0777, true);

                }

                $rutaArchivo = $directorio."/programa_radial".$aleatorio.$id.".mp3";

                $rutaArchivo = substr($rutaArchivo,17);

                move_uploaded_file($_FILES["subirProgramaEditar"]["tmp_name"], $server.$rutaArchivo);

            } else {

                $rutaArchivo = $_POST["programaActual"];

            }

            session_start();
            $tabla = "programa_radio";
            
            $datos = array(
                "id" => $_POST["editarIdRadio"],
                "tema" => $_POST["editarTema"],
                "fecha" => $_POST["editarFecha"],
                "link" => $rutaArchivo,
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloRadio::mdlEditarRadio($tabla, $datos);

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

    static public function ctrEliminarRadio($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        // Eliminamos el audio del programa
        unlink($server.$datos["programa"]);

        // Ejecutamos la consulta desde el modelo
        session_start();
        $tabla = "programa_radio";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloRadio::mdlEliminarRadio($tabla, $data);
        
        return $respuesta;
    }

}