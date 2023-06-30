$(document).ready(function () {
    
    var crear = "crear";
    var editar = "editar";
    
    var tablaDelegaciones = $(".tablaDelegaciones").DataTable({
        "ajax": "ajax/tablaDelegaciones.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "pageLength": 8,
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
        }
    });

    // FUNCIÓN PARA LIMPIAR CAMPOS DE DELEGACIÓN
    function limpiarModalDelegacion(valor) {

        if(valor == "crear") {

            $("#crearDelegacion").find("input,textarea").val("");
            $("#crearDelegacion input[name='tipo']").val("registroDelegacion");

        } else {

            $("#editarDelegacionModal").find("input,textarea").val("");
            $("#editarDelegacionModal input[name='tipo']").val("editarDelegacion");

        }
    }

    // FUNCIÓN PARA LIMPIAR LOS DATOS DE LA IMAGEN TEMPORAL
    function limpiarElementosImgDlg(valor) {

        if(valor == "crear") {

            $("input[name='subirImagenDelegacion']").val("");
            $('.previsualizarDelegacion').attr('src', "");

        } else {

            $("input[name='subirImagenEditarDelegacion']").val("");
            $('.previsualizarDelegacionEditar').attr('src', "");

        }

    }

    // ====================================================== //
    // ========== SUBIR IMAGEN TEMPORAL DELEGACIÓN ========== //
    // ====================================================== //
    $("input[name='subirImagenDelegacion']").change(function () { 
        var imagen = this.files[0];

        // ====================================================== //
        // = VALIDAMOS QUE EL FORMATO DE LA IMAGEN SEA JPG O PNF  //
        // ====================================================== //

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png"){

            limpiarElementosImgDlg(crear);

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })

        } else if(imagen["size"] > 5000000){

            limpiarElementosImgDlg(crear);

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen no debe pesar más de 5MB!',
                confirmButtonText: 'Cerrar'
            })

        } else {

            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on('load', function (e) {
                
                var rutaImagen = e.target.result;

                $('.previsualizarDelegacion').attr('src', rutaImagen);
                $("#rutaImagen").val(rutaImagen);

            });

        }
        
    });

    // ====================================================== //
    // ===== SUBIR IMAGEN TEMPORAL DELEGACIÓN AL EDITAR ===== //
    // ====================================================== //
    $("input[name='subirImagenEditarDelegacion']").change(function () { 
        var imagen = this.files[0];

        // ====================================================== //
        // = VALIDAMOS QUE EL FORMATO DE LA IMAGEN SEA JPG O PNF  //
        // ====================================================== //

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png"){

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })

        } else if(imagen["size"] > 5000000){

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen no debe pesar más de 5MB!',
                confirmButtonText: 'Cerrar'
            })

        } else {

            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on('load', function (e) {
                
                var rutaImagen = e.target.result;

                $('.previsualizarDelegacionEditar').attr('src', rutaImagen);
                $("#editarDelegacionModal #rutaImagenNueva").val(rutaImagen);

            });

        }
        
    });

    var urlControlador = "controladores/delegaciones.controlador.php";

    $('#btnCancelarRegistroDelegacion, #btCerrarModalRegistroDelegacion').on('click', function () {
        limpiarElementosImgDlg(crear);
        limpiarModalDelegacion(crear);
    });

    // ====================================================== //
    // ============= GUARDAR DATOS DE DELEGACIÓN ============ //
    // ====================================================== //
    $('#modal_registro_delegacion').on('submit', function (e) {
        e.preventDefault();

        var imagen = $("#modal_registro_delegacion #rutaImagen").val();
        var structlinkfac = "https://www.facebook.com/";
        var structlinkinst = "https://www.instagram.com/";
        var structlinktwi = "https://twitter.com/";
        var facebook = $("#facebookDlg").val();
        var instagram = $("#instagramDlg").val();
        var twitter = $("#twitterDlg").val();

        if (imagen == "") {

            Swal.fire({
                icon: 'info',
                title: 'Adjuntar Imagen!',
                text: 'Debe adjuntar una imagen para el documento',
                confirmButtonText: 'Cerrar'
            })

            return;

        } else if(!facebook.includes(structlinkfac) || !instagram.includes(structlinkinst) || !twitter.includes(structlinktwi)) {

            Swal.fire({
                icon: 'error',
                title: 'Formato Invalido!',
                text: 'El formato de las redes sociales no es valido',
                confirmButtonText: 'Cerrar'
            })

            return;

        } else {

            var datos = new FormData($('#modal_registro_delegacion')[0])

            $.ajax({
                type: $(this).attr('method'),
                contentType: false,
                data: datos,
                processData: false,
                url: urlControlador,
                dataType: 'json',
                success: function (resultado) {

                    if(resultado.mensaje == 'exito'){

                        eval(resultado.alerta);

                        setTimeout(function() {
                            limpiarElementosImgDlg(crear);
                            limpiarModalDelegacion(crear);
                            $('#crearDelegacion').modal("hide");
                        }, 2000);

                        tablaDelegaciones.ajax.reload(null, false);
                        
                    }
                    
                    if(resultado.mensaje == 'invalido') {
                        eval(resultado.alerta);
                    }

                }

            });

        }

    });

    // ====================================================== //
    // =========== EDITAR DATOS DE UNA DELEGACIÓN =========== //
    // ====================================================== //
    $(document).on("click", ".editarDelegaciones", function () {
        var idDelegacion = $(this).attr("id-delegacion");

        var datos = new FormData();
        datos.append("idDelegacion", idDelegacion);

        $.ajax({
            url:"ajax/delegaciones.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                $('input[name="editarIdDelegacion"]').val(respuesta["id"]);
                $('input[name="editarNombre"]').val(respuesta["nombre_delegacion"]);
                $('input[name="editarDelegado"]').val(respuesta["delegado"]);
                $('input[name="editarTelefono"]').val(respuesta["telefono"]);
                $('input[name="editarCorreo"]').val(respuesta["email"]);
                $('input[name="editarFacebook"]').val(respuesta["facebook"]);
                $('input[name="editarInstagram"]').val(respuesta["instagram"]);
                $('input[name="editarTwitter"]').val(respuesta["twitter"]);
                $('#editarDireccion').val(respuesta["direccion"]);
                $('input[name="imagenActual"]').val(respuesta["imagen"]);
                $('.previsualizarDelegacionEditar').attr('src', "../../../backend/" + respuesta["imagen"]);

            }
        })
    });

    $('#btnCancelarEditarDelegacion, #btCerrarModalEditarDelegacion').on('click', function () {
        limpiarElementosImgDlg(editar);
        limpiarModalDelegacion(editar);
    });

    // ====================================================== //
    // =========== GUARDAR EDICIÓN DE LA DELEGACIÓN ========= //
    // ====================================================== //
    $('#modal_editar_delegacion').on('submit', function (e) {
        e.preventDefault();

        var structlinkfac = "https://www.facebook.com/";
        var structlinkinst = "https://www.instagram.com/";
        var structlinktwi = "https://twitter.com/";
        var facebook = $("#facebookDlgEditar").val();
        var instagram = $("#instagramDlgEditar").val();
        var twitter = $("#twitterDlgEditar").val();

        if(!facebook.includes(structlinkfac) || !instagram.includes(structlinkinst) || !twitter.includes(structlinktwi)) {

            Swal.fire({
                icon: 'error',
                title: 'Formato Invalido!',
                text: 'El formato de las redes sociales no es valido',
                confirmButtonText: 'Cerrar'
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

                    var datos = new FormData($('#modal_editar_delegacion')[0])

                    $.ajax({
                        type: $(this).attr('method'),
                        contentType: false,
                        data: datos,
                        processData: false,
                        url: urlControlador,
                        dataType: 'json',
                        success: function (resultado) {

                            if(resultado.mensaje == 'exito'){

                                eval(resultado.alerta);

                                setTimeout(function() {
                                    limpiarElementosImgDlg(editar);
                                    limpiarModalDelegacion(editar);
                                    $('#editarDelegacionModal').modal("hide");
                                }, 2000);

                                tablaDelegaciones.ajax.reload(null, false);
                                
                            }
                            
                            if(resultado.mensaje == 'invalido') {
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

    // ====================================================== //
    // ================= ELIMINAR DELEGACION ================ //
    // ====================================================== //
    $(document).on("click", ".eliminarDelegacion", function () {
        
        var idEliminar = $(this).attr("id-delegacion");
        var imagen = $(this).attr("ruta-imagen");

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

                var datos = new FormData();
                datos.append("idEliminar", idEliminar);
                datos.append("imagen", imagen);

                $.ajax({

                    url:"ajax/delegaciones.ajax.php",
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

                            tablaDelegaciones.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

});