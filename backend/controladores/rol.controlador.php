<?php

include '../modelos/rol.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'rol'){

    die(ControladorRoles::ctrMostrarRolesEditar());

}

Class ControladorRoles{
    /*==========================================
    Mostrar Roles de Usuario
    ==========================================*/
    static public function ctrMostrarRoles(){
        $tabla = "catalogo";
    
        $respuesta = ModeloRol::mdlMostrarRoles($tabla);
        return $respuesta;
    }

    /*==========================================
    Mostrar Roles de Usuario al Editar
    ==========================================*/
    static public function ctrMostrarRolesEditar(){
        $tabla = "catalogo";
        $idRol = $_POST["idRol"];

        $respuesta = ModeloRol::mdlMostrarRolesEditar($tabla, $idRol);

        return json_encode($respuesta);
    }
}