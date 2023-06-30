<?php

class ControladorAlertas{
    static public function ctrRegistroGuardado() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Guardado Correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        ";
    }

    static public function ctrRegistroActualizado() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Actualizado Correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        ";
    }

    static public function ctrBienvenidoUsuario($nombre) {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Bienvenid@ ".$nombre."!',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrUsuarioExistente() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Ya existe un registro con ese nombre de usuario o correo',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrCamposNulosLogin() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Ingrese su usuario y contraseña!',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrDatosIncorrectos() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'El usuario o la contraseña son incorrectos',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrCaracteresEspeciales() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Solo se permiten los siguientes caracteres especiales: -*',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }


    static public function ctrSeleccioneRol() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Debe seleccionar un rol para el usuario',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrPasswordCorto() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'La contraseña debe contener más de 8 caracteres',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrUsuarioDesactivado() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'El usuario se encuentra desactivado!',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrConfirmarPasswoord() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Por favor, confirme su contraseña!',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    static public function ctrImagenIncompatible() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrFormatoInvalido() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Los formatos del titulo, la descripcion son invalidos',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrFormatoInvalidoTema() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'El formato del tema es invalido',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrFormatoInvalidoTitulo() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'El formato del titulo es invalido',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrSubirDocumento() {
        return "
            Swal.fire({
                icon: 'info',
                title: 'Faltan Campos!',
                text: 'Debe subir un documento PDF',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrSubirAudio() {
        return "
            Swal.fire({
                icon: 'info',
                title: 'Faltan Campos!',
                text: 'Debe subir un archivo MP3',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrFormatoDocInvalido() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error al subir el documento!',
                text: 'El documento debe estar en formato PDF!',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrImagenPrincipal() {
        return "
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Debe seleccionar una imagen principal',
                confirmButtonText: 'Cerrar'
            })
        ";
    }

    static public function ctrGaleriaVacia() {
        return "
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Error, la galeria no puede estar vacia!',
                showConfirmButton: false,
                timer: 2500
            })
        ";
    }

    
}