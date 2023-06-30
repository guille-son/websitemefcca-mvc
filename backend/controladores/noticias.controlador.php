<?php

include '../modelos/noticias.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'registroNoticia'){

    die(ControladorNoticias::ctrRegistroNoticia());

}

if($tipo == 'editarNoticia'){

    die(ControladorNoticias::ctrEditarNoticia());

}

class ControladorNoticias {

    /* ===================================================
    MOSTRAR LAS NOTICIAS CON INNER JOIN
    ======================================================*/
    static public function ctrMostrarNoticias($valor)
    {
        $tabla1 = "noticia";
        $tabla2 = "informacion_estructura";

        $respuesta = ModeloNoticias::mdlMostrarNoticias($tabla1, $tabla2, $valor);

        return $respuesta;

    }

    // ====================================================== //
    // ================ Registro Nueva Noticia ============== //
    // ====================================================== //
    static public function ctrRegistroNoticia(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        
        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        $galeriaVacia = ControladorAlertas::ctrGaleriaVacia();
        $imagenPrincipal = ControladorAlertas::ctrImagenPrincipal();
        
        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,' ]+$/", $_POST["titulo"])){

            if($_POST["galeria"] == ""){

                $mensaje = array(
                    'mensaje' => 'galeria-vacia',
                    'alerta' => $galeriaVacia
                );

            } else {

                if($_POST["galeria"] != ""){

                    $ruta = array();
                    $guardarRuta = array();
    
                    $galeria = json_decode($_POST["galeria"], true);
    
                    for($i = 0; $i < count($galeria); $i++){
                        // ======================================================
                        // Creamos el directorio donde vamos a guardar las imagen
                        // ======================================================
    
                        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";
    
                        $nombreCarpeta = date("Y-m-d");
    
                        $directorio = "../../../backend/vistas/img/noticias/".$nombreCarpeta;
    
                        if (!file_exists($directorio)) {
    
                            mkdir($directorio, 0777, true);
    
                        }
    
                        $id = ModeloNoticias::mdlRegistroConsecutivo();
                        $aleatorio = mt_rand(10000,99999);
    
                        array_push($ruta, strtolower($directorio."/galeria".$aleatorio.$id['id'].($i+1).".jpg"));
    
                        $origen = imagecreatefromjpeg($galeria[$i]);
    
                        imagejpeg($origen, $server.substr($ruta[$i],17));
    
                        array_push($guardarRuta, substr($ruta[$i], 17));
                        
                    }
    
                }

                // ======================================================
                // Guardamos la imagen principal
                // ======================================================

                if($_POST["imagen"] != ""){
                    
                    $serverPrincipal = $_SERVER['DOCUMENT_ROOT']."/backend/";

                    $nombreCarpetaPrincipal = date("Y-m-d");

                    $directorioPrincipal = "../../../backend/vistas/img/noticias/".$nombreCarpetaPrincipal;

                    if (!file_exists($directorioPrincipal)) {

                        mkdir($directorioPrincipal, 0777, true);

                    }

                    $id = ModeloNoticias::mdlRegistroConsecutivo();
                    $aleatorio = mt_rand(10000,99999);

                    if($_POST["tipoImagen"] == "image/jpeg" || $_POST["tipoImagen"] == "image/jpg") {

                        $rutaImagenPrincipal = strtolower($directorioPrincipal."/imagen_principal".$aleatorio.$id['id'].".jpg");

                        $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);
            
                        $origen = imagecreatefromjpeg($_POST["imagen"]);
            
                        imagejpeg($origen, $serverPrincipal.$rutaImagenPrincipal);

                    } else {

                        $rutaImagenPrincipal = strtolower($directorioPrincipal."/imagen_principal".$aleatorio.$id['id'].".png");

                        $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);

                        $origen = imagecreatefrompng($_POST["imagen"]);

                        imagealphablending($origen, FALSE);
        
                        imagesavealpha($origen, TRUE);

                        imagepng($origen, $server.$rutaImagenPrincipal);

                    }

                } else {

                    $mensaje = array(
                        'mensaje' => 'imagen-vacia',
                        'alerta' => $imagenPrincipal
                    );

                }

                session_start();
                $tabla = "noticia";

                $datos = array(
                    "id_estructura" => $_POST["idEstructura"],
                    "titulo" => $_POST["titulo"],
                    "imagen" => $rutaImagenPrincipal,
                    "descripcion" => $_POST["descripcion"],
                    "descrip_corta" => $_POST["descripcionCorta"],
                    "facebook" => $_POST["facebook"],
                    "instagram" => $_POST["instagram"],
                    "twitter" => $_POST["twitter"],
                    "galeria" => json_encode($guardarRuta, JSON_UNESCAPED_SLASHES),
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloNoticias::mdlRegistroNoticia($tabla, $datos);

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
    // ================== Editar Una Noticia ================ //
    // ====================================================== //
    static public function ctrEditarNoticia(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';
        
        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $formatoInvalido = ControladorAlertas::ctrFormatoInvalido();
        $galeriaVacia = ControladorAlertas::ctrGaleriaVacia();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        if(preg_match("/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚ<>;:¡!?¿,' ]+$/", $_POST["titulo"])){

            if(($_POST["galeria"] == "") && ($_POST["galeriaAntigua"] == "")){

                $mensaje = array(
                    'mensaje' => 'galeria-vacia',
                    'alerta' => $galeriaVacia
                );

            } else {

                /*======================================================
                Eliminar fotos de la galeria de la carpeta
                ========================================================*/

                $traerNoticia = ModeloNoticias::mdlMostrarNoticias("noticia", "informacion_estructura", $_POST["idNoticia"]);

                if($_POST["galeriaAntigua"] != "") {

                    $galeriaBD = json_decode($traerNoticia["galeria"], true);

                    $galeriaAntigua = explode(",", $_POST["galeriaAntigua"]);

                    $guardarRuta = $galeriaAntigua;

                    $borrarFoto = array_diff($galeriaBD, $galeriaAntigua);

                    foreach ($borrarFoto as $key => $valueFoto) {
                        
                        unlink($server.$valueFoto);

                    }

                } else {

                    $galeriaBD = json_decode($traerNoticia["galeria"], true);

                    foreach ($galeriaBD as $key => $valueFoto){

                        unlink($server.$valueFoto);

                    }

                }

                // Cuando vienen fotos nuevas

                if($_POST["galeria"] != ""){

                    $ruta = array();
                    $guardarRuta = array();

                    $galeria = json_decode($_POST["galeria"], true);
                    $galeriaAntigua = explode(",", $_POST["galeriaAntigua"]);

                    for($i = 0; $i < count($galeria); $i++){
                        /*======================================================
                        Creamos el directorio donde vamos a guardar las imagen
                        ========================================================*/
        
                        $nombreCarpeta = date("Y-m-d");

                        $directorio = "../../../backend/vistas/img/noticias/".$nombreCarpeta;

                        if (!file_exists($directorio)) {

                            mkdir($directorio, 0777, true);

                        }

                        $aleatorio = mt_rand(10000,99999);
                        $id = $_POST["idNoticia"];

                        array_push($ruta, strtolower($directorio."/galeria".$aleatorio.$id.($i+1).".jpg"));

                        $origen = imagecreatefromjpeg($galeria[$i]);

                        imagejpeg($origen, $server.substr($ruta[$i],17));

                        array_push($guardarRuta, substr($ruta[$i], 17));
                        
                    }

                    // Agregamos las fotos antiguas

                    if($_POST["galeriaAntigua"] != ""){

                        foreach ($galeriaAntigua as $key => $value) {
                            
                            array_push($guardarRuta, $value);

                        }

                    }

                }

                /*======================================================
                Guardamos la imagen principal
                ========================================================*/

                if($_POST["imagenEditar"] != ""){
                    
                    $serverPrincipal = $_SERVER['DOCUMENT_ROOT']."/backend/";

                    unlink($serverPrincipal.$_POST["imagenAntigua"]);

                    $nombreCarpetaPrincipal = date("Y-m-d");

                    $directorioPrincipal = "../../../backend/vistas/img/noticias/".$nombreCarpetaPrincipal;

                    if (!file_exists($directorioPrincipal)) {

                        mkdir($directorioPrincipal, 0777, true);

                    }

                    $aleatorio = mt_rand(10000,99999);
                    $id = $_POST["idNoticia"];


                    if($_POST["tipoImagen"] == "image/jpeg" || $_POST["tipoImagen"] == "image/jpg") {

                        $rutaImagenPrincipal = strtolower($directorioPrincipal."/imagen_principal".$aleatorio.$id.".jpg");

                        $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);
            
                        $origen = imagecreatefromjpeg($_POST["imagenEditar"]);
            
                        imagejpeg($origen, $serverPrincipal.$rutaImagenPrincipal);

                    } else {

                        $rutaImagenPrincipal = strtolower($directorioPrincipal."/imagen_principal".$aleatorio.$id.".png");

                        $rutaImagenPrincipal = substr($rutaImagenPrincipal,17);

                        $origen = imagecreatefrompng($_POST["imagenEditar"]);

                        imagealphablending($origen, FALSE);
        
                        imagesavealpha($origen, TRUE);

                        imagepng($origen, $server.$rutaImagenPrincipal);

                    }

                } else {

                    $rutaImagenPrincipal = $_POST["imagenAntigua"];

                }

                session_start();
                $tabla = "noticia";
                
                $datos = array(
                    "id" => $_POST["idNoticia"],
                    "id_estructura" => $_POST["idEstructura"],
                    "titulo" => $_POST["titulo"],
                    "imagen" => $rutaImagenPrincipal,
                    "descripcion" => $_POST["descripcion"],
                    "descrip_corta" => $_POST["descripcionCorta"],
                    "facebook" => $_POST["facebook"],
                    "instagram" => $_POST["instagram"],
                    "twitter" => $_POST["twitter"],
                    "galeria" => json_encode($guardarRuta, JSON_UNESCAPED_SLASHES),
                    "modificado_el" => date("Y-m-d H:i:s"),
                    "modificado_por" => $_SESSION['idBackend'],
                    "modificado_en_ip" => $ip,
                );

                $respuesta = ModeloNoticias::mdlEditarNoticia($tabla, $datos);

                if($respuesta == "ok"){

                    $mensaje = array(
                        'mensaje' => 'exito',
                        'alerta' => $actualizado
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
    // ================= Eliminar Una Noticia =============== //
    // ====================================================== //
    static public function ctrEliminarNoticia($datos){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $server = $_SERVER['DOCUMENT_ROOT']."/backend/";

        // Eliminamos fotos de la galeria        
        $galeriaNoticia = explode(",", $datos["galeriaNoticia"]);
        
        
        foreach ($galeriaNoticia as $key => $valueFoto) {
                        
            unlink($server.$valueFoto);

        }

        // Eliminamos la imagen principal de la noticia
        unlink($server.$datos["imagenPrincipal"]);

        // Ejecutamos la consulta desde el modelo
        session_start();
        $tabla = "noticia";

        $data = array(
            "id" => $datos["idEliminar"],
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloNoticias::mdlEliminarNoticia($tabla, $data);
        
        return $respuesta;
    }

}
