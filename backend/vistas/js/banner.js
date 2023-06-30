$(document).ready(function () {

    var crear = "crear";
    var editar = "editar";

    var tablaBanner = $(".tablaBanner").DataTable({
        "ajax": "ajax/tablaBanner.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "pageLength": 1,
        "lengthChange": false,
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

    function limpiarElementos() {

        $("input[name='subirBanner'], input[name='editarBanner']").val("");

        $("#nombreArchivoNuevoBanner").html("");

        $('.previsualizarBanner').attr('src', "");

    }

    // ====================================================== //
    // ============ Subir Imagen Temporal Banner ============ //
    // ====================================================== //
    $("input[name='subirBanner'], input[name='editarBanner']").change(function () { 
        var imagen = this.files[0];

        // ====================================================== //
        // = VALIDAMOS QUE EL FORMATO DE LA IMAGEN SEA JPG O PNF  //
        // ====================================================== //

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

            limpiarElementos();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })

        } else if(imagen["size"] > 15000000){

            limpiarElementos();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen no debe pesar más de 15MB!',
                confirmButtonText: 'Cerrar'
            })

        } else {

            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on('load', function (e) {
                
                var rutaImagen = e.target.result;

                $('.previsualizarBanner').attr('src', rutaImagen);

            });

        }
        
    });

    var urlControlador = "controladores/banner.controlador.php";

    // ====================================================== //
    // ================ Registro Nuevo Banner =============== //
    // ====================================================== //
    $('#modal_registro_banner').on('submit', function (e) {
        e.preventDefault();

        var datos = new FormData($('#modal_registro_banner')[0])

        $.ajax({
            url: urlControlador,
            type: $(this).attr('method'),
            contentType: false,
            data: datos,
            processData: false,
            dataType: 'json',
            success: function(data){

                var resultado = data;

                if(resultado.mensaje == 'exito'){

                    eval(resultado.alerta);

                    limpiarElementos();

                    setTimeout(function() {
                        $('#crearBanner').modal("hide");
                    }, 2000);
                    tablaBanner.ajax.reload(null, false);

                }

                if(resultado.mensaje == 'incompatible'){

                    eval(resultado.alerta);

                }

            }
        });

    });

    $('#btnCancelarRegistroBanner, #btnCancelarEditarBanner, #btCerrarModalRegistroBanner, #btCerrarModalEditarBanner').on('click', function () {
        limpiarElementos();
    });

    // ====================================================== //
    // ==================== Editar Banner =================== //
    // ====================================================== //    

    $(document).on("click", ".editarBanner", function () {

        var idBanner = $(this).attr("id-banner");

        var selectOrden = $("#select-editar-orden");

        var datos = new FormData();
        datos.append("idBanner", idBanner);

        $.ajax({
            url:"ajax/banner.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                $('input[name="idBanner"]').val(respuesta["id"]);
                $('input[name="ordenActual"]').val(respuesta["orden"]);
                $('input[name="bannerActual"]').val(respuesta["imagen"]);
                $('#modal_editar_banner .previsualizarBanner').attr('src', '../../../backend/' + respuesta["imagen"]);

                $.ajax({
                    url:"controladores/ordenbanner.controlador.php",
                    type: "post",
                    data: {"id" : idBanner,
                           "tipo": "orden"},
                    dataType: 'json',
                    success: function(r){

                        selectOrden.find('option').remove();
                        
                        selectOrden.append('<option class="editarOrden" selected></option>');

                        $('.editarOrden').val(respuesta["orden"]);
                        $('.editarOrden').html('Posición # ' + respuesta["orden"]);

                        $(r).each(function(i, v){ // indice, valor
                            selectOrden.append('<option value="' + v.orden + '">Posición # ' + v.orden + '</option>');
                        })
                    }
                })


            }
        });
        
    });

    $('#modal_editar_banner').on('submit', function (e) {
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

                var datos = new FormData($('#modal_editar_banner')[0])

                $.ajax({
                    url: urlControlador,
                    type: $(this).attr('method'),
                    contentType: false,
                    data: datos,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
        
                        var resultado = data;
        
                        if(resultado.mensaje == 'exito'){
        
                            eval(resultado.alerta);
        
                            limpiarElementos();
        
                            setTimeout(function() {
                                $('#editarBannerModal').modal("hide");
                                location.reload();
                            }, 2000);
        
                        }
        
                        if(resultado.mensaje == 'incompatible'){
        
                            eval(resultado.alerta);
        
                        }
        
                    }
                });

            } else if (result.isDenied) {

                Swal.fire('Los cambios no se guardaron', '', 'info')

            }
        })
    });

    /*=============================================
    Eliminar Banner
    =============================================*/

    $(document).on("click", ".eliminarBanner", function () {
        var idBanner = $(this).attr("id-banner");
        var rutaImagen = $(this).attr("ruta-imagen");

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
                datos.append("idEliminar", idBanner);
                datos.append("rutaImagen", rutaImagen);

                $.ajax({

                    url:"ajax/banner.ajax.php",
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

                            tablaBanner.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

    /*=============================================
    Habilitar o Deshabilitar un Banner
    =============================================*/
    $(document).on("click", ".btnHabilitarBanner", function () {

        var idBanner = $(this).attr("id-banner");
        var estado = $(this).attr("estadoBanner");

        var datos = new FormData();
        datos.append("idBannerEstado", idBanner);
        datos.append("estado", estado);

        $.ajax({

            url:"ajax/banner.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                tablaBanner.ajax.reload(null, false);

            }

        })

    });

});