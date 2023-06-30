$(document).ready(function () {

    var crear = "crear";
    var editar = "editar";
    
    var tablaDocumentos = $(".tablaDocumentos").DataTable({
        "ajax": "ajax/tablaDocumentos.ajax.php",
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

    // Activar Select con buscador
    $('.seleccionarCatalogoDocumento').select2();
    $('.seleccionarEstructuraDocumento').select2();
    $('.seleccionarEditarEstructuraDocumento').select2();
    $('.seleccionarEditarCatalogoDocumento').select2();

    function limpiarModalDocumentos(valor) {

        if(valor == "crear") {

            $("#crearDocumento").find("input,textarea").val("");
            $("#crearDocumento input[name='tipo']").val("registroDocumento");
            $(".seleccionarEstructuraDocumento, .seleccionarCatalogoDocumento").val("default").trigger("change");
            $("input[name='subirDocumento']").val("");
            $("#nombreArchivoNuevoDocumento").html("");

        } else {

            $("#editarDocumentoModal").find("input,textarea").val("");
            $("#editarDocumentoModal input[name='tipo']").val("editarDocumento");
            $(".seleccionarEditarEstructuraDocumento, .seleccionarEditarCatalogoDocumento").find('option').remove();
            $("input[name='subirEditarDocumento']").val("");
            $("#nombreArchivoNuevoEditarDocumento").html("");

        }
    }

    function limpiarElementosDoc() {

        $("input[name='subirDocumento']").val("");
        $("#nombreArchivoNuevoDocumento").html("");

        $("input[name='subirEditarDocumento']").val("");
        $("#nombreArchivoNuevoEditarDocumento").html("");

    }

    function limpiarElementosImgDoc() {

        $("input[name='subirImagenDocumento']").val("");
        $('.previsualizarDocumento').attr('src', "");

    }

    // ====================================================== //
    // ========== Subir Imagen Temporal Documento =========== //
    // ====================================================== //
    $("input[name='subirImagenDocumento']").change(function () { 
        var imagen = this.files[0];

        // ====================================================== //
        // = VALIDAMOS QUE EL FORMATO DE LA IMAGEN SEA JPG O PNF  //
        // ====================================================== //

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png"){

            limpiarElementosImgDoc();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })

        } else if(imagen["size"] > 5000000){

            limpiarElementosImgDoc();

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

                $('.previsualizarDocumento').attr('src', rutaImagen);
                $("#rutaImagen").val(rutaImagen);

            });

        }
        
    });

    // ====================================================== //
    // ====== Subir Imagen Temporal Documento A Editar ====== //
    // ====================================================== //
    $("input[name='subirImagenEditarDocumento']").change(function () { 
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

                $('.previsualizarDocumentoEditar').attr('src', rutaImagen);
                $("#rutaImagenNueva").val(rutaImagen);

            });

        }
        
    });

    // ====================================================== //
    // ============= Subir Documento Temporal =============== //
    // ====================================================== //
    $("input[name='subirDocumento']").change(function () { 
        var documento = this.files[0];

        // ====================================================== //
        // ==== VALIDAMOS QUE EL FORMATO DEL ARCHIVO SEA PDF ==== //
        // ====================================================== //

        if(documento["type"] != "application/pdf"){

            limpiarElementosDoc();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el documento',
                text: 'El documento debe estar en formato PDF!',
                confirmButtonText: 'Cerrar'
            })

        } else if(documento["size"] > 100000000){

            limpiarElementosDoc();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el documento',
                text: 'El documento no debe pesar más de 100MB!',
                confirmButtonText: 'Cerrar'
            })

        }
        
    });

    // ====================================================== //
    // ========= Subir Documento Temporal A Editar ========== //
    // ====================================================== //
    $("input[name='subirEditarDocumento']").change(function () { 
        var documento = this.files[0];

        // ====================================================== //
        // ==== VALIDAMOS QUE EL FORMATO DEL ARCHIVO SEA PDF ==== //
        // ====================================================== //

        if(documento["type"] != "application/pdf"){

            limpiarElementosDoc();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el documento',
                text: 'El documento debe estar en formato PDF!',
                confirmButtonText: 'Cerrar'
            })

        } else if(documento["size"] > 100000000){

            limpiarElementosDoc();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el documento',
                text: 'El documento no debe pesar más de 100MB!',
                confirmButtonText: 'Cerrar'
            })

        }
        
    });

    var urlControlador = "controladores/documentos.controlador.php";

    $('#btnCancelarRegistroDocumento, #btCerrarModalRegistroDocumento').on('click', function () {
        limpiarElementosImgDoc();
        limpiarModalDocumentos(crear);
    });

    $('#modal_registro_documento').on('submit', function (e) {
        e.preventDefault();

        var selectEstructura = $(".seleccionarEstructuraDocumento").val();
        var selectCatalogo = $(".seleccionarCatalogoDocumento").val();
        var titulo = $("#registroTitulo").val();
        var descripcion = $("#registroDescripcion").val();
        var imagen = $("#rutaImagen").val();

        if (selectEstructura == "" || selectEstructura == "default" ||
            selectCatalogo == "" || selectCatalogo == "default" ||
            titulo == "" || descripcion == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Todos los campos son requeridos!',
                showConfirmButton: false,
                timer: 2000
            })

            return;

        } else if(imagen == "") {

            Swal.fire({
                icon: 'info',
                title: 'Subir Imagen!',
                text: 'Debe subir una imagen para el documento',
                confirmButtonText: 'Cerrar'
            })

            return;

        } else {

            var datos = new FormData($('#modal_registro_documento')[0])

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
                            limpiarElementosImgDoc();
                            limpiarModalDocumentos(crear);
                            $('#crearDocumento').modal("hide");
                        }, 2000);
                        tablaDocumentos.ajax.reload(null, false);
                        
                    }
                    
                    if(resultado.mensaje == 'invalido') {
                        eval(resultado.alerta);
                    }

                    if(resultado.mensaje == 'imagen-vacia') {
                        eval(resultado.alerta);
                    }

                    if(resultado.mensaje == 'subir-doc') {
                        eval(resultado.alerta);
                    }

                    if(resultado.mensaje == 'doc-invalido') {
                        eval(resultado.alerta);
                    }
                }
            });

        }

    });

    /*=============================================
    Editar Documentos
    =============================================*/
    $(document).on("click", ".editarDocumento", function () {
        var idDocumento = $(this).attr("id-documento");

        var selectEstructura = $(".seleccionarEditarEstructuraDocumento");
        var selectCatalogo = $(".seleccionarEditarCatalogoDocumento");

        var datos = new FormData();
        datos.append("idDocumento", idDocumento);

        $.ajax({
            url:"ajax/documentos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                selectEstructura.find('option').remove();
                selectEstructura.append('<option class="editarEstructuraId" selected></option>');
                $('.editarEstructuraId').val(respuesta["id_estructura"]);
                $('.editarEstructuraId').html(respuesta["estructura"]);

                selectCatalogo.find('option').remove();
                selectCatalogo.append('<option class="editarCatalogoId" selected></option>');
                $('.editarCatalogoId').val(respuesta["id_catalogo"] + "," + respuesta["catalogo"]);
                $('.editarCatalogoId').html(respuesta["catalogo"]);

                $('input[name="editarIdDocumento"]').val(respuesta["id"]);
                $('input[name="editarTitulo"]').val(respuesta["titulo"]);
                $('#editarDescripcion').val(respuesta["descripcion"]);
                $('input[name="archivoActual"]').val(respuesta["archivo"]);
                $('input[name="imagenActual"]').val(respuesta["imagen"]);
                $('.previsualizarDocumentoEditar').attr('src', "../../../backend/" + respuesta["imagen"]);

            }
        })
    });

    $('#btCerrarModalEditarDocumento, #btnCancelarEditarDocumento').on('click', function () {
        limpiarElementosImgDoc();
        limpiarModalDocumentos(editar);
    });

    $('#modal_editar_documento').on('submit', function (e) {
        e.preventDefault();

        var titulo = $("#editarTitulo").val();
        var descripcion = $("#editarDescripcion").val();

        if (titulo == "" || descripcion == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Todos los campos son requeridos!',
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

                    var datos = new FormData($('#modal_editar_documento')[0])

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
                                    limpiarElementosImgDoc();
                                    limpiarModalDocumentos(editar);
                                    $('#editarDocumentoModal').modal("hide");
                                }, 2000);
                                tablaDocumentos.ajax.reload(null, false);
                                
                            }
                            
                            if(resultado.mensaje == 'invalido') {
                                eval(resultado.alerta);
                            }

                            if(resultado.mensaje == 'doc-invalido') {
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
    // ================= ELIMINAR DOCUMENTO ================= //
    // ====================================================== //
    $(document).on("click", ".eliminarDocumento", function () {
        
        var idEliminar = $(this).attr("id-documento");
        var imagen = $(this).attr("ruta-imagen");
        var archivo = $(this).attr("ruta-archivo");

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
                datos.append("archivo", archivo);

                $.ajax({

                    url:"ajax/documentos.ajax.php",
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

                            tablaDocumentos.ajax.reload(null, false);

                            setTimeout(function() {
                                location.reload();
                            }, 2000);

                        }

                    }

                })
                
            }

          })

    });

});