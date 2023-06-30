$(document).ready(function () {

    var crear = "crear";
    var editar = "editar";

    var tablaUsuarios = $(".tablaUsuarios").DataTable({
        "ajax": "ajax/tablaUsuarios.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "pageLength": 5,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_",
            "sInfoEmpty": "Mostrando registros del 0 al 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "columnDefs": [
            {
                "targets": [4],
                "visible": false,
                "searchable": false
            }
        ]
    });

    var urlControlador = "controladores/usuarios.controlador.php";

    /*=============================================
    Inicio de Sesion
    =============================================*/
    $('#login_usuario').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: urlControlador,
            success: function (data) {
                var resultado = JSON.parse(data);
                eval(resultado);
            }
        });
    });

    /*=============================================
    Registrar Usuario
    =============================================*/
    function limpiarModalUsuario(valor) {

        if(valor == "crear") {
            $("#crearUsuario").find("input,textarea").val("");
            $("#crearUsuario").find("select").val("default");
            $("#crearUsuario input[name='tipo']").val("registroUsuario");
        }

        $('input[name="editarPassword"]').val("");
        $('input[name="editarConfirmarPassword"]').val("");
        $('.resultado_password').addClass('ocultar').removeClass('alert-success alert-danger mostrar');
        $('.resultado_password').css('display', 'none');
    }

    /*=============================================
    Validar Contrasenia del Usuario
    =============================================*/
    $('#modal_registro_usuario #confirmar_password').on('input', function () {
        var password_confirmada = $('#password').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    $('#modal_registro_usuario #password').on('input', function () {
        var password_confirmada = $('#confirmar_password').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    /*=============================================
    Validar Contrasenia del ajuste de Usuario
    =============================================*/
    $('#modal_ajuste_usuario #confirmar_password').on('input', function () {
        var password_confirmada = $('#password').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    $('#modal_ajuste_usuario #password').on('input', function () {
        var password_confirmada = $('#confirmar_password').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    $('#modal_registro_usuario').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: urlControlador,
            dataType: 'json',
            success: function (data) {
                var resultado = data;
                if(resultado.mensaje == 'exito'){
                    eval(resultado.alerta);
                    setTimeout(function() {
                        limpiarModalUsuario(crear);
                        $('#crearUsuario').modal("hide");
                    }, 2000);
                    tablaUsuarios.ajax.reload(null, false);
                }

                if(resultado.mensaje == 'error_rol'){
                    eval(resultado.alerta);
                }
                
                if(resultado.mensaje == 'existe'){
                    eval(resultado.alerta);
                }
                
                if(resultado.mensaje == 'especiales') {
                    eval(resultado.alerta);
                }

                if(resultado.mensaje == 'password_corto') {
                    eval(resultado.alerta);
                }
            }
        });
    });

    $('#btnCancelarRegistroUsuario').on('click', function () {
        limpiarModalUsuario(crear);
    });

    $('#btCerrarModalRegistroUsuario').on('click', function () {
        limpiarModalUsuario(crear);
    });

    /*=============================================
    Editar Usuarios
    =============================================*/

    /*=============================================
    Validar Contrasenia del usuario Usuario
    =============================================*/
    $('#modal_editar_usuario #confirmar_password_editar').on('input', function () {
        var password_confirmada = $('#password_editar').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    $('#modal_editar_usuario #password_editar').on('input', function () {
        var password_confirmada = $('#confirmar_password_editar').val();
        var elemento_propio = $(this).val();

        validacionPassword(elemento_propio, password_confirmada);
    });

    
    
    $('#modal_editar_usuario').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Quieres guardar los cambios?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Guardar`,
            cancelButtonText: `Cancelar`,
            denyButtonText: `No guardar`
        }).then((result) => {
            if (result.isConfirmed) {
                var datos = $(this).serializeArray();

                $.ajax({
                    type: $(this).attr('method'),
                    data: datos,
                    url: urlControlador,
                    dataType: 'json',
                    success: function (data) {
                        var resultado = data;
                        if(resultado.mensaje == 'exito'){
                            eval(resultado.alerta);
                            setTimeout(function() {
                                limpiarModalUsuario(editar);
                                $('#editarUsuarioModal').modal("hide");
                            }, 2000);
                            tablaUsuarios.ajax.reload(null, false);
                        }

                        if(resultado.mensaje == 'confirmar'){
                            eval(resultado.alerta);
                        }

                        if(resultado.mensaje == 'error_rol'){
                            eval(resultado.alerta);
                        }

                        if(resultado.mensaje == 'especiales') {
                            eval(resultado.alerta);
                        }

                        if(resultado.mensaje == 'password_corto') {
                            eval(resultado.alerta);
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Los cambios no se guardaron', '', 'info')
            }
        })
    });

    $(document).on("click", ".editarUsuario", function () {
        var idUsuario = $(this).attr("id-usuario");
        var idRol = $(this).attr("id-rol");

        var selectRol = $("#select-editar-rol");

        var datos = new FormData();
        datos.append("idUsuario", idUsuario);

        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $('input[name="editarIdUsuario"]').val(respuesta["id"]);
                $('input[name="editarNombre"]').val(respuesta["nombre"]);
                $('input[name="editarApellido"]').val(respuesta["apellido"]);
                $('input[name="editarUsuario"]').val(respuesta["usuario"]);
                $('input[name="editarCorreo"]').val(respuesta["correo"]);
                $('input[name="passwordActual"]').val(respuesta["password"]);

                $.ajax({
                    url:"controladores/rol.controlador.php",
                    type: "post",
                    data: {"idRol" : idRol,
                            "tipo": "rol"},
                    dataType: 'json',
                    success: function(r){

                        selectRol.find('option').remove();
                        
                        selectRol.append('<option value="default">Seleccione un Rol para el usuario</option>');
                        selectRol.append('<option class="editarRolId" selected></option>');

                        $('.editarRolId').val(respuesta["rol_id"]);
                        $('.editarRolId').html(respuesta["rol"]);

                        $(r).each(function(i, v){ // indice, valor
                            selectRol.append('<option value="' + v.id + '">' + v.descripcion + '</option>');
                        })
                    }
                })
            }
        })
    });

    $('#btnCancelarEditarUsuario').on('click', function () {
        limpiarModalUsuario(editar);
    });

    $('#btCerrarModalEditarUsuario').on('click', function () {
        limpiarModalUsuario(editar);
    });


    /*=============================================
    Eliminar Usuario
    =============================================*/

    $(document).on("click", ".eliminarUsuario", function () {
        var idUsuario = $(this).attr("id-usuario");

        Swal.fire({

            title: 'Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo!',
            cancelButtonText: 'Cancelar'

          }).then((result) => {

            if (result.isConfirmed) {

                if(idUsuario == 1) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Este usuario no puede ser eliminado!'
                    })

                    return;
                }

                var datos = new FormData();
                datos.append("idEliminar", idUsuario);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){

                        if(respuesta == 'ok'){

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Registro Eliminado Correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            })

                            tablaUsuarios.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

    // ====================================================== //
    // ============ CAMBIAR CONTRASEÑA DE USUARIO =========== //
    // ====================================================== //
    $('#modal_ajuste_usuario').on('submit', function (e) {
        e.preventDefault();

        var passwordAjuste = $("#modal_ajuste_usuario #password").val();
        var passwordConfirmadaAjsute = $("#modal_ajuste_usuario #confirmar_password").val();

        if (passwordAjuste != passwordConfirmadaAjsute) {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Las contraseñas no coinciden!',
                showConfirmButton: false,
                timer: 2000
            })

            return;

        } else {

            Swal.fire({
                title: 'Quieres guardar los cambios?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Guardar`,
                cancelButtonText: `Cancelar`,
                denyButtonText: `No guardar`
            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = $(this).serializeArray();
    
                    $.ajax({
                        type: $(this).attr('method'),
                        data: datos,
                        url: urlControlador,
                        dataType: 'json',
                        success: function (resultado) {
                            
                            if(resultado.mensaje == 'exito'){
    
                                Swal.fire({
                                    icon: "info",
                                    title: "Cambio de Contraseña!",
                                    text: "Por favor, vuelva a iniciar sesión",
                                    confirmButtonText: "Aceptar"
                                }).then((result) => {
                                    
                                    if (result.isConfirmed) {
                                        window.location = "salir";
                                    }
                                    
                                });
    
                            }

                            if(resultado.mensaje == 'especiales'){
                                eval(resultado.alerta);
                            }
    
                        }
    
                    });
    
                } else if (result.isDenied) {
    
                    Swal.fire('Los cambios no se guardaron', '', 'info')
    
                }
            })

        }
        
    });

});

function validacionPassword(elementouno, elementodos) {
    
    if(elementouno == '' || elementodos == ''){
        $('.resultado_password').addClass('ocultar').removeClass('alert-success alert-danger mostrar');
        setTimeout(function() {
            $('.resultado_password').css('display', 'none');
        }, 500);
    } else if(elementouno == elementodos) {
        $('.resultado_password').text('Las contraseñas coinciden!');
        $('.resultado_password').addClass('alert-success mostrar').removeClass('alert-danger ocultar');
        setTimeout(function() {
            $('.resultado_password').css('display', 'block');
        }, 100);
    } else {
        $('.resultado_password').text('Las contraseñas no coinciden!');
        $('.resultado_password').addClass('alert-danger mostrar').removeClass('alert-success ocultar');
        setTimeout(function() {
            $('.resultado_password').css('display', 'block');
        }, 100);
    }
}