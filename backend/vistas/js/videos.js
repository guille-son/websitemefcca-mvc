$(document).ready(function () {

    var crear = "crear";
    var editar = "editar";
    
    var tablaVideos = $(".tablaVideos").DataTable({
        "ajax": "ajax/tablaVideos.ajax.php",
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

    // ====================================================== //
    // ============= ACTIVAR SELECT CON BUSCADOR ============ //
    // ====================================================== //
    $('.seleccionarEstructuraVideo').select2();
    $('.seleccionarCatalogoVideo').select2();
    $('.seleccionarEstructuraVideoEditar').select2();
    $('.seleccionarCatalogoVideoEditar').select2();    

    // ====================================================== //
    // ============== LIMPIAR CAMPOS DEL MODAL ============== //
    // ====================================================== //
    function limpiarModalVideos(valor) {

        if(valor == "crear") {

            $("#crearVideo").find("input,textarea").val("");
            $("#crearVideo input[name='tipo']").val("registroVideo");
            $(".seleccionarEstructuraVideo, .seleccionarCatalogoVideo").val("default").trigger("change");
            $(".vistaVideo iframe").remove();

        } else {

            $("#editarVideoModal").find("input,textarea").val("");
            $("#editarVideoModal input[name='tipo']").val("editarVideo");
            $(".seleccionarEstructuraVideoEditar, .seleccionarCatalogoVideoEditar").val("default").trigger("change");
            $(".vistaVideo iframe").remove();

        }
    }

    // ====================================================== //
    // ====== CAPTURAR LA URL DEL VIDEO PARA MOSTRARLO ====== //
    // ====================================================== //
    function captureCodingURL(url) {
        try {
            var structlink = "https://www.youtube.com/watch?v=";
            var structlink2 = "https://youtu.be/";
            var dato;
  
            if (url.includes(structlink)) {
                return url.replace(structlink, "");
            } else if (url.includes(structlink2)) {
                return url.replace(structlink2, "");
            }
            return dato;
        } catch (e) {
            if (e instanceof TypeError) {
                // sentencias para manejar excepciones TypeError
            } else if (e instanceof RangeError) {
                // sentencias para manejar excepciones RangeError
            } else if (e instanceof EvalError) {
                // sentencias para manejar excepciones EvalError
            } else {
                // sentencias para manejar cualquier excepción no especificada
                logMyErrors(e); // pasa el objeto de la excepción al manejador de errores
            }
        }
    }

    // ====================================================== //
    // ==================== AGREGAR VIDEO =================== //
    // ====================================================== //
    $(".agregarVideo").change(function () {

        var structlink = "https://www.youtube.com/watch?v=";
        var structlink2 = "https://youtu.be/";
        var codigoVideo = $(this).val();

        if(codigoVideo.includes(structlink) || codigoVideo.includes(structlink2)) {

            $(".vistaVideo").html(
                `<iframe width="100%" height="320" src="https://www.youtube.com/embed/`+captureCodingURL(codigoVideo)+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`
            );

        } else {

            $(".vistaVideo").html("");

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Formato de link invalido!',
                showConfirmButton: false,
                timer: 2000
            })

        }
        
    });

    // ====================================================== //
    // === BOTONES PARA LIMPIAR CAMPOS AL CERRAR EL MODAL === //
    // ====================================================== //
    $('#btnCancelarRegistroVideo, #btCerrarModalRegistroVideo').on('click', function () {
        limpiarModalVideos(crear);
    });


    // ====================================================== //
    // =============== GUARDAR UN NUEVO VIDEO =============== //
    // ====================================================== //
    var urlControlador = "controladores/videos.controlador.php";

    $('#modal_registro_video').on('submit', function (e) {
        e.preventDefault();

        var selectEstructura = $(".seleccionarEstructuraVideo").val();
        var selectCatalogo = $(".seleccionarCatalogoVideo").val();
        var titulo = $("#registroTitulo").val();
        var url = $(".agregarVideo").val();

        if (selectEstructura == "" || selectEstructura == "default" ||
            selectCatalogo == "" || selectCatalogo == "default" ||
            titulo == "" || url == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Todos los campos son requeridos!',
                showConfirmButton: false,
                timer: 2000
            })

            return;

        } else {

            var datos = new FormData($('#modal_registro_video')[0])

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
                            limpiarModalVideos(crear);
                            $('#crearVideo').modal("hide");
                        }, 2000);

                        tablaVideos.ajax.reload(null, false);
                        
                    }
                    
                    if(resultado.mensaje == 'invalido') {
                        eval(resultado.alerta);
                    }

                }

            });

        }

    });

    // ====================================================== //
    // ============= EDITAR LOS DATOS DEL VIDEO ============= //
    // ====================================================== //
    $(document).on("click", ".editarVideo", function () {
        var idVideo = $(this).attr("id-video");
        var idEstructura = $(this).attr("id-estructura");
        var idCategoria = $(this).attr("id-catalogo");
        
        var selectEstructura = $(".seleccionarEstructuraVideoEditar");
        var selectCatalogo = $(".seleccionarCatalogoVideoEditar");

        var datos = new FormData();
        datos.append("idVideoEditar", idVideo);

        $.ajax({
            url:"ajax/videos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $('input[name="editarIdVideo"]').val(respuesta["id"]);
                $('input[name="editarTitulo"]').val(respuesta["titulo"]);
                $('input[name="editarCodigo"]').val(respuesta["link"]);
                $("#editarVideoModal .vistaVideo").html(
                    `<iframe width="100%" height="320" src="https://www.youtube.com/embed/` + captureCodingURL(respuesta["link"]) + `" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`
                );

                // LLENAR SELECT DE ESTRUCTURAS
                $.ajax({

                    url:"ajax/estructura.ajax.php",
                    type: "post",
                    data: {"tipo": "CargarEstructura",
                            "idEstructura" : idEstructura},
                    dataType: 'json',
                    success: function(r){

                        selectEstructura.find('option').remove();
                        selectEstructura.append('<option value="default">Seleccione una estructura</option>');
                        selectEstructura.append('<option class="editarEstructuraId" selected></option>');
                        $('.editarEstructuraId').val(respuesta["id_estructura"]);
                        $('.editarEstructuraId').html(respuesta["estructura"]);

                        $(r).each(function(i, v){ // indice, valor
                            selectEstructura.append('<option value="' + v.id + '">' + v.titulo + '</option>');
                        })
                    }

                })

                // LLENAR SELECT DE CATEGORIAS
                $.ajax({
                    url:"ajax/catalogo.ajax.php",
                    type: "post",
                    data: {"tipo": "CargarCatalogo",
                            "idCatalogo" : idCategoria,
                            "codigo" : "CTGV"},
                    dataType: 'json',
                    success: function(r){

                        selectCatalogo.find('option').remove();
                        selectCatalogo.append('<option value="default">Seleccione una categoria</option>');
                        selectCatalogo.append('<option class="editarCategoriaId" selected></option>');
                        $('.editarCategoriaId').val(respuesta["id_catalogo"]);
                        $('.editarCategoriaId').html(respuesta["catalogo"]);

                        $(r).each(function(i, v){ // indice, valor
                            selectCatalogo.append('<option value="' + v.id + '">' + v.descripcion + '</option>');
                        })
                    }
                })

            }

        })

    });

    $('#modal_editar_video').on('submit', function (e) {
        e.preventDefault();

        var selectEstructura = $(".seleccionarEstructuraVideoEditar").val();
        var selectCatalogo = $(".seleccionarCatalogoVideoEditar").val();
        var titulo = $("#editarTitulo").val();
        var url = $("#modal_editar_video .agregarVideo").val();

        if (selectEstructura == "" || selectEstructura == "default" ||
            selectCatalogo == "" || selectCatalogo == "default" ||
            titulo == "" || url == "") {

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
                    var datos = $(this).serializeArray();
    
                    $.ajax({
                        type: $(this).attr('method'),
                        data: datos,
                        url: urlControlador,
                        dataType: 'json',
                        success: function (resultado) {
    
                            if(resultado.mensaje == 'exito'){
    
                                eval(resultado.alerta);
    
                                setTimeout(function() {
                                    limpiarModalVideos(editar);
                                    $('#editarVideoModal').modal("hide");
                                }, 2000);
    
                                tablaVideos.ajax.reload(null, false);
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
    // === BOTONES PARA LIMPIAR CAMPOS AL CERRAR EL MODAL === //
    // ====================================================== //
    $('#btCerrarModalEditarVideo, #btnCancelarEditarVideo').on('click', function () {
        limpiarModalVideos(editar);
    });

    // ====================================================== //
    // ================== ELIMINAR UN VIDEO ================= //
    // ====================================================== //

    $(document).on("click", ".eliminarVideo", function () {
        var idEliminar = $(this).attr("id-video");

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

                $.ajax({

                    url:"ajax/videos.ajax.php",
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

                            tablaVideos.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

});