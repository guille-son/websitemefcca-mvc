<?php
include '../modelos/documentos.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroDocumento'){

    die(ControladorDocumentos::ctrRegistroDocumento());

}

if($tipo == 'editarDocumento'){

    die(ControladorDocumentos::ctrEditarDocumento());

}

class ControladorDocumentos {
    // ====================================================== //
    // ================= Mostrar Documentos ================= //
    // ====================================================== //
    static public function ctrMostrarDocumentos($item, $valor){

        $tabla1 = "documento";
        $tabla2 = "catalogo";
        $tabla3 = "informacion_estructura";

        $respuesta = ModeloDocumentos::mdlMostrarDocumentos($tabla1, $tabla2, $tabla3, $item, $valor);
        return $respuesta;

    }

    // ====================================================== //
    // ================ Registro de Documento =============== //
    // ====================================================== //
    static public function ctrRegistroDocumento(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        include_once 'nombrarcarpeta.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        $subirDocumento = ControladorAlertas::ctrSubirDocumento();
        $formatoDocInvalido = ControladorAlertas::ctrFormatoDocInvalido();

        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,.' ]+$/", $_POST["registroTitulo"]) &&
        preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,.' ]+$/", $_POST["registroDescripcion"])){

            if($_FILES["subirDocumento"]["tmp_name"] == ""){

                $mensaje = array(
                    'mensaje' => 'subir-doc',
                    'alerta' => $subirDocumento
                );

            } else {

                $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
                $arrayCatalogo = explode(",", $_POST["registroCategoria"]);
                $id_catalogo = $arrayCatalogo[0];
                $catalogo = $arrayCatalogo[1];
                $arrayEstructura = explode(",", $_POST["registroEstructura"]);
                $id_estructura = $arrayEstructura[0];
                $nombreCarpeta = ControladorNombrarCarpeta::ctrNombrarCarpeta($catalogo);

                // ======================================================
                // Guardamos el documento
                // ======================================================
                if($_FILES["subirDocumento"]["type"] == "application/pdf") {

                    $aleatorio = mt_rand(1000,9999);
                    $id = ModeloDocumentos::mdlRegistroConsecutivo();
                    $directorio = "../../../backend/vistas/doc/".$nombreCarpeta;

                    if (!file_exists($directorio)) {

                        mkdir($directorio, 0777, true);

                    }

                    $rutaArchivo = $directorio."/documento".$aleatorio.$id["id"].".pdf";

                    move_uploaded_file($_FILES["subirDocumento"]["tmp_name"], $server.substr($rutaArchivo,17));

                } else {

                    $mensaje = array(
                        'mensaje' => 'doc-invalido',
                        'alerta' => $formatoDocInvalido
                    );

                    return;

                }

                // ======================================================
                // Guardamos la imagen
                // ======================================================
                $aleatorio = mt_rand(1000,9999);
                $id = ModeloDocumentos::mdlRegistroConsecutivo();
                $directorioImagen = "../../../backend/vistas/img/documentos/".$nombreCarpeta;

                if (!file_exists($directorioImagen)) {

                    mkdir($directorioImagen, 0777, true);

                }

                if($_FILES["subirImagenDocumento"]["type"] == "image/jpeg" ||
                $_FILES["subirImagenDocumento"]["type"] == "image/jpg") {

                    $rutaImagenDoc = $directorioImagen."/imagen_documento".$aleatorio.$id["id"].".jpg";

                    $origen = imagecreatefromjpeg($_POST["rutaImagen"]);

                    imagejpeg($origen, $server.substr($rutaImagenDoc,17));

                } else {

                    $rutaImagenDoc = $directorioImagen."/imagen_documento".$aleatorio.$id["id"].".png";

                    $origen = imagecreatefrompng($_POST["rutaImagen"]);

                    imagealphablending($origen, FALSE);
	
				    imagesavealpha($origen, TRUE);

                    imagepng($origen, $server.substr($rutaImagenDoc,17));

                }

                session_start();
                $tabla = "documento";
                
                $datos = array(
                    "estructura_id" => $id_estructura,
                    "categoria_id" => $id_catalogo,
                    "titulo" => $_POST["registroTitulo"],
                    "descripcion" => $_POST["registroDescripcion"],
                    "archivo" => substr($rutaArchivo,17),
                    "imagen" => substr($rutaImagenDoc,17),
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloDocumentos::mdlRegistroDocumento($tabla, $datos);

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
    // ================== Editar Documento ================== //
    // ====================================================== //
    static public function ctrEditarDocumento(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        include_once 'nombrarcarpeta.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        // ALERTAS
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        $formatoDocInvalido = ControladorAlertas::ctrFormatoDocInvalido();

        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,.' ]+$/", $_POST["editarTitulo"]) &&
        preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,.' ]+$/", $_POST["editarDescripcion"])){

            $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
            $arrayCatalogo = explode(",", $_POST["editarCategoria"]);
            $id_catalogo = $arrayCatalogo[0];
            $catalogo = $arrayCatalogo[1];
            $nombreCarpeta = ControladorNombrarCarpeta::ctrNombrarCarpeta($catalogo);

            if($_FILES["subirEditarDocumento"]["tmp_name"] != ""){

                // ======================================================
                // Guardamos el documento
                // ======================================================
                if($_FILES["subirEditarDocumento"]["type"] == "application/pdf") {

                    // Borramos el documento antiguo
                    unlink($server.$_POST["archivoActual"]);

                    $aleatorio = mt_rand(1000,9999);
                    $id = $_POST["editarIdDocumento"];
                    $directorio = "../../../backend/vistas/doc/".$nombreCarpeta;

                    if (!file_exists($directorio)) {

                        mkdir($directorio, 0777, true);

                    }

                    $rutaArchivo = $directorio."/documento".$aleatorio.$id.".pdf";

                    $rutaArchivo = substr($rutaArchivo,17);

                    move_uploaded_file($_FILES["subirEditarDocumento"]["tmp_name"], $server.$rutaArchivo);

                } else {

                    $mensaje = array(
                        'mensaje' => 'doc-invalido',
                        'alerta' => $formatoDocInvalido
                    );

                    return;

                }

            } else {

                $rutaArchivo = $_POST["archivoActual"];

            }

            if($_POST["rutaImagenNueva"] != "") {

                // Borramos la imagen antigua
                unlink($server.$_POST["imagenActual"]);

                // Guardamos la  nueva imagen
                $aleatorio = mt_rand(1000,9999);
                $id = $_POST["editarIdDocumento"];
                $directorioImagen = "../../../backend/vistas/img/documentos/".$nombreCarpeta;

                if (!file_exists($directorioImagen)) {

                    mkdir($directorioImagen, 0777, true);
    
                }

                if($_FILES["subirImagenEditarDocumento"]["type"] == "image/jpeg" ||
                $_FILES["subirImagenEditarDocumento"]["type"] == "image/jpg") {

                    $rutaImagenDoc = $directorioImagen."/imagen_documento".$aleatorio.$id.".jpg";

                    $rutaImagenDoc = substr($rutaImagenDoc,17);
        
                    $origen = imagecreatefromjpeg($_POST["rutaImagenNueva"]);
        
                    imagejpeg($origen, $server.$rutaImagenDoc);

                } else {

                    $rutaImagenDoc = $directorioImagen."/imagen_documento".$aleatorio.$id.".png";

                    $rutaImagenDoc = substr($rutaImagenDoc,17);

                    $origen = imagecreatefrompng($_POST["rutaImagenNueva"]);

                    imagealphablending($origen, FALSE);
	
				    imagesavealpha($origen, TRUE);

                    imagepng($origen, $server.$rutaImagenDoc);

                }
                
            } else {

                $rutaImagenDoc = $_POST["imagenActual"];

            }

            session_start();
            $tabla = "documento";
            
            $datos = array(
                "id" => $_POST["editarIdDocumento"],
                "estructura_id" => $_POST["editarEstructura"],
                "categoria_id" => $id_catalogo,
                "titulo" => $_POST["editarTitulo"],
                "descripcion" => $_POST["editarDescripcion"],
                "archivo" => $rutaArchivo,
                "imagen" => $rutaImagenDoc,
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloDocumentos::mdlEditarDocumento($tabla, $datos);

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
    // ================ Eliminar Un Documento =============== //
    // ====================================================== //
    static public function ctrEliminarDocumento($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        // Eliminamos imagen  
        unlink($server.$datos["imagen"]);

        // Eliminamos el documento
        unlink($server.$datos["archivo"]);

        // Ejecutamos la consulta desde el modelo
        session_start();
        $tabla = "documento";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloDocumentos::mdlEliminarDocumento($tabla, $data);
        
        return $respuesta;
    }

}