<?php
include '../modelos/usuarios.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'login'){

    die(ControladorUsuarios::ctrIngresoUsuarios());

}

if($tipo == 'registroUsuario'){

    die(ControladorUsuarios::ctrRegistroUsuario());

}

if($tipo == 'editarUsuario'){

    die(ControladorUsuarios::ctrEditarUsuario());

}

if($tipo == 'ajusteUsuario'){

    die(ControladorUsuarios::ctrAjusteUsuario());

}

class ControladorUsuarios {
    // ====================================================== //
    // =================== Login Usuarios =================== //
    // ====================================================== //
    static public function ctrIngresoUsuarios() {

        include_once 'alertas.controlador.php';

        /* ALERTAS */
        $userIncorrecto = ControladorAlertas::ctrDatosIncorrectos();
        $camposNulos = ControladorAlertas::ctrCamposNulosLogin();
        $caracteresEspeciales = ControladorAlertas::ctrCaracteresEspeciales();
        $userDesactivado = ControladorAlertas::ctrUsuarioDesactivado();

        if(isset($_POST["ingresoUsuario"])) {

            if($_POST["ingresoUsuario"] == '' || $_POST["ingresoPassword"] == ''){

                $mensaje = $camposNulos;

            } elseif(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoUsuario"]) &&
                preg_match('/^[-*a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

                    $encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    
                    $tabla1 = "usuario";
                    $tabla2 = "catalogo";
                    $item = "username";
                    $valor = $_POST["ingresoUsuario"];
                    
                    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
                    

                    if($respuesta["pasivo"] == 1){

                        $mensaje = $userDesactivado;

                    } elseif($respuesta["usuario"] == $_POST["ingresoUsuario"] &&
                        $respuesta["password"] == $encriptarPassword) {

                        $nombreCompleto = $respuesta["nombre"].' '.$respuesta["apellido"];

                        $bienvenida = ControladorAlertas::ctrBienvenidoUsuario($nombreCompleto);
                        
                        session_start();
                        $_SESSION["validarSesionBackend"] = "ok";
                        $_SESSION["idBackend"] = $respuesta["id"];
                        session_regenerate_id();
                        
                        $_SESSION["timeout"] = time();

                        $mensaje = 
                            ''.$bienvenida.';
                            setTimeout(function() {
                                window.location = "inicio";
                            }, 2000);';

                    } else {

                        $mensaje = $userIncorrecto;

                    }

            } else {

                $mensaje = $caracteresEspeciales;
                
            }

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ================== Mostrar Usuarios ================== //
    // ====================================================== //
    static public function ctrMostrarUsuarios($item, $valor){

        $tabla1 = "usuario";
        $tabla2 = "catalogo";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
        return $respuesta;

    }

    // ======================================================== //
    // = Noticias, Videos y Documentos Publicadas Por Usuario = //
    // ======================================================== //
    static public function ctrDatosPublicadosPorUsuario($tabla, $id){

        $respuesta = ModeloUsuarios::mdlDatosPublicadosPorUsuario($tabla, $id);

        return $respuesta;

    }

    // ====================================================== //
    // ================= Registro de Usuario ================ //
    // ====================================================== //
    static public function ctrRegistroUsuario(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();
        $validacionUsuario = ModeloUsuarios::buscarUsuarioRepetido($_POST["registroUsuario"]);
        $validacionCorreo = ModeloUsuarios::buscarCorreoRepetido($_POST["registroCorreo"]);

        /* ALERTAS */
        $guardado = ControladorAlertas::ctrRegistroGuardado();
        $usuarioExistente = ControladorAlertas::ctrUsuarioExistente();
        $caracteresEspeciales = ControladorAlertas::ctrCaracteresEspeciales();
        $errorRol = ControladorAlertas::ctrSeleccioneRol();
        $validarPasswordCorto = ControladorAlertas::ctrPasswordCorto();
       
        if(isset($_POST["registroNombre"])){

            if($validacionUsuario == true || $validacionCorreo == true) {

                $mensaje = array(
                    'mensaje' => 'existe',
                    'alerta' => $usuarioExistente
                );

            } elseif($_POST["registroRol"] == "default"){

                $mensaje = array(
                    'mensaje' => 'error_rol',
                    'alerta' => $errorRol
                );

            } elseif(strlen($_POST["registroPassword"]) < 8) {

                $mensaje = array(
                    'mensaje' => 'password_corto',
                    'alerta' => $validarPasswordCorto
                );

            } elseif (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $_POST["registroNombre"]) &&
                preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $_POST["registroApellido"]) &&
                preg_match('/^[a-zA-Z]+$/', $_POST["registroUsuario"]) &&
                preg_match('/^[-*a-zA-Z0-9]+$/', $_POST["registroPassword"])){

                $encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                session_start();
                $tabla = "usuario";
                
                $datos = array(
                    "usuario" => $_POST["registroUsuario"],
                    "nombre" => $_POST["registroNombre"],
                    "apellido" => $_POST["registroApellido"],
                    "correo" => $_POST["registroCorreo"],
                    "rol_id" => $_POST["registroRol"],
                    "password" => $encriptarPassword,                    
                    "creado_por" => $_SESSION['idBackend'],
                    "creado_en_ip" => $ip
                );

                $respuesta = ModeloUsuarios::mdlRegistroUsuarios($tabla, $datos);

                if($respuesta == "ok"){

                    $mensaje = array(
                        'mensaje' => 'exito',
                        'alerta' => $guardado
                    );

                }

            } else {

                $mensaje = array(
                    'mensaje' => 'especiales',
                    'alerta' => $caracteresEspeciales
                );

            }

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // ==================== Editar Usuario ================== //
    // ====================================================== //
    static public function ctrEditarUsuario(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $actualizado = ControladorAlertas::ctrRegistroActualizado();
        $caracteresEspeciales = ControladorAlertas::ctrCaracteresEspeciales();
        $errorRol = ControladorAlertas::ctrSeleccioneRol();
        $confirmarPassword = ControladorAlertas::ctrConfirmarPasswoord();
        $validarPasswordCorto = ControladorAlertas::ctrPasswordCorto();
        $validacionesCompletadas = true;

        if($_POST["editarRol"] == "default"){

            $mensaje = array(
                'mensaje' => 'error_rol',
                'alerta' => $errorRol
            );

        } elseif(isset($_POST["editarNombre"])){

            if(($_POST["editarPassword"] != "") && ($_POST["editarConfirmarPassword"] == "")){

                $mensaje = array(
                    'mensaje' => 'confirmar',
                    'alerta' => $confirmarPassword
                );

            } else {

                if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $_POST["editarNombre"]) &&
                    preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $_POST["editarApellido"]) &&
                    preg_match('/^[a-zA-Z]+$/', $_POST["editarUsuario"])){

                    if(($_POST["editarPassword"] == "")){

                        $password = $_POST["passwordActual"];
                                                
                    } else {

                        if (preg_match('/^[-*a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                            if(strlen($_POST["editarPassword"]) < 8) {

                                $mensaje = array(
                                    'mensaje' => 'password_corto',
                                    'alerta' => $validarPasswordCorto
                                );

                                $validacionesCompletadas = false;

                            } else {

                                $password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                                
                            }
                            
                        } else {

                            $mensaje = array(
                                'mensaje' => 'especiales',
                                'alerta' => $caracteresEspeciales
                            );

                            $validacionesCompletadas = false;

                        }

                    }

                    if($validacionesCompletadas) {

                        session_start();
                        $tabla = "usuario";
                        
                        $datos = array(
                            "id" => $_POST["editarIdUsuario"],
                            "usuario" => $_POST["editarUsuario"],
                            "nombre" => $_POST["editarNombre"],
                            "apellido" => $_POST["editarApellido"],
                            "correo" => $_POST["editarCorreo"],
                            "rol_id" => $_POST["editarRol"],
                            "password" => $password,
                            "modificado_el" => date("Y-m-d H:i:s"),
                            "modificado_por" => $_SESSION['idBackend'],
                            "modificado_en_ip" => $ip
                        );

                        $respuesta = ModeloUsuarios::mdlEditarUsuarios($tabla, $datos);

                        if($respuesta == "ok"){

                            $mensaje = array(
                                'mensaje' => 'exito',
                                'alerta' => $actualizado
                            );

                        }

                    }                    
                    
                } else {

                    $mensaje = array(
                        'mensaje' => 'especiales',
                        'alerta' => $caracteresEspeciales
                    );

                }

            }

        }

        return json_encode($mensaje);

    }

    // ====================================================== //
    // =================== Elimianr Usuario ================= //
    // ====================================================== //
    static public function ctrEliminarUsuarios($id){

        include_once 'obtener.ip.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        session_start();
        $tabla = "usuario";

        $datos = array(
            "id" => $id,
            "modificado_el" => date("Y-m-d H:i:s"),
            "modificado_por" => $_SESSION['idBackend'],
            "modificado_en_ip" => $ip
        );

        $respuesta = ModeloUsuarios::mdlEliminarUsuarios($tabla, $datos);
        
        return $respuesta;

    }

    // ====================================================== //
    // ============ Cambiar Contraseña de Usuario =========== //
    // ====================================================== //
    static public function ctrAjusteUsuario(){

        include_once 'obtener.ip.controlador.php';
        include_once 'alertas.controlador.php';

        $ip = ControladorObtenerIp::finalIP();

        /* ALERTAS */
        $caracteresEspeciales = ControladorAlertas::ctrCaracteresEspeciales();

        if (preg_match('/^[-*a-zA-Z0-9]+$/', $_POST["ajustarPassword"])) {

            $password = crypt($_POST["ajustarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            session_start();
            $tabla = "usuario";

            $datos = array(
                "id" => $_POST["idAjusteUsuario"],
                "password" => $password,
                "modificado_el" => date("Y-m-d H:i:s"),
                "modificado_por" => $_SESSION['idBackend'],
                "modificado_en_ip" => $ip
            );

            $respuesta = ModeloUsuarios::mdlAjusteUsuario($tabla, $datos);

            if($respuesta == "ok"){

                $mensaje = array(
                    'mensaje' => 'exito'
                );
    
            }
            
        } else {

            $mensaje = array(
                'mensaje' => 'especiales',
                'alerta' => $caracteresEspeciales
            );

        }

        return json_encode($mensaje);

    }

}